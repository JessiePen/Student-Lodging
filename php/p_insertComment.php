<?php 
session_start();
include_once "../php/p_Config.php";
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		
		if(isset($_SESSION['username'])){
			$searchUserStmt = $pdo -> prepare("SELECT * FROM member where username = :username");
			$searchUserStmt -> execute(array(
				":username" => $_SESSION['username']
			));
			while($row = $searchUserStmt -> fetch()){
				$memberNo = $row['memberNo'];
			}
		}
		
		if(isset($_POST['insertComment'])){
			
			$insertCommentStmt = $pdo -> prepare("INSERT INTO comment(memberNo,apartmentName,content) 
												VALUES(:memberNo,:apartmentName,:content)");
			$insertCommentStmt -> execute(array(
				":memberNo" => $memberNo,
				":apartmentName" => $_POST['apartmentName'],
				":content" =>$_POST['insertComment']
			));
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}





?>