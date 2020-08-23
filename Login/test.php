<?php 
include_once "../php/p_Config.php";
$restaurant = true;
$shop = false;
$hospital = false;
$busStop = false;
$gym = false;
$sqlR = "";

if($restaurant){
	$sqlR = "restaurant = ?";
}
if($shop){
	$sqlR = "shop = :shop";
}
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		// $sql = "SELECT * FROM surrounding where ".$sqlR;
		
		// $filterStmt = $pdo -> prepare($sql);
		// $filterStmt -> execute(array($restaurant));
		$filterStmt = $pdo -> prepare("SELECT * FROM surrounding where 
												restaurant = :restaurant
												or shop = :shop
												and hospital = :hospital
												and busStop = :busStop
												and gym = :gym
												");
		$filterStmt -> execute(array(
			":restaurant" => $restaurant,
			":shop" => $shop,
			":hospital" => $hospital,
			":busStop" => $busStop,
			":gym" => $gym,
		));
		while($row = $filterStmt -> fetch()){
			echo $row['shop'];
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
?>