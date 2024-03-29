<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

declare (strict_types = 1);

namespace Graycore\Daffodil\Configuration;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Retrieves configuration for usage throughout the module.
 */
class Configuration
{
    const ACTIVE = 'daffodil/configuration/active';
    const DAFFODIL_URL = 'daffodil/configuration/url';

    private $_scopeConfig;
    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->_scopeConfig->getValue(
            self::ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getDaffodilUrl(): string
    {
        $configValue = (string) $this->_scopeConfig->getValue(
            self::DAFFODIL_URL,
            ScopeInterface::SCOPE_STORE
        );
        return rtrim($configValue ?? '', '/') . '/';
    }
}
