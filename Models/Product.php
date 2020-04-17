<?php
require_once 'Config/Core.php';

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $db_client;

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function __construct()
    {
        $this->sku = $_POST['sku'] ?? null;
        $this->name = $_POST['name'] ?? null;
        $this->price = $_POST['price'] ?? null;
        $this->db_client = new MySQLDataBase();
        $this->db_client->connect();
    }
}