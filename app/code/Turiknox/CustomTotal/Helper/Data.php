<?php
/*
 * Turiknox_CustomTotal

 * @category   Turiknox
 * @package    Turiknox_CustomTotal
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-custom-total/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\CustomTotal\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH_CUSTOM_TOTAL_ENABLE = 'sales/custom_total/enable';
    const XML_PATH_CUSTOM_TOTAL_TITLE  = 'sales/custom_total/label';
    const XML_PATH_CUSTOM_TOTAL_AMOUNT = 'sales/custom_total/amount';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeInterface
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeInterface
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeInterface;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_TOTAL_ENABLE,
            ScopeInterface::SCOPE_WEBSITE
        );
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_TOTAL_TITLE,
            ScopeInterface::SCOPE_WEBSITE
        );
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->isEnabled() ? $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_TOTAL_AMOUNT,
            ScopeInterface::SCOPE_WEBSITE
        ) : 0;
    }
}
