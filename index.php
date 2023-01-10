<?php

require ('core/MyApp.php');
require ('core/controller.php');
require ('core/model.php');
require ('core/config.php');
//require ('core/payment.php');

$database = [
    'host'=>'localhost',
    'dbname'=>'digikala',
    'user'=>'root',
    'pass'=>''
];
try {
    model::$conn = new PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['pass']);
} catch (PDOException $e) {
    exit("An error happend, Error: " . $e->getMessage());
}
$a = new MyApp();
