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

    function connect()
    {
        $this->connection = new mysqli($this->host, $this->login, $this->password, $this->database);
    }

    function close()
    {
        $this->connection->close();
    }

    public function runNoReturnQuery()
    {
        if ($this->connection->query($this->query) == false) {
            echo "error occurred: " . $this->connection->error . "\n";
            return;
        }
    }

    public function runReturnQuery()
    {
        return $this->connection->query($this->query)->fetch_object()->id;
    }

    public function commit()
    {
        if ($this->connection->commit() == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }
    }

    function addFurniture(Furniture $furniture)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $furniture->getName() . "', " . $furniture->getPrice() . ", '" . $furniture->getSku() . "', 3);";

        $this->runNoReturnQuery();

        $this->commit();

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '" . $furniture->getSku() . "'";
        $id = $this->runReturnQuery();

        $this->commit();

        $this->query = "INSERT INTO scanditask.furniture (height, width, length, product_id)
                        VALUES (" . $furniture->getHeight() . ", " . $furniture->getWidth() . ", " . $furniture->getLength() . ", $id);";

        $this->runNoReturnQuery();

        $this->commit();
    }

    public function addDvd(DVD $dvd)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $dvd->getName() . "', " . $dvd->getPrice() . ", '" . $dvd->getSku() . "', 1);";

        $this->runNoReturnQuery();

        $this->commit();

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '" . $dvd->getSku() . "'";
        $id = $this->runReturnQuery();

        $this->commit();

        $this->query = "INSERT INTO scanditask.discs (size, product_id) VALUES (" . $dvd->getSize() . ", $id);";

        $this->runNoReturnQuery();

        $this->commit();
    }

    public function addBook(Book $book)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('" . $book->getName() . "', " . $book->getPrice() . ", '" . $book->getSku() . "', 2);";

        $this->runNoReturnQuery();

        $this->commit();

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '" . $book->getSku() . "'";
        $id = $this->runReturnQuery();

        $this->commit();

        $this->query = "INSERT INTO scanditask.books (weight, product_id) VALUES (" . $book->getWeight() . ", $id);";

        $this->runNoReturnQuery();

        $this->commit();
    }

    public function getRows($limit, $offset)
    {
        $this->query = "SELECT products.id,
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
}
