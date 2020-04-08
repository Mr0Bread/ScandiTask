<?php

require "Config/Core.php";

$db_client = new MySQLDataBase();
$db_client->connect();

$sku = isset($_POST['sku']) ? $_POST['sku'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$weight = isset($_POST['weight']) ? $_POST['weight'] : null;


$db_client->addBook($sku, $name, $price, $weight);
$db_client->close();
