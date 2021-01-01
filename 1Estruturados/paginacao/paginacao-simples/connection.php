<?php
$hostname = "localhost";
$username = "root"; // change to yours
$password = ""; // change to yours
$database = "testes";

$row_limit = 5;
$linksPerPage = 23;

// connect to mysql
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Error! " . $err->getMessage());
}
