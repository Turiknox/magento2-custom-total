<?php
namespace Turiknox\CustomTotal\Model\Total;
/*
 * Turiknox_CustomTotal

 * @category   Turiknox
 * @package    Turiknox_CustomTotal
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-custom-total/blob/master/LICENSE.md
 * @version    1.0.0
 */
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;
use Turiknox\CustomTotal\Helper\Data as CustomTotalHelper;

class Custom extends AbstractTotal
{

    /**
     * @var CustomTotalHelper
     */
    protected $_helper;

    /**
     * Custom constructor.
     * @param CustomTotalHelper $helper
     */
    public function __construct(
        CustomTotalHelper $helper
    )
    {
        $this->_helper = $helper;
        $this->setCode('custom');
    }

    /**
     * @param Quote $quote
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @return $this
     */
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }
        $amount = $this->_helper->getAmount();

        $total->setTotalAmount('custom', $amount);
        $total->setBaseTotalAmount('custom', $amount);
        $total->setCustom($amount);
        $total->setBaseCustom($amount);
        $total->setGrandTotal($total->getGrandTotal() + $amount);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $amount);

        return $this;
    }

    /**
     * @param Total $total
     */
    protected function clearValues(Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    /**
     * @param Quote $quote
     * @param Total $total
     * @return array
     */
    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => $this->getCode(),
            'title' => $this->_helper->getTitle(),
            'value' => $this->_helper->getAmount()
        ];
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __($this->_helper->getTitle());
    }
}