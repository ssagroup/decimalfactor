<?php
/**
 * @author      Andrey Makienko <andrey.makienko@ssa-outsourcing.com>
 * @website     https://www.ssa.group
 */
/**
 * Class Ssa_DecimalFactor_Model_Resource_Factor
 */
class Ssa_DecimalFactor_Model_Resource_Factor extends Mage_Core_Model_Resource_Db_Abstract
{
    protected $_alias = 'sdf'; // short abbreviation of 'ssa_decimal_factor'
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('ssa_decimalfactor/factor', 'entity_id');
    }

    /**
     * @param $orderId
     * @return array
     */
    public function getItemTotalByOrderId($orderId)
    {
        $adapter = $this->getReadConnection();
        $select  = $adapter->select()
            ->from(
                [$this->_alias => $this->getMainTable()],
                [$this->_alias.'.total']
            )
            ->where($this->_alias.'.order_id=?', $orderId);

        return $adapter->fetchRow($select);
    }

    /**
     * @return array
     */
    public function getOrderIdsFromCurrentTable()
    {
        $adapter = $this->getReadConnection();
        $select  = $adapter->select()
            ->from(
                [$this->_alias => $this->getMainTable()],
                [$this->_alias.'.order_id']
            );

        return $adapter->fetchAll($select);
    }

    /**
     * @return Varien_Db_Select
     */
    public function getOldValidOrdersSelect()
    {
        $adapter = $this->getReadConnection();
        $select  = $adapter->select()
            ->from(
                ['sales_flat_order'],
                [
                    'entity_id',
                    'store_id',
                    'total_paid'
                ]
            )
            ->where('state NOT IN(?)', [Mage_Sales_Model_Order::STATE_CLOSED])
            ->where('entity_id NOT IN(?)', $this->getOrderIdsFromCurrentTable())
            ->where('total_paid >?', 0)
            ->where('CAST(total_due AS SIGNED) =?',0 );

        return $select;
    }

    /**
     * Prepare select data to insert in table
     * @param $ordersSelect
     */
    public function prepareDataToInsert($ordersSelect)
    {
        $source = $this->getReadConnection()->query($ordersSelect);
        $bunchRows = [];
        // transform total_paid data by decimal factor
        while ($rowData = $source->fetch()) {
            $decimalFactor = $this->getHelper()->getConfigHelper()->getDecimalFactor($rowData['store_id']);
            $bunchRows[$rowData['entity_id']]['order_id'] = $rowData['entity_id'];
            $bunchRows[$rowData['entity_id']]['total'] = $this->getHelper()->transformValueByFactor($rowData['total_paid'],$decimalFactor);
        }

        if (!empty($bunchRows)) {
            $this->saveBunch($bunchRows);
        }
    }

    /**
     * @param $bunchRows
     */
    protected function saveBunch($bunchRows)
    {
        if(!empty($bunchRows)) {
            $this->_getWriteAdapter()->insertOnDuplicate($this->getMainTable(), $bunchRows);
        }
    }

    /**
     * @return Ssa_DecimalFactor_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('ssa_decimalfactor');
    }
}