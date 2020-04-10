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

    function checkConnection()
    {
        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        } else {
            echo "Nice";
        }
    }

    function createTable()
    {
        if ($this->connection->query('CREATE DATABASE scanditask') == TRUE) {
            echo 'Success';
        } else {
            echo 'Suck' . $this->connection->error;
        }

        $this->connection->select_db($this->database);
    }

    function close()
    {
        $this->connection->close();
    }

    function run($query)
    {
        $this->query = $query;
        $this->result = mysqli_query($this->connection, $this->query);
        $this->error = mysqli_error($this->connection);
    }

    function row()
    {
        $this->data = mysqli_fetch_assoc($this->result);
    }

    function fetch()
    {
        while ($this->data = mysqli_fetch_assoc($this->result)) {
            $this->fetch = $this->data;
            return $this->fetch;
        }
    }

    function stop()
    {
        unset($this->data);
        unset($this->result);
        unset($this->fetch);
        unset($this->error);
        unset($this->query);
    }

    function addFurniture($sku, $name, $price, $width, $height, $length)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$name', $price, '$sku', 3);";

        if ($this->connection->query($this->query)) {
            echo "first insert was sucessfull\n";
        } else {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$sku'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "INSERT INTO scanditask.furniture (height, width, length, product_id)
                        VALUES ($height, $width, $length, $id);";

        if ($this->connection->query($this->query)) {
            echo "second insert was sucessfull\n";
        } else {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
        }
    }

    public function addDvd($sku, $name, $price, $size)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$name', $price, '$sku', 1);";

        if ($this->connection->query($this->query)) {
            echo "first insert was sucessfull\n";
        } else {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$sku'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            return;
        }

        $this->query = "INSERT INTO scanditask.discs (size, product_id) VALUES ($size, $id);";

        if ($this->connection->query($this->query)) {
            echo "second insert was sucessfull\n";
        } else {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
        }
    }

    public function addBook($sku, $name, $price, $weight)
    {
        $this->query = "INSERT INTO scanditask.products (name, price, sku, category)
                        VALUES ('$name', $price, '$sku', 2);";

        if ($this->connection->query($this->query)) {
            echo "first insert was sucessfull\n";
        } else {
            echo "first insert has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        $this->query = "SELECT id FROM scanditask.products WHERE sku = '$sku'";
        $id = $this->connection->query($this->query)->fetch_object()->id;

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        $this->query = "INSERT INTO scanditask.books (weight, product_id) VALUES ($weight, $id);";

        if ($this->connection->query($this->query)) {
            echo "second insert was sucessfull\n";
        } else {
            echo "second insert has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
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

        if ($result = $this->connection->query($this->query)) {
        } else {
            echo "select has been failed: " . $this->connection->error . "\n";
            return null;
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

        if ($result = $this->connection->query($this->query)) {
        } else {
            echo "select has been failed: " . $this->connection->error . "\n";
            return null;
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

        if ($this->connection->query($this->query)) {
            echo "delete operation was sucessfull\n";
        } else {
            echo "delete has been failed: " . $this->connection->error . "\n";
            http_response_code(400);
            return;
        }

        if ($this->connection->commit()) {
            echo "Commit was done successfully\n";
        } else {
            echo "Commit wasn't successfull: " . $this->connection->error . "\n";
            http_response_code(400);
        }
    }
}
