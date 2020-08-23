<?php 
include_once "../php/p_Config.php";
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		

			// $searchUserStmt = $pdo -> prepare("SELECT * FROM room");
			// $searchUserStmt -> execute();
			// while($row = $searchUserStmt -> fetch()){
			// 	$CE = $row['classicEnsuite'];
			// 	$PE = $row['premiumEnsuite'];
			// 	$three = $row['3-5en-suite'];
			// 	$six = $row['6-8en-suite'];
			// }
			// echo $CE;
			// echo $PE;
			// echo $three;
			// echo $six;
				$id = 1;
				$property = array();
				$searchRoomTypeStmt = $pdo -> prepare("SELECT * FROM room where apartmentNo = :apartmentNo");
				$searchRoomTypeStmt -> execute(array(
					":apartmentNo" => $id
				));
				while($row = $searchRoomTypeStmt ->fetch()){
						// print_r($row);
						array_push($property,$row["classicStudio"]);
						array_push($property,$row["6-8ensuite"]);
						array_push($property,$row["3-5ensuite"]);
						array_push($property,$row["premiumStudio"]);
				}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
?>