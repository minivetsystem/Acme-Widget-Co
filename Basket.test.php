
### Testing the Implementation

Let's test the implementation with the provided example baskets:

```php
<?php

// Initialize the basket
$basket = new Basket($catalogue, $deliveryCharges, $offers);

// Test cases
$testCases = [
    [['BO1', 'GO1'], 37.85],
    [['RO1', 'RO1'], 54.37],
    [['RO1', 'GO1'], 60.85],
    [['BO1', 'BO1', 'RO1', 'RO1', 'RO1'], 98.27]
];

foreach ($testCases as $index => $testCase) {
    $basket = new Basket($catalogue, $deliveryCharges, $offers);
    foreach ($testCase[0] as $productCode) {
        $basket->add($productCode);
    }
    $total = $basket->total();
    echo "Test case " . ($index + 1) . ": " . ($total == $testCase[1] ? "Pass" : "Fail (Expected: $testCase[1], Got: $total)") . "\n";
}

?>
