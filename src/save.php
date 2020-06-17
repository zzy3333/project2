<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$like = $_COOKIE['like'];
$name = $_COOKIE['name'];
if ($like == 'like'){
    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$name'";
    $result = $pdo->query($sql1);
    $row = $result->fetch();
    $imageID = $row['ImageID'];
    $uid = $row['UID'];
    $sql2 = "INSERT INTO travelimagefavor (UID, ImageID) VALUES ('$uid','$imageID')";
    $pdo->exec($sql2);
    setcookie("like","liked",time()+24*60*60**60,'/');
    setcookie('flag5',1,time()+24*60*60*60,'/');
    header("location:details.php");
}else {
    $sql3 = "SELECT * FROM travelimage WHERE PATH = '$name'";
    $result = $pdo->query($sql3);
    $row = $result->fetch();
    $imageID = $row['ImageID'];
    $sql4 = "DELETE FROM travelimagefavor WHERE ImageID = '$imageID'";
    $pdo->exec($sql4);
    setcookie("like","like",time()+24*60*60**60,'/');
    setcookie('flag5',0,time()+24*60*60*60,'/');
    header("location:details.php");
}


?>