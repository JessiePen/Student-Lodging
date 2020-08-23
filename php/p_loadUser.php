<?php 
$memberNo;
$commentId = array();
$commentApt= array();
$comment = array();
$favouriteId = array();
$favouriteApt = array();
$favouriteUrl = array();
try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		//Get memberNo
		$searchUserStmt = $pdo -> prepare("SELECT * FROM member where username = :username");
		$searchUserStmt -> execute(array(
			":username" => $_SESSION['username']
		));
		while($row = $searchUserStmt -> fetch()){
			$memberNo = $row['memberNo'];
		}
		//Get user comment
		$commentStmt = $pdo -> prepare("SELECT * FROM comment where memberNo = :memberNo");
		$commentStmt -> execute(array(
			":memberNo" => $memberNo
		));
		while($row = $commentStmt -> fetch()){
			array_push($commentId,$row['commentNo']);
			array_push($commentApt,$row['apartmentName']);
			array_push($comment,$row['content']);
		}
		//Get favourite apartment
		$favouriteStmt = $pdo -> prepare("select * from favourite where memberNo = :memberNo");
		$favouriteStmt -> execute(array(
			":memberNo" => $memberNo
		));
		while($row = $favouriteStmt -> fetch()){
			array_push($favouriteId,$row['favouriteNo']);
			array_push($favouriteApt,$row['apartmentName']);
			array_push($favouriteUrl,$row['apartmentImg']);
		}
		
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"\n";
		
	}
$userDetail = array("name" => $_SESSION['username'],
					"commentApt"=>$commentApt,
					"comments"=>$comment,
					"favouriteApt"=>$favouriteApt,
					"favouriteAptImg" => $favouriteUrl,
					"commentId" =>$commentId,
					"favouriteId" => $favouriteId
					);
					
$userJson = json_encode($userDetail);
?>