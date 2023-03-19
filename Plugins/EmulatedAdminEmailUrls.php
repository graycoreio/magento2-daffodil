<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare(strict_types=1);

namespace Graycore\Daffodil\Plugins;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Graycore\Daffodil\Configuration\Configuration;
use Magento\Store\Model\StoreManagerInterface;

class EmulatedAdminEmailUrls
{
    private $_configuration;
    private $_urlModel;
    private $_store;

    private $originalScope;
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlModel,
        Configuration $configuration,
        StoreManagerInterface $store
    ) {
        $this->_configuration = $configuration;
        $this->_urlModel = $urlModel;
        $this->_store = $store;
    }

    public function beforeGetTransport()
    {
        if ($this->_configuration->isActive()) {
            $this->originalScope = $this->_urlModel->getScope();
            $this->_urlModel->setScope($this->_store->getStore());
        }

        return null;
    }

    /**
     * 
     */
    public function afterGetTransport($subject, $result)
    {
        if ($this->_configuration->isActive()) {
            $this->_urlModel->setScope($this->originalScope);
        }

        return $result;
    }
}
