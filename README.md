# Mage2 Module MagePro CacheWarm

[![Version](https://img.shields.io/badge/v1.0.0-beta-yellowgreen)](https://github.com/mageprocommunity/cachewarm)
[![Version](https://img.shields.io/badge/magento-2.4.*-orange)](https://github.com/mageprocommunity/cachewarm)
[![Version](https://img.shields.io/badge/magento-2.3.*-green)](https://github.com/mageprocommunity/cachewarm)
[![Version](https://img.shields.io/badge/php-~7.4.0-blue)](https://github.com/mageprocommunity/cachewarm)
[![Version](https://img.shields.io/badge/php-~8.1.0-blue)](https://github.com/mageprocommunity/cachewarm)

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Warmer for Magento

## Installation

```magepro/module-cachewarm```

\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/MagePro`
 - Enable the module by running `php bin/magento module:enable MagePro_CacheWarm`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require magepro/module-cachewarm`
 - enable the module by running `php bin/magento module:enable MagePro_CacheWarm`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications

 - Console Command
	- ```bin/magento magepro_cachewarm:warm```


## License
Please read the [LICENSE.txt](https://github.com/mageprocommunity/cachewarm/blob/master/LICENSE.txt) for the full text of the [Open Software License v. 3.0 (OSL-3.0)](http://opensource.org/licenses/osl-3.0.php).



