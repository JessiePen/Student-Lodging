<?php
header('Content-type:text/html; charset = utf-8');

//SET URL AND DATABASE
	try{
		$pdo = new PDO($dsn,$db_username,$db_password,$opt);
		if(isset($_POST['signSubmit'])){
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			if (empty($username) || empty($email)|| empty($password)) {
				skip('../Login/Signin.php','error','There is empty field.');
				exit();
			}else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				skip('../Login/Signin.php','error','The email is invalid.');
				exit();
			}else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
				skip('../Login/Signin.php','error','The username is invalid.');
				exit();
			}else{
				$stmt = $pdo -> prepare("select * from member WHERE username = :username");
				$stmt -> execute(array(
				':username' => $username
				));
				$row = $stmt ->rowCount();
				//exist username
				if($row > 0){
					skip('../Login/Signin.php','error','The username has been registered.');
					exit();
				}else{
					$insertStmt = $pdo -> prepare("INSERT INTO member(username,password,email) VALUES(:username,:password,:email)");
					$insertStmt -> execute(array(
						':username' => $username,
						':password' => md5($password),
						':email' => $email
					));
					skip('../Login/Login.php','ok','Register sucessful');
					exit();
				}
			}
		}
		$pdo = NULL;
		}catch(PDOException $e){
		echo "PDO Error:",$e -> getMessage(),"<br>\n";
		
	}
?>