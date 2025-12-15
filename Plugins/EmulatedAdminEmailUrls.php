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
    /**
     * @var Configuration
     */
    private $_configuration;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $_urlModel;

    /**
     * @var StoreManagerInterface
     */
    private $_store;

    /**
     * @var mixed
     */
    private $originalScope;

    /**
     * @param \Magento\Framework\UrlInterface $urlModel
     * @param Configuration $configuration
     * @param StoreManagerInterface $store
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

    /**
     * Set URL scope to current store before getting transport.
     *
     * @return null
     */
    public function beforeGetTransport()
    {
        if ($this->_configuration->isActive()) {
            $this->originalScope = $this->_urlModel->getScope();
            if ($this->originalScope === null) {
                $this->originalScope = $this->_store->getStore('admin');
            }
            $this->_urlModel->setScope($this->_store->getStore());
        }

        return null;
    }

    /**
     * Restore URL scope after getting transport.
     *
     * @param mixed $subject
     * @param mixed $result
     * @return mixed
     */
    public function afterGetTransport($subject, $result)
    {
        if ($this->_configuration->isActive()) {
            $this->_urlModel->setScope($this->originalScope);
        }

        return $result;
    }
}
