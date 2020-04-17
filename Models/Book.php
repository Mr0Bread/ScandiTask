<?php
require_once "Product.php";

class Book extends Product
{
    private $weight;

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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
        $book = new self();
        $book->prepareBasicParamsToAddToDatabase();
        $book->setWeight($_POST['weight'] ?? null);
        return $book;
    }

    public function addToDatabase()
    {
        $this->connectToDatabase();
        $book = Book::getInstanceToAddToDatabase();
        $this->db_client->addBook($book);
        $this->db_client->close();
    }

    public function echoAdditionalProperties($row)
    {
        echo "<p>Weight: " . $row['weight'] . " KG</p>
                    </div>
                </div>";
    }
}