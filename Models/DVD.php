<?php
require "Product.php";

class DVD extends Product
{
    public $size;

    /**
     * DVD constructor.
     * @param $size
     * @param $sku
     * @param $name
     * @param $price
     */
    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }


}