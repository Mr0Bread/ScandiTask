<?php

require "Config/Core.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = isset($_POST['sku']) ? $_POST['sku'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$size = isset($_POST['size']) ? $_POST['size'] : null;

$db_client->addDvd($sku, $name, $price, $size);
$db_client->close();