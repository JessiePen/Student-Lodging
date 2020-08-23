<?php 
session_start();
include_once "../php/p_Config.php";
$url;
$memberNo;
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
		
		if(isset($_POST['apartmentName'])){
			//exist
			$existStmt = $pdo -> prepare("SELECT * FROM favourite where memberNo = :memberNo and apartmentName = :apartmentName");
			$existStmt ->execute(array(
				":memberNo" => $memberNo,
				":apartmentName" => $_POST['apartmentName']
			));
			$row = $existStmt ->rowCount();
			if($row>0){
				echo 'You have already added this apartment to favourite';
			}else{
				//insert
				$searchUrlStmt = $pdo -> prepare("SELECT * From apartment where apartmentName = :apartmentName");
				$searchUrlStmt -> execute(array(
					":apartmentName" => $_POST['apartmentName']
				));
				while($row = $searchUrlStmt -> fetch()){
					$url = $row['url1'];
				}
				
				$insertFavourStmt = $pdo -> prepare("INSERT INTO favourite(apartmentName,memberNo,apartmentImg) 
													VALUES(:apartmentName,:memberNo,:apartmentImg)");
				$insertFavourStmt ->execute(array(
					":apartmentName" => $_POST['apartmentName'],
					":memberNo" => $memberNo,
					":apartmentImg" => $url
				));
        $increaseTimeStmt = $pdo -> prepare("UPDATE apartment SET time = time +1 where apartmentName = :apartmentName");
        $increaseTimeStmt -> execute(array(
          ":apartmentName" => $_POST['apartmentName']
        ));
        echo 'Successful.';
			}
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}





?>