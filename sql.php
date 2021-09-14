<?php
ob_start();
session_start(); 
	$dsn = "mysql:host=localhost;dbname=alicanada";
	$sqlusername = 'root';
	$sqlpassword = 'FUCKcwx520!@#';
	$pdo = new PDO($dsn, $sqlusername, $sqlpassword);
    if(!$pdo){
        die("can't connect".mysql_error());//如果链接失败输出错误
    }
    
?>