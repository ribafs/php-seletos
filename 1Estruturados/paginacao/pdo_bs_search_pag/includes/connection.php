<?php
$host = 'localhost';
$db = 'testes2';
$user = 'root';
$pass = '';

$table = 'clients';

$title = 'CRUD com Paginação, PDO, BootStrap e Busca';
$max_visible = 23;
$row_limit = 8;

// connect to mysql
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die('Error! ' . $err->getMessage());
}
?>
