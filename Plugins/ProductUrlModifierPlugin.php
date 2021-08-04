<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Plugins;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Router\Mapper;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Modifies the product URLs to include the store domain.
 */
class ProductUrlModifierPlugin
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlModel,
        Configuration $configuration,
        Mapper $mapper,
        StoreManagerInterface $store
    ) {
        $this->_configuration = $configuration;
        $this->_urlModel = $urlModel;
        $this->_mapper = $mapper;
        $this->store = $store;
    }

    /**
     * Generate URL for the specified store.
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $result
     * @return string
     */
    public function afterGetUrl(\Magento\Catalog\Model\Product $product, string $result)
    {
        if (!$this->_configuration->isActive()) {
            return $result;
        }

        $domain = $this->store->getStore()->getBaseUrl();
        $result = $this->_mapper->mapDomain($result, $domain);

        return $result;
    }
}
