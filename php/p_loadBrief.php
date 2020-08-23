<?php 
include_once "../php/p_Config.php";
$imgUrl = array();
$apartmentName = array();
$description = array();
$apartmentId = array();
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		$searchStmt = $pdo -> prepare("SELECT * FROM apartment");
		$searchStmt -> execute();
		while($row = $searchStmt -> fetch()){
      $url = str_replace("\n","",$row['url1']);
      $url = str_replace("\r","",$row['url1']);
      $url = str_replace(" ","+",$row['url1']);
			array_push($imgUrl,"url(".$url.")");
			array_push($apartmentId,$row['apartmentNo']);
			array_push($apartmentName,$row['apartmentName']);
			array_push($description,$row['description']);
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
$apartmentInfo = array("src" => $imgUrl,"name"=>$apartmentName,"description"=>$description,"apartmentNo" =>$apartmentId);
$apartmentJson = json_encode($apartmentInfo);
?>