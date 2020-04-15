<?php


abstract class Product
{
    public $sku;
    public $name;
    public $price;

    /**
     * Product constructor.
     * @param $sku
     * @param $name
     * @param $price
     */
    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }


}