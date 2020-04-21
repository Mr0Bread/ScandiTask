<?php
require_once '../Config/Core.php';

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    private static $db_client;

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

    protected function prepareBasicParamsToAddToDatabase()
    {
        $this->sku = $_POST['sku'] ?? null;
        $this->name = $_POST['name'] ?? null;
        $this->price = $_POST['price'] ?? null;
    }

    public static function addProductToDatabase($product)
    {
        self::connectToDatabase();
        self::$db_client->addProduct($product);
        self::$db_client->close();
    }

    private static function connectToDatabase()
    {
        self::$db_client = new MySQLDataBase();
        self::$db_client->connect();
    }
}