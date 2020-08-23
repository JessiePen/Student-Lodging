<?php 
function skip($url,$pic,$message){
$html=<<<A
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;URL={$url}" />
<title>loading</title>
<link rel="stylesheet" type="text/css" href="../php/phpStyle/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span> {$message} <a href="{$url}">Refresh in 3 seconds!</a></div>
</body>
</html>
A;
echo $html;
exit();
}
function is_login(){
	if(isset($_COOKIE['member']['username']) && isset($_COOKIE['member']['password'])){
		try{
			$pdo = new PDO($dsn,$db_username,$db_password,$opt);
			$stmt = $pdo -> prepare("SELECT * from member where username = :username And password = : password");
			$insertStmt -> execute(array(
				':username' => $_COOKIE['member']['username'],
				':password' => $_COOKIE['member']['password'],
			));
			$row = $stmt ->rowCount();
			if($row == 1){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo "PDO Error:",$e -> getMessage(),"<br>\n";
		}
	}else{
		return false;
	}
}
?>