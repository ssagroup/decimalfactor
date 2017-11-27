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
 - Enterprise: 1.14.0.1;1.14.0.1;1.14.2.x;1.14.3.x 
 
#### Requirements

 - PHP Version: > 5.3
 - Magento Community Edition 1.x and Magento Enterprise Edition 1.x
 
#### Instalation

   - Install this extension using [modman](https://github.com/colinmollenhour/modman):
   
   ```
   modman clone git@github.com:ssagroup/decimalfactor.git
   ```
   
   - Install this extension using Magento Connect account: Download source archive [here](https://github.com/ssagroup/decimalfactor) 
   and use your Magento Connect account to upload it. Notice: Don't forget to flush the Magento cache. 