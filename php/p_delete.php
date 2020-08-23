<?php 
include_once "../php/p_Config.php";

try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		if(isset($_POST['commentNo'])){
			echo $_POST['commentNo'];
			$deleteCStmt = $pdo -> prepare("DELETE FROM comment where commentNo = :commentNo");
			$deleteCStmt -> execute(array(
				":commentNo" => $_POST['commentNo']
			));
		}
		if(isset($_POST['favouriteNo'])){
			$deleteFStmt = $pdo -> prepare("DELETE FROM favourite where favouriteNo = :favouriteNo");
			$deleteFStmt -> execute(array(
				":favouriteNo" => $_POST['favouriteNo']
			));
		}
		print_r($_POST);
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}

?>