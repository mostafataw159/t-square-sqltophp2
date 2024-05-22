<?php

$dns="mysql:host=localhost; dbname=mostafa projact";
$username="root";
$pass="";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);
try{
$connect = new PDO ($dns,$username,$pass,$option);
$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $s){
echo "failed to connect" . $s->getMessage();
}


?>