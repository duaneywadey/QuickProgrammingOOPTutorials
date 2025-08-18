<?php  
class Product {
	
	public function __construct($productDescription, $productBrand, $itemsAvailable) {
		$this->productDescription = $productDescription;
		$this->productBrand = $productBrand;
		$this->itemsAvailable = $itemsAvailable;
	}

	public function showProdDescription() {
		$val = "This product has a description of " . $this->productDescription;
		return $val;
	}

	public function showProdBrand() {
		return "This product's brand is " . $this->productBrand;
	}

	public function addNewItem($value) {
		$this->itemsAvailable += $value;
	}

	public function deleteNewItem($value) {
		$this->itemsAvailable -= $value;
	}

}

$prodObj = new Product("Tshirt", "Culture", 10);
echo $prodObj->showProdDescription();
?>


