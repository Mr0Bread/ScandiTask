<?php

require "Config/Core.php";
require "Models/DVD.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = $_POST['sku'] ?? null;
$name = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;
$size = $_POST['size'] ?? null;

$dvd = new DVD($sku, $name, $price, $size);

$db_client->addDvd($dvd);
$db_client->close();