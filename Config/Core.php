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

    function addFurniture($furniture)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$furniture->getName()', $furniture->getPrice(), '$furniture->getSku()', 3);";

        if ($this->connection->query($this->query) == false) {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$furniture->getSku()'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "INSERT INTO scanditask.furniture (height, width, length, product_id)
                        VALUES ($furniture->getHeight(), $furniture->getWidth(), $furniture->getLength(), $id);";

        if ($this->connection->query($this->query)  == false) {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
        }
    }

    public function addDvd($dvd)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$dvd->getName()', $dvd->getPrice(), '$dvd->getSku()', 1);";

        if ($this->connection->query($this->query)  == false) {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$dvd->getSku()'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "INSERT INTO scanditask.discs (size, product_id) VALUES ($dvd->getSize(), $id);";

        if ($this->connection->query($this->query)  == false) {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
        }
    }

    public function addBook($book)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$book->getName()', $book->getPrice(), '$book->getSku()', 2);";

        if ($this->connection->query($this->query)  == false) {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$book->getSku()'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        $this->query = "INSERT INTO scanditask.books (weight, product_id) VALUES ($book->getWeight(), $id);";

        if ($this->connection->query($this->query)  == false) {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
        }
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

        if (($result = $this->connection->query($this->query))  == false) {
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

        if (($result = $this->connection->query($this->query))  == false) {
            die("select has been failed: " . $this->connection->error . "\n");
        }

        if ($this->connection->commit()) {
            return $result->fetch_assoc()['COUNT(*)'];
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return null;
        }
    }

    public function deleteRows($ids) {
        $this->query = "DELETE FROM scanditask.products WHERE id IN $ids;";

        if ($this->connection->query($this->query)  == false) {
            echo "delete has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()  == false) {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
        }
    }
}
