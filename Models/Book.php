<?php
require "Product.php";

class Book extends Product
{
    public $weight;

    /**
     * Book constructor.
     * @param $weight
     * @param $sku
     * @param $name
     * @param $price
     */
    public function __construct($sku, $name, $price ,$weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }


}