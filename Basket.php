<?php

class Basket {
    private $catalogue;
    private $deliveryCharges;
    private $offers;
    private $items = [];

    public function __construct($catalogue, $deliveryCharges, $offers) {
        $this->catalogue = $catalogue;
        $this->deliveryCharges = $deliveryCharges;
        $this->offers = $offers;
    }

    public function add($productCode) {
        if (isset($this->catalogue[$productCode])) {
            $this->items[] = $productCode;
        } else {
            throw new Exception("Product code $productCode not found in catalogue.");
        }
    }

    public function total() {
        $total = 0;
        $itemCounts = array_count_values($this->items);

        // Apply special offers
        foreach ($this->offers as $productCode => $offer) {
            if (isset($itemCounts[$productCode])) {
                $total += $this->applyOffer($productCode, $itemCounts[$productCode]);
                unset($itemCounts[$productCode]);
            }
        }

        // Calculate remaining items without special offers
        foreach ($itemCounts as $productCode => $count) {
            $total += $this->catalogue[$productCode] * $count;
        }

        // Calculate delivery charges
        $deliveryCharge = $this->getDeliveryCharge($total);

        return $total + $deliveryCharge;
    }

    private function applyOffer($productCode, $count) {
        $offerTotal = 0;
        $basePrice = $this->catalogue[$productCode];
        
        if ($productCode == 'RO1') {
            while ($count > 1) {
                $offerTotal += $basePrice + ($basePrice / 2);
                $count -= 2;
            }
            if ($count == 1) {
                $offerTotal += $basePrice;
            }
        }

        return $offerTotal;
    }

    private function getDeliveryCharge($total) {
        if ($total >= 90) {
            return 0;
        } elseif ($total >= 50) {
            return 2.95;
        } else {
            return 4.95;
        }
    }
}

// Define product catalogue, delivery charges, and offers
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

// Example usage
$basket = new Basket($catalogue, $deliveryCharges, $offers);

$basket->add('RO1');
$basket->add('RO1');
$basket->add('GO1');

echo "Total: $" . number_format($basket->total(), 2) . "\n";

?>
