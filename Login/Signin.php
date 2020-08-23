<?php
include_once '../php/p_Config.php';
include_once '../php/inc/tool.inc.php';

if(isset($_POST['signSubmit'])){
	include_once '../php/p_sign.php';
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
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail2">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name ="username">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
        </div>

        <button type="submit" class="btn btn-primary" name = 'signSubmit'>Sign in</button>
    </form>
</div>
</body>
</html>


