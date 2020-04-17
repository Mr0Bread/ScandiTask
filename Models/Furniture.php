<?php
require_once "Product.php";

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

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

    public static function getInstanceToAddToDatabase()
    {
        $furniture = new self();
        $furniture->prepareBasicParamsToAddToDatabase();
        $furniture->setHeight($_POST['height'] ?? null);
        $furniture->setLength($_POST['length'] ?? null);
        $furniture->setWidth($_POST['width'] ?? null);
        return $furniture;
    }

    public function addToDatabase()
    {
        $this->connectToDatabase();
        $furniture = Furniture::getInstanceToAddToDatabase();
        $this->db_client->addFurniture($furniture);
        $this->db_client->close();
    }

    public function echoAdditionalProperties($row)
    {
        echo  "<p>Dimension: " . $row['height'] . "x" . $row['width'] . "x" . $row['length'] . " M</p>
                    </div>
                </div>";
    }
}