<?php 
include_once "../php/p_Config.php";
$pName = array();
$pImg = array();
$nName = array();
$nImg = array();
$apaPNo = array();
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		//Get detail of above apartment.
		$searchPoNameStmt = $pdo -> prepare("SELECT * FROM apartment order by time desc limit 3");
		$searchPoNameStmt-> execute();
		while($row = $searchPoNameStmt -> fetch()){
			array_push($pName,$row['apartmentName']);
			array_push($pImg,$row['url1']);
		}
		//Get the latest apartment
		$searchNStmt = $pdo -> prepare("select * from apartment order by apartmentNo desc limit 3");
		$searchNStmt -> execute();
		while($row = $searchNStmt -> fetch()){
			array_push($nName,$row['apartmentName']);
      $url = str_replace("\n","",$row['url1']);
      $url = str_replace("\r","",$row['url1']);
      $url = str_replace(" ","+",$row['url1']);
			array_push($nImg,$url);
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
	$recommand = array("popularname"=>$pName,"popularimg"=> $pImg,"newestname" => $nName, "newestimg" => $nImg);
	$recommandJson = json_encode($recommand);
?>