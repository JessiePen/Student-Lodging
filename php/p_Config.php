<?php
//SET URL AND DATABASE
$db_hostname = "studdb.csc.liv.ac.uk";
$db_database = "sgtxie3";
$db_username = "sgtxie3";
$db_password = "";
$db_charset = "utf8mb4";
$dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";

$opt = array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false
);
?>
