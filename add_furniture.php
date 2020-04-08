<?php
require "Config/Core.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = isset($_POST['sku']) ? $_POST['sku'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$length = isset($_POST['length']) ? $_POST['length'] : null;
$width = isset($_POST['width']) ? $_POST['width'] : null;
$height = isset($_POST['height']) ? $_POST['height'] : null;

$db_client->addFurniture($sku, $name, $price, $width, $height, $length);
$db_client->close();