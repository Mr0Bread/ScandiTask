<?php

require_once '../Models/Models.php';

$type = $_POST['type'] ?? null;

if ($type != null) {
    $productToAdd = new $type();
    $productToAdd->addToDatabase();
}
