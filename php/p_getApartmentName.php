<?php 
session_start();
unset($_SESSION['apartmentName']);
if(isset($_POST['apartmentName'])){
	$_SESSION['apartmentName'] = $_POST['apartmentName'];
	echo $_SESSION['apartmentName'];
}
?>