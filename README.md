# Acme Widget Co Sales System

## Overview

This is a proof of concept for Acme Widget Co's new sales system. It includes a basket class that calculates the total cost of items, including delivery charges and special offers.

## Products

- **Red Widget (RO1)**: $32.95
- **Green Widget (GO1)**: $24.95
- **Blue Widget (BO1)**: $7.95

## Delivery Charges

- Orders under $50: $4.95
- Orders under $90: $2.95
- Orders of $90 or more: Free

## Special Offers

- Buy one Red Widget, get the second half price.

## Class Interface

### Basket

#### `__construct($catalogue, $deliveryCharges, $offers)`
Initializes the basket with a product catalogue, delivery charge rules, and special offers.

#### `add($productCode)`
Adds a product to the basket. Throws an exception if the product code is not found in the catalogue.

#### `total()`
Calculates and returns the total cost of the basket, including delivery charges and applying any special offers.

## Example Usage

```php
$catalogue = [
    'RO1' => 32.95,
    'GO1' => 24.95,
    'BO1' => 7.95
];

$deliveryCharges = [
    90 => 0,
    50 => 2.95,
    0 => 4.95
];

$offers = [
    'RO1' => 'buy one get second half price'
];

$basket = new Basket($catalogue, $deliveryCharges, $offers);

$basket->add('RO1');
$basket->add('RO1');
$basket->add('GO1');

echo "Total: $" . number_format($basket->total(), 2) . "\n";
