<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$name = $_COOKIE['name'];
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$sql1 = "SELECT ImageID FROM travelimage WHERE PATH = '$name'";
$result1 = $pdo->query($sql1);
$row1 = $result1->fetch();
$imageID = $row1[0];
$sql2 = "DELETE FROM travelimagefavor WHERE ImageID = '$imageID'";
$pdo->exec($sql2);
header("location:favor.php");

?>