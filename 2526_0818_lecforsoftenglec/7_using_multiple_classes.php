<?php

class Product {
  public $name;
  public $price;
  public $quantity;

  public function __construct($name, $price, $quantity) {
    $this->name = $name;
    $this->price = $price;
    $this->quantity = $quantity;
  }
}

class Order {
  public $customerName;
  public $items = [];
  public $totalPrice;

  public function __construct($customerName) {
    $this->customerName = $customerName;
  }

  public function addItem(Product $product) {
    $this->items[] = $product;
  }

  public function calculateTotalPrice() {
    $this->totalPrice = 0;
    foreach ($this->items as $item) {
      $this->totalPrice += $item->price * $item->quantity;
    }
  }
}

class ShoppingCart {
  public $items = [];
  public $totalPrice;

  public function addItem(Product $product) {
    $this->items[] = $product;
  }

  public function removeItem(Product $product) {
    $key = array_search($product, $this->items, true);
    if ($key !== false) {
      unset($this->items[$key]);
      // Reindex the array to avoid gaps in keys
      $this->items = array_values($this->items);
    }
  }

  public function calculateTotalPrice() {
    $this->totalPrice = 0;
    foreach ($this->items as $item) {
      $this->totalPrice += $item->price * $item->quantity;
    }
  }
}

class OrderProcessor {
  public static function processOrder(Order $order) {
    // Simulate processing (payment, inventory)
    echo "Processing order for " . $order->customerName . "...<br>";
  }
}

// Usage
$product1 = new Product("Shirt", 10, 5);
$product2 = new Product("Hat", 20, 2);

$order1 = new Order("John Doe");
$order1->addItem($product1);
$order1->addItem($product2);
$order1->calculateTotalPrice();

$order2 = new Order("Jane Smith");
$order2->addItem($product1);
$order2->calculateTotalPrice();

$shoppingCart = new ShoppingCart();
$shoppingCart->addItem($product2);
$shoppingCart->calculateTotalPrice();

// Output totals
echo "\nOrder 1 Total: $" . $order1->totalPrice;
echo "\nOrder 2 Total: $" . $order2->totalPrice;
echo "\nShopping Cart Total: $" . $shoppingCart->totalPrice;

?>
