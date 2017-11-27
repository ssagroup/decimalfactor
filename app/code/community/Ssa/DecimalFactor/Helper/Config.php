<?php
/**
 * @author      Andrey Makienko <andrey.makienko@ssa-outsourcing.com>
 * @website     https://www.ssa.group
 */
/**
 * Class Ssa_DecimalFactor_Helper_Config
 */
class Ssa_DecimalFactor_Helper_Config extends Mage_Core_Helper_Abstract
{
    CONST SSA_SETTINGS_DECIMAL_FACTOR_STATUS_PATH = 'ssa_decimalfactor/ssa_group/is_active';
    CONST SSA_SETTINGS_DECIMAL_FACTOR_VALUE_PATH = 'ssa_decimalfactor/ssa_group/decimal_factor';
    CONST SSA_SETTINGS_CRON_JOB_STATUS_PATH = 'ssa_decimalfactor/ssa_group/upgrade_old_orders';

    /**
     * @param mixed $store
     * @return mixed
     */
    public function getDecimalFactor($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SSA_SETTINGS_DECIMAL_FACTOR_VALUE_PATH, $store);
    }

    /**
     * @param mixed $store
     * @return mixed
     */
    public function isEnabled($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SSA_SETTINGS_DECIMAL_FACTOR_STATUS_PATH, $store);
    }

    /**
     * @param mixed $store
     * @return mixed
     */
    public function isCronJobAvailable($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SSA_SETTINGS_CRON_JOB_STATUS_PATH, $store);
    }
}