<?php 
session_start();
header('Content-type:text/html; charset = utf-8');
//SET URL AND DATABASE
include_once "../php/p_Config.php";
include_once '../php/inc/tool.inc.php';
//intial valiable
$username = '';
$password = '';
	if(isset($_POST['username'])){
		$username = $_POST['username'];
	}
	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}
		try{
			$pdo = new PDO($dsn,$db_username,$db_password,$opt);
			$searchUserStmt = $pdo -> prepare("select * from member where username = :username and password = :password");
			$searchUserStmt->execute(array(
				':username' => $username,
				':password' => md5($password)
			));
			$row = $searchUserStmt ->rowCount();
			if($row == 1){
				$_SESSION['username'] = $username;
				$_SESSION['password'] = md5($password);
				header('Location: ../Homepage/Homepage.php');
				exit();
			}else{
				skip('../Login/Login.php','error','The username is wrong.');
				exit();
			}
		
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
		
	}
?>