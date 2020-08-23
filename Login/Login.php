<?php 
if(isset($_POST['submit'])){
	include_once '../php/p_valiUser.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link type="text/css" rel="stylesheet" href="../bootstrapFile/bootstrap.min.css">
    <style type="text/css">
        .container{
            margin: 150px auto;
            width: 400px;
        }
    </style>

</head>
<body>

<div id="heading">
    <img src="../Homepage/Homepage_img/header.png" alt="" style="width: 100%" ; height="100%"/>
</div>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail2">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name ="username">
            <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <a href="Signin.php">
            Click here to register<br><br>
        </a>

        <button type="submit" class="btn btn-primary" name = "submit">Log in</button>

    </form>
</div>
</body>
</html>
