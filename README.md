# Turiknox Custom Total

## Overview

A simple Magento 2 module demonstrating how to add a surcharge or discount total to the frontend.

Please note that the module should not be used in production without further development work. Whilst the module correctly calculates the totals on the cart and checkout pages, the custom total data does not get saved within the quote and order tables, hence the totals are not calculated and displayed for invoices, credit memos etc. Hopefully this functionality will be added in future.

## Requirements

Magento 2.1.x

## Installation

Copy the contents into your Magento project directory and enable the module via the command line:

/path/to/php bin/magento module:enable Turiknox_CustomTotal

Run the database upgrade and compile commands:

/path/to/php bin/magento setup:upgrade
/path/to/php bin/magento setup:di:compile

## Usage

Stores -> Configuration -> Sales -> Sales, and expand the 'Custom Total' section. Here you'll be able to enable/disable the total, set the title (label) and the amount.
