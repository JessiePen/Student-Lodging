<?php 
session_start();
print_r($_POST);
if(isset($_POST['url1'])){
	$_SESSION['url1'] = $_POST['url1'];
}
if(isset($_POST['url2'])){
	$_SESSION['url2'] = $_POST['url2'];
}
if(isset($_POST['url3'])){
	$_SESSION['url3'] = $_POST['url3'];
}
?>