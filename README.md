# Introduction
This module represents an approach to observe order paid total and change it by decimal factor which can be set in admin settings part 
# Features
 - Ability to change decimal factor
 - Ability to get actual data from old orders by cron
 - All changes are in separate table which allow to expand it without any changes in core tables
 
# How to Install 

### Compatibility
#### Supported Magento Versions

 - Community: 1.8.1.0; 1.9.0.1;1.9.1.1;1.9.2.x;1.9.3.x
 
#### Requirements

 - PHP Version: > 5.3
 - Magento Community Edition 1.x
 
#### Instalation

   - Install this extension using [modman](https://github.com/colinmollenhour/modman).
    Once you have modman installed, run `modman init` if you have not already done so.
    Next just run in the root of the Magento installation (`/var/www/magento`):
   
   ```
   modman clone git://github.com/ssagroup/decimalfactor.git
   ```
   
# Configuration

Configuration can be done using the Administrator section of your Magento store. 
Once Logged in, you will find the configuration settings under  **Settings > Configuration > SSA Extension Modules > Decimal Factor**
![Alt text](https://raw.githubusercontent.com/ssagroup/decimalfactor/master/docs/SettingsMenu.png "settings")
![Alt text](https://raw.githubusercontent.com/ssagroup/decimalfactor/master/docs/Settings.png "settings")

**NOTE:** As default this extension using settings from `config.xml` 
![Alt text](https://raw.githubusercontent.com/ssagroup/decimalfactor/master/docs/DefaultSettings.png "settings")

# Additional Info

This extension use cron job for getting data from old orders
![Alt text](https://raw.githubusercontent.com/ssagroup/decimalfactor/master/docs/CronConfigSettings.png "cron settings")

Cron extracts data in parts (as default CRON_BATCH = 100)

This extension has additional methods for getting data from any place of your magento

`$orderId` you order entity_id
```
Mage::getModel('ssa_decimalfactor/factor')->getItemByOrderId($orderId);
```
Get All Items (all rows)
```
Mage::getModel('ssa_decimalfactor/factor')
->getCollection()
->getAllItems()
```
Get All Items (only order_id row)
```
Mage::getModel('ssa_decimalfactor/factor')
->getCollection()
->getAllOrderIds()
```
