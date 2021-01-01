<?php 	
session_start();
if(!isset($_SESSION['access'])){
	print "Direct access denied!";
	exit;
}
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
