<?php 
include_once "../php/p_Config.php";
$apartmentNo = array();
$allInfo = array();
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		$searchApartmentId = $pdo -> prepare("SELECT * FROM apartment");
		$searchApartmentId -> execute();
		while($row = $searchApartmentId ->fetch()){
			array_push($apartmentNo,$row['apartmentNo']);
		}
		foreach($apartmentNo as $id){
				$property =getProperty($id,$pdo);
				array_push($allInfo,array($id =>$property));
			}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
	$filter = json_encode($allInfo);
	// echo $filter;
function getProperty($id,$pdo){
	$property = array();
	$searchFilterInfor1Stmt = $pdo -> prepare("SELECT * from surrounding where apartmentNo = :apartmentNo");
	$searchFilterInfor1Stmt -> execute(array(
		":apartmentNo" => $id
	));
	while($row = $searchFilterInfor1Stmt->fetch()){
		if($row['gym']){
			array_push($property,"Gym");
		}
		if($row['hospital']){
			array_push($property,"Hospital");
		}
		if($row['busStop']){
			array_push($property,"BusStop");
		}
		if($row['shop']){
			array_push($property,"Shop");
		}
		if($row['restaurant']){
			array_push($property,"Restaurant");
		}
	}
	$searchRoomTypeStmt = $pdo -> prepare("SELECT * FROM room where apartmentNo = :apartmentNo");
	$searchRoomTypeStmt -> execute(array(
		":apartmentNo" => $id
	));
	while($row = $searchRoomTypeStmt ->fetch()){
		$lowerPrice = array();
		if($row["sixToEightEnsuite"]){
			array_push($property,"sixToEightEnsuite");
			array_push($lowerPrice,$row["sixToEightEnsuite"]);
		}
		
		if($row['threeToFiveEnsuite']){
			array_push($property,"threeToFiveEnsuite");
			array_push($lowerPrice,$row["threeToFiveEnsuite"]);
		}
		if($row["classicStudio"]){
			array_push($property,"classicStudio");
			array_push($lowerPrice,$row["classicStudio"]);
		}
		if($row["premiumStudio"]){
			array_push($property,"premiumStudio");
			array_push($lowerPrice,$row["premiumStudio"]);
		}
		array_push($property,min($lowerPrice));
	}
	return $property;
}
?>