/*
 * Turiknox_CustomTotal

 * @category   Turiknox
 * @package    Turiknox_CustomTotal
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-custom-total/blob/master/LICENSE.md
 * @version    1.0.0
 */
define(
    [
        'Turiknox_CustomTotal/js/view/checkout/summary/custom'
    ],
    function (Component) {
        'use strict';

        return Component.extend({

            /**
             * @override
             */
            isDisplayed: function () {
                return this.getPureValue() !== 0;
            }
        });
    }
);