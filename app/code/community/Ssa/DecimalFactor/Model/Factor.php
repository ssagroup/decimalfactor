<?php
/**
 * @author      Andrey Makienko <andrey.makienko@ssa-outsourcing.com>
 * @website     https://www.ssa.group
 */
/**
 * Class Ssa_DecimalFactor_Model_Factor
 * @method Ssa_DecimalFactor_Model_Resource_Factor getResource()
 */
class Ssa_DecimalFactor_Model_Factor extends Mage_Core_Model_Abstract
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('ssa_decimalfactor/factor');
    }

    /**
     * @param $orderId
     * @param $total
     * @return $this
     */
    public function addObjectData($orderId,$total)
    {
        if($this->isNew($orderId)) {
            $this->setData('order_id',$orderId);
            $this->setData('total',$total);
        } else {

            //todo  can be adding in case of partial paid
        }

        return $this;
    }

    /**
     * @param $orderId
     * @return bool
     */
    protected function isNew($orderId)
    {
        if($this->getItemByOrderId($orderId)) {

            return false;
        }

        return true;
    }

    /**
     * @param $orderId
     * @return array
     */
    public function getItemByOrderId($orderId)
    {
        return $this->getResource()->getItemTotalByOrderId($orderId);
    }
}