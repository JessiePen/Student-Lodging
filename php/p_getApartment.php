<?php 
include_once "../php/p_Config.php";
include_once "../php/p_all.php";
$detailJson;
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		if(isset($_SESSION['apartmentName'])){
			$property = array();
			$coordinates = array();
			$location = array();
			$link;
			$img = array();
			$content = array();
			$commentor = array();
			$property = array();
			$rent;
			$loadDetailStmt = $pdo -> prepare("SELECT * FROM apartment where apartmentName = :apartmentName");
			$loadDetailStmt -> execute(array(
				":apartmentName" => $_SESSION['apartmentName']
			));
			while($row = $loadDetailStmt -> fetch()){
				array_push($coordinates,$row['latitude']);
				array_push($coordinates,$row['longitude']);
				array_push($location,$row['address']);
				array_push($location,$row['postcode']);
				if($row['url1']){
         $url = str_replace("\n","",$row['url1']);
         $url = str_replace("\r","",$row['url1']);
         $url = str_replace(" ","+",$row['url1']);
					array_push($img,$url);
				}
				if($row['url2']){
           $url = str_replace("\n","",$row['url2']);
           $url = str_replace("\r","",$row['url2']);
           $url = str_replace(" ","+",$row['url2']);
					array_push($img,$url);
				}
				if($row['url3']){
          $url = str_replace("\n","",$row['url3']);
          $url = str_replace("\r","",$row['url3']);
          $url = str_replace(" ","+",$row['url3']);
					array_push($img,$url);
				}
				$link = $row['apartmentWeb'];
				$property = getProperty($row['apartmentNo'],$pdo);
				$rent = end($property);
				array_pop($property);
			}
			$searchCommentStmt = $pdo -> prepare("select * from comment 
													where apartmentName = :apartmentName");
			$searchCommentStmt->execute(array(
				":apartmentName" => $_SESSION['apartmentName']
			));
			while($row = $searchCommentStmt ->fetch()){
				array_push($content,$row['content']);
				$getMemberStmt = $pdo -> prepare("select * from member where memberNo = :memberNo");
				$getMemberStmt-> execute(array(
					":memberNo" => $row['memberNo']
				));
				while($memberRow = $getMemberStmt -> fetch()){
					array_push($commentor,$memberRow['username']);
				}
			}
			$detail = array("name"=>$_SESSION['apartmentName'],
							"coordinates"=> $coordinates,
							"location" => $location, 
							"image" => $img,
							"comment" => $content,
							"commentor" => $commentor,
							"link" => $link,
							"rent" => $rent,
							"property" => $property
							);
			$detailJson = json_encode($detail);
		}
		
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
?>