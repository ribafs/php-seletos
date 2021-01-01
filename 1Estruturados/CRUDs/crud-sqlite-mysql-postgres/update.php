<?php
	require_once 'connection.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		
		$query = "UPDATE customers SET name = :name, email = :email, city = :city  WHERE id = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':city', $city);
		$stmt->bindParam(':id', $id);
		
		$stmt->execute();
		$conn = null;
		header('location: index.php');
		
	}
?>
