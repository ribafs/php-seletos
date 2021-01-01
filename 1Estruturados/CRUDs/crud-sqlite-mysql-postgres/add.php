<?php
	require_once 'connection.php';
	
	if(ISSET($_POST['save'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		
		$query = "INSERT INTO customers (name, email, city) VALUES(:name, :email, :city)";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':city', $city);
		
		$stmt->execute();
		$conn = null;
		
		header('location: index.php');
		
	}
?>
