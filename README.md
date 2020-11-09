# Magento 2 Daffodil

[![Packagist Downloads](https://img.shields.io/packagist/dm/graycore/magento2-daffodil?color=blue)](https://packagist.org/packages/graycore/magento2-daffodil/stats)
[![Packagist Version](https://img.shields.io/packagist/v/graycore/magento2-daffodil?color=blue)](https://packagist.org/packages/graycore/magento2-daffodil)
[![Packagist License](https://img.shields.io/packagist/l/graycore/magento2-daffodil)](https://github.com/graycoreio/magento2-daffodil/blob/master/LICENSE)

## Magento Version Support
![Magento v2.3 Supported](https://img.shields.io/badge/Magento-2.3-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)
![Magento v2.4 Supported](https://img.shields.io/badge/Magento-2.4-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)


## Purpose

This package intends to allow developers who use Daffodil with Magento 2 some basic out-of-the-box configurations to make life easier.

## Getting Started
This module is intended to be installed with [composer](https://getcomposer.org/). From the root of your Magento 2 project:

1. Download the package
```bash
composer require graycore/magento2-cors
```
2. [Configure the package](/docs/stories/emails.md)
3. Enable the package

```bash
./bin/magento module:enable Graycore_Cors
```

## Features
* [Email URL Modification To A User Configured Route](./docs/stories/emails.md)

## Upgrading
* [Semver Policy](https://semver.org/)