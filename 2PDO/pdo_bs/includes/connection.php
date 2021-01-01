<?php
$host = '127.0.0.1';
$db   = 'testes2';
$user = 'root';
$pass = '';
$port = 3306; // 3306, 5432
$sgbd='mysql';// pgsql, mysql
$table = 'clients';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO("$sgbd:host=$host;dbname=$db;port=$port", $user, $pass, $options);
    // echo 'Conectado para o banco de dados<br />';

    /*** close the database connection ***/
    // $pdo = null;
}catch(PDOException $e){
    echo $e->getMessage();
}

