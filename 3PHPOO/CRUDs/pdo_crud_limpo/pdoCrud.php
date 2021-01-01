<?php

class pdoCrud{
 private $host="localhost";
 private $user="root";
 private $db="oopcrud";
 private $pass="root";
 private $conn;

 public function __construct(){
	$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
 }

 public function select($table){
	$sql="SELECT * FROM $table";
	$q = $this->conn->query($sql) or die("failed!");
	
	while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
	}
	return $data;
}

 public function selectOne($id,$table){
	$sql="SELECT * FROM $table WHERE id = :id";
	$q = $this->conn->prepare($sql);
	$q->execute(array(':id'=>$id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	return $data;
 }

 public function update($update,$execute){
	$q = $this->conn->prepare($update);
	$q->execute($execute);
	return true;
 }

 public function insert($insert,$execute){
	$q = $this->conn->prepare($insert);
	$q->execute($execute);
	return true;
 }

 public function delete($id,$table){
	$sql="DELETE FROM $table WHERE id=:id";
	$q = $this->conn->prepare($sql);
	$q->execute(array(':id'=>$id));
	return true;
 }
}
// Crédito
// http://www.w3programmers.com/crud-with-pdo-and-oop-php/
// Ver também: http://www.w3programmers.com/php-data-object-pdo-basic/
?>
