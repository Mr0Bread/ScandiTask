<?php
require "Product.php";

class Furniture extends Product
{
    public $height;
    public $width;
    public $length;

    /**
     * Furniture constructor.
     * @param $height
     * @param $width
     * @param $length
     * @param $sku
     * @param $name
     * @param $price
     */
    public function __construct($sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }


}