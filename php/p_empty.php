<?php 
session_start();
print_r($_POST);
if(isset($_POST['isClick'])){
	$_SESSION['isClick'] = $_POST['isClick'];
}
?>