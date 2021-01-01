<?php
$sgbd='my';
$host='localhost';
$user='root';
$password='ribafs';
$database='estoque';	
$port='3306';
$backup=false;
$logs=false;
$app_title = 'Meu Aplicativo';
$records = 10;

//Conect
if($sgbd=='my'){
	$conexao=mysql_connect('localhost:3306', 'root', 'ribafs') or die (mysql_error());
	//Select
	$db_sel=mysql_select_db('estoque') or die (mysql_error());
}elseif($sgbd=='pg'){
	$conexao=pg_connect("host=localhost user=root password=ribafs dbname=estoque port=3306") or die(pg_last_error());
}
?>
