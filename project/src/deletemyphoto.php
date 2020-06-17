<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$name = $_COOKIE['name'];
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$sql = "DELETE FROM myphoto WHERE PATH = '$name'";
$pdo->exec($sql);
header("location:myphoto.php");

?>