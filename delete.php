<?php
require "PHP/Config/Core.php";

$ids = $_POST['idsToDelete'] ?? 'there,is,none';

$db_client = new MySQLDataBase();
$db_client->connect();

$db_client->deleteRows($ids);

$db_client->close();

header("Location: http://localhost:8080/PHP/list.php");
die();
