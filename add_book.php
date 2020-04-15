<?php

require "PHP/Config/Core.php";
require "Models/Book.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = $_POST['sku'] ?? null;
$name = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;
$weight = $_POST['weight'] ?? null;

$book = new Book($sku, $name, $price, $weight);

$db_client->addBook($book);
$db_client->close();
