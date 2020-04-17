<?php

require_once 'Models/Book.php';
require_once 'Models/Furniture.php';
require_once 'Models/DVD.php';

$type = $_POST['type'] ?? null;

if ($type != null) {
    $productToAdd = new $type();
    $productToAdd->addToDatabase();
}
