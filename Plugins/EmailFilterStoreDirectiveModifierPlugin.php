<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Plugins;

use Graycore\Daffodil\Configuration\Configuration;
use Graycore\Daffodil\Router\Mapper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filter\Template\Tokenizer\Parameter;

class EmailFilterStoreDirectiveModifierPlugin
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

        $result = $this->_mapper->mapDomain(
            $result,
            $this->_urlModel->getBaseUrl()
        );

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
