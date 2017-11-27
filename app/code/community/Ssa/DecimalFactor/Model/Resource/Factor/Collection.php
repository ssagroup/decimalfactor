<?php
/**
 * @author      Andrey Makienko <andrey.makienko@ssa-outsourcing.com>
 * @website     https://www.ssa.group
 */
/**
 * Class Ssa_DecimalFactor_Model_Resource_Factor_Collection
 */
class Ssa_DecimalFactor_Model_Resource_Factor_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('ssa_decimalfactor/factor');
    }

    /**
     * @return array
     */
    public function getAllItems()
    {
        $select = $this->getSelect()->from([$this->getMainTable()],[
            'entity_id',
            'total',
            'order_id'
        ]);
		$select->group('main_table.order_id');

        $connection = $this->getResource()->getReadConnection();
        $itemsData = $connection->fetchAll($select);

        return $itemsData;
    }

    /**
     * @return array
     */
    public function getAllOrderIds()
    {
        $select = $this->getSelect()->from([$this->getMainTable()],[
            'order_id'
        ]);
		$select->group('main_table.order_id');

        $connection = $this->getResource()->getReadConnection();
        $itemsData = $connection->fetchAll($select);

        return $itemsData;
    }
}