<?php

class MySQLDataBase
{
    var $login = 'jeffrey';
    var $password = 'password';
    var $database = 'scanditask';
    var $host = 'localhost';

    var $connection;
    var $query;
    var $error;
    var $result;
    var $data;
    var $fetch;

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->login, $this->password, $this->database);
    }

    public function close()
    {
        $this->connection->close();
    }

    private function runNoReturnQuery()
    {
        if ($this->connection->query($this->query) == false) {
            echo "error occurred: " . $this->connection->error . "\n";
            return;
        }
    }

    private function runReturnQuery()
    {
        return $this->connection->query($this->query)->fetch_object()->id;
    }

    private function commit()
    {
        if ($this->connection->commit() == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }
    }

    private function fulfillNoReturnQuery($query)
    {
        $this->query = $query;
        $this->runNoReturnQuery();
        $this->commit();
    }

    private function fulfillReturnQuery($query)
    {
        $this->query = $query;
        $result = $this->runReturnQuery();
        $this->commit();
        return $result;
    }

    private function addFurniture(Furniture $furniture)
    {
        $this->fulfillNoReturnQuery("INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $furniture->getName() . "', " . $furniture->getPrice() . ", '" . $furniture->getSku() . "', 3);");

        $id = $this->fulfillReturnQuery("SELECT id FROM scanditask.products WHERE sku = '" . $furniture->getSku() . "'");

        $this->fulfillNoReturnQuery("INSERT INTO scanditask.furniture (height, width, length, product_id)
                        VALUES (" . $furniture->getHeight() . ", " . $furniture->getWidth() . ", " . $furniture->getLength() . ", $id);");
    }

    private function addDvd(DVD $dvd)
    {
        $this->fulfillNoReturnQuery("INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $dvd->getName() . "', " . $dvd->getPrice() . ", '" . $dvd->getSku() . "', 1);");

        $id = $this->fulfillReturnQuery("SELECT id FROM scanditask.products WHERE sku = '" . $dvd->getSku() . "'");

        $this->fulfillNoReturnQuery("INSERT INTO scanditask.discs (size, product_id) VALUES (" . $dvd->getSize() . ", $id);");
    }

    private function addBook(Book $book)
    {
        $this->fulfillNoReturnQuery("INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $book->getName() . "', " . $book->getPrice() . ", '" . $book->getSku() . "', 2);");

        $id = $this->fulfillReturnQuery("SELECT id FROM scanditask.products WHERE sku = '" . $book->getSku() . "'");

        $this->fulfillNoReturnQuery("INSERT INTO scanditask.books (weight, product_id) VALUES (" . $book->getWeight() . ", $id);");
    }

    public function getRows($limit, $offset)
    {
        $this->query = "SELECT products.id,
                       categories.name as category,
                       products.name,
                       price,
                       sku,
                       categories.id as category_id,
                       size,
                       height,
                       width,
                       length,
                       weight
                FROM scanditask.products
                         JOIN scanditask.categories ON products.category = categories.id
                         LEFT JOIN scanditask.discs ON products.id = discs.product_id
                         LEFT JOIN scanditask.furniture ON products.id = furniture.product_id
                         LEFT JOIN scanditask.books ON products.id = books.product_id
                ORDER BY products.id
                        LIMIT $limit
                        OFFSET $offset";

        if (($result = $this->connection->query($this->query)) == false) {
            die("Select has been failed: " . $this->connection->error . "\n");
        }

        if ($this->connection->commit()) {
            return $result;
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return null;
        }
    }

    public function getRowCount()
    {
        $this->query = "SELECT COUNT(*) FROM scanditask.products
                        JOIN scanditask.categories ON products.category = categories.id
                        LEFT JOIN scanditask.discs ON products.id = discs.product_id
                        LEFT JOIN scanditask.furniture ON products.id = furniture.product_id
                        LEFT JOIN scanditask.books ON products.id = books.product_id";

        if (($result = $this->connection->query($this->query)) == false) {
            die("select has been failed: " . $this->connection->error . "\n");
        }

        if ($this->connection->commit()) {
            return $result->fetch_assoc()['COUNT(*)'];
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return null;
        }
    }

    public function deleteRows($ids)
    {
        $this->query = "DELETE FROM scanditask.products WHERE id IN $ids;";

        $this->runNoReturnQuery();

        $this->commit();
    }

    public function addProduct($product)
    {
        if ($product instanceof Book) {
            $this->addBook($product);
        } else if ($product instanceof DVD) {
            $this->addDvd($product);
        } else if ($product instanceof Furniture) {
            $this->addFurniture($product);
        }
    }
}
