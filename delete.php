<?php

$ids = isset($_POST['idsToDelete']) ? $_POST['idsToDelete'] : null;
$ids = explode(',', $ids);

for ($i = 0; $i < sizeof($ids); $i++) {
    echo $ids[$i];
}

header("Location: http://localhost:8080/list.php");
die();
