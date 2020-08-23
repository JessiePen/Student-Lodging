<?php
session_start();
include_once "../php/p_Config.php";
// $_POST['searchApt'];
$searchID = array();
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		if(isset($_POST['searchApt'])){
			$searchStmt = $pdo -> prepare("SELECT * FROM apartment where apartmentName Like '%".$_POST['searchApt']."%'");
			$searchStmt -> execute();
			while($row = $searchStmt -> fetch()){
				array_push($searchID,$row['apartmentNo']);
			}
			
			$_SESSION['searchApt'] = $searchID;
			echo json_encode($_SESSION['searchApt']);
			
			// header("Location: ../Homepage/Homepage.php");
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
	
?>
