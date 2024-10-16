<?php

require_once("database.php");

try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASS);
}
catch (PDOException $e) {
    echo $e->getMessage();
    die();
}