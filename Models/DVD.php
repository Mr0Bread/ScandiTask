<?php
require_once "Product.php";

class DVD extends Product
{
    private $size;

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
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
        $DVD = new self();
        $DVD->prepareBasicParamsToAddToDatabase();
        $DVD->setSize($_POST['size'] ?? null);
        return $DVD;
    }

    public function addToDatabase()
    {
        $this->connectToDatabase();
        $dvd = DVD::getInstanceToAddToDatabase();
        $this->db_client->addDvd($dvd);
        $this->db_client->close();
    }

    public function echoAdditionalProperties($row)
    {
        echo "<p>Size: " . $row['size'] . " MB</p>
                    </div>
                </div>";
    }
}