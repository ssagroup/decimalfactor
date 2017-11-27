<?php
/**
 * @author      Andrey Makienko <andrey.makienko@ssa-outsourcing.com>
 * @website     https://www.ssa.group
 */
/**
 * Class Ssa_DecimalFactor_Model_Observer
 */
class Ssa_DecimalFactor_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addOrderTotalPaidData(Varien_Event_Observer $observer)
    {
        $invoice = $observer->getInvoice();
        /** @var Ssa_DecimalFactor_Helper_Data $helper */
        $helper = Mage::helper('ssa_decimalfactor');
        if(!$invoice->getOrder()->getId() || !$helper->getConfigHelper()->isEnabled($invoice->getStoreId())) {

            return $this;
        }
        $totalDue = $invoice->getOrder()->getTotalDue();

        if($invoice->getState() === Mage_Sales_Model_Order_Invoice::STATE_PAID && intval($totalDue) === 0) {
            $helper->addDataToTable($invoice);
        }

        return $this;
    }
}