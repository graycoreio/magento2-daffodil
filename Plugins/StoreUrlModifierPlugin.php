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
use Magento\Store\Model\Store;

/**
 * Modifies the Store URLs to use the daffodil domain.
 */
class StoreUrlModifierPlugin
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlModel,
        Configuration $configuration,
        Mapper $mapper
    ) {
        $this->_configuration = $configuration;
        $this->_urlModel = $urlModel;
        $this->_mapper = $mapper;
    }

    /**
     * Generate URL for the specified store.
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $result
     * @return string
     */
    public function afterGetUrl(Store $store, $result, $route = '', $params = [])
    {
        if (!$this->_configuration->isActive()) {
            return $result;
        }

        $domain = $this->_urlModel->setScope(
            $store
        )->getBaseUrl();        
        $result = $this->_mapper->mapDomain($result, $domain);

        return $result;
    }
}