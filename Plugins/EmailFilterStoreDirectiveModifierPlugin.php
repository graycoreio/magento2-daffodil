<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare (strict_types = 1);

namespace Graycore\Daffodil\Plugins;

use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Router\Mapper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filter\Template\Tokenizer\Parameter;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class EmailFilterStoreDirectiveModifierPlugin
{
    private $_configuration;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $_urlModel;

    private $_mapper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $_storeManager;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlModel,
        Configuration $configuration,
        Mapper $mapper,
        StoreManagerInterface $storeManager
    ) {
        $this->_configuration = $configuration;
        $this->_urlModel = $urlModel;
        $this->_mapper = $mapper;
        $this->_storeManager = $storeManager;
    }

    /**
     * Generate URL for the specified store.
     *
     * @param  Store  $store
     * @param  string $route
     * @param  array  $params
     * @return string
     */
    public function afterStoreDirective(\Magento\Email\Model\Template\Filter $subject, $result, $construction)
    {
        if (!$this->_configuration->isActive()) {
            return $result;
        }
        $domain = $this->_urlModel->setScope(
            $this->_storeManager->getStore($subject->getStoreId())
        )->getBaseUrl();

        $result = $this->_mapper->mapDomain($result, $domain);

        $parameters = $this->getParameters($construction[2]);

        if ($parameters['url']) {
            $result = $this->_mapper->mapRoute($result, $parameters['url']);
        }

        return $result;
    }

    /**
     * Return associative array of parameters.
     *
     * @param  string $value raw parameters
     * @return array
     */
    protected function getParameters($value)
    {
        $tokenizer = new Parameter();
        $tokenizer->setString($value);
        return $tokenizer->tokenize();
    }
}
