<?php
	require_once 'connection.php';
	
	if(ISSET($_REQUEST['id'])){
		$query = "DELETE FROM customers WHERE id = '$_REQUEST[id]'";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$conn = null;
		
		header('location: index.php');
	}

?>
