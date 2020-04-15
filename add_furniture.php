<?php
require "Config/Core.php";
require "Models/Furniture.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = $_POST['sku'] ?? null;
$name = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;
$length = $_POST['length'] ?? null;
$width = $_POST['width'] ?? null;
$height = $_POST['height'] ?? null;

$furniture = new Furniture($sku, $name, $price, $height, $width, $length);

$db_client->addFurniture($furniture);
$db_client->close();