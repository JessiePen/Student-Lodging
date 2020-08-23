<?php 
session_start();
unset($_SESSION['latitude']);
unset($_SESSION['longitude']);
if(isset($_POST['latitude'])){
	$_SESSION['latitude'] = $_POST['latitude'];
	echo $_SESSION['latitude'];
}
if(isset($_POST['longitude'])){
	$_SESSION['longitude'] = $_POST['longitude'];
	echo $_SESSION['longitude'];
}
?>