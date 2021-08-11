<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare (strict_types = 1);

namespace Graycore\Daffodil\Plugins;

use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Router\Mapper;
use Magento\Email\Model\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Store;

class EmailTemplateUrlModifierPlugin
{
    private $_configuration;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $_urlModel;

    private $_mapper;

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
     * @param Store $store
     * @param string $route
     * @param array $params
     * @return string
     */
    public function afterGetUrl(Template $subject, $result, Store $store, $route = '', $params = [])
    {
        if (!$this->_configuration->isActive()) {
            return $result;
        }
        $domain = $this->_urlModel->setScope($store)->getBaseUrl();

        $result = $this->_mapper->mapDomain($result, $domain);
        $result = $this->_mapper->mapRoute($result, $route);

        return $result;
    }
}
