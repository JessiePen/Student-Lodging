<?php 
session_start();
$name = "";
$website = "";
$address = "";
$postcode = "";
$roomType = array();
$price = "";
$url1 = "";
$url2 = "";
$url3 = "";
$longitude =0;
$latitude = 0;
$description = '';
$shop = 0;
$busStop = 0;
$gym = 0;
$hospital = 0;
$resturant = 0;
$apartmentNo;
$price = array();
if(isset($_POST['pName'])){
	$name = $_POST['pName'];
}
if(isset($_POST['website'])){
	$website = $_POST['website'];
}
if(isset($_POST['address'])){
	$address = $_POST['address'];
}
if(isset($_POST['postcode'])){
	$postcode = $_POST['postcode'];
}
if(isset($_POST['price'])){
	$price = $_POST['price'];
}
if(isset($_POST['Price'])){
	$price = $_POST['Price'];
}
if(isset($_POST['description'])){
	$description = $_POST['description'];
}
if(isset($_SESSION['url1'])){
	$url1 = $_SESSION['url1'];
}
if(isset($_SESSION['url2'])){
	$url2 = $_SESSION['url2'];
}
if(isset($_SESSION['url3'])){
	$url3 = $_SESSION['url3'];
}
if(isset($_SESSION['longitude'])){
	$longitude = $_SESSION['longitude'];
}
if(isset($_SESSION['latitude'])){
	$latitude = $_SESSION['latitude'];
}
if(isset($_POST['surrounding']['shop'])){
	$shop = true;
}
if(isset($_POST['surrounding']['resturant'])){
	$resturant = true;
}
if(isset($_POST['surrounding']['gym'])){
	$gym = true;
}
if(isset($_POST['surrounding']['hospital'])){
	$hospital = true;
}
if(isset($_POST['surrounding']['busStop'])){
	$busStop = true;
}

print_r($_POST);

include_once "../php/p_Config.php";
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		//insert into apartment table
		$insertApartmentStmt = $pdo -> prepare("INSERT INTO apartment(apartmentName,apartmentWeb,postcode,address,description,url1,url2,url3,longitude,latitude,time) 
												VALUES(:apartmentName,
														:apartmentWeb,
														:postcode,
														:address,
														:description,
														:url1,
														:url2,
														:url3,
														:longitude,
														:latitude,
                            0
														)");
		$insertApartmentStmt -> execute(array(
			":apartmentName" =>$name,
					":apartmentWeb" => $website,
					":postcode" => $postcode,
					":address" => $address,
					":description" => $description,
					":url1" => $url1,
					":url2" => $url2,
					":url3" => $url3,
					":longitude" => $longitude,
					":latitude" => $latitude
		));
		
		$aptNoStmt = $pdo ->prepare("SELECT * from apartment where apartmentName = 
																	:apartmentName");
		$aptNoStmt -> execute(array(
			":apartmentName" => $name
		));
		while($row = $aptNoStmt -> fetch()){
			$apartmentNo = $row['apartmentNo'];
		}
		//insert into surrounding table
		$insertSurrounding = $pdo ->prepare("INSERT INTO surrounding(busStop,
											gym,hospital,shop,restaurant,apartmentNo) 
											VALUES(
											:busStop,
											:gym,
											:hospital,
											:shop,
											:restaurant,
											:apartmentNo
											)");
		
		$insertSurrounding -> execute(array(
			":busStop" => $busStop,
			":gym" => $gym,
			":hospital" => $hospital,
			":shop" => $shop,
			":restaurant" => $resturant,
			"apartmentNo" => $apartmentNo
		));
		
// 		//insert into room table
		if(isset($_POST['roomType']) && isset($_POST['price'])){
			$insertNewRoomRow = $pdo -> prepare("INSERT INTO room(apartmentNo) VALUE(:apartmentNo)");
			$insertNewRoomRow -> execute(array(
				":apartmentNo" => $apartmentNo
			));
			for($x = 0; $x < count($_POST['roomType']);$x++){
				addRoom($_POST['roomType'][$x],$_POST['price'][$x],$pdo,$apartmentNo);
			}
		}
		
		header("Location: ../Homepage/Homepage.php");
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
	}
function addRoom($type,$price,$pdo,$apartmentNo){
	if($type == "3-5En-suite"){
		$insertRoomStmt = $pdo -> prepare("UPDATE room SET threeToFiveEnsuite = :price WHERE apartmentNo = :apartmentNo");
		$insertRoomStmt -> execute(array(
			":price" => $price,
			":apartmentNo" => $apartmentNo
		));
	}
	if($type == "6-8En-suite"){
		$insertRoomStmt = $pdo -> prepare("UPDATE room SET sixToEightEnsuite = :price WHERE apartmentNo = :apartmentNo");
		$insertRoomStmt -> execute(array(
			":price" => $price,
			":apartmentNo" => $apartmentNo
		));
	}
	if($type == "ClassicStudio"){
		$insertRoomStmt = $pdo -> prepare("UPDATE room SET classicStudio = :price WHERE apartmentNo = :apartmentNo");
		$insertRoomStmt -> execute(array(
			":price" => $price,
			":apartmentNo" => $apartmentNo
		));
	}
	if($type == "PremiumStudio"){
		$insertRoomStmt = $pdo -> prepare("UPDATE room SET premiumStudio = :price WHERE apartmentNo = :apartmentNo");
		$insertRoomStmt -> execute(array(
			":price" => $price,
			":apartmentNo" => $apartmentNo
		));
	}		
}
?>