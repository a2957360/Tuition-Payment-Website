<?php
	ob_start();
	session_start(); 
	$dsn = "mysql:host=localhost;dbname=shop";
	$sqlusername = 'root';
	$sqlpassword = 'root';
	$pdo = new PDO($dsn, $sqlusername, $sqlpassword);
    if(!$pdo){
        die("can't connect".mysql_error());//如果链接失败输出错误
    }
?>