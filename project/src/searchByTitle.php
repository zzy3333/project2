<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$title = $_POST['title1'];
setcookie("flag1",1,time()+24*60*60,'/');
$expire = time()+24*60*60;
setcookie("name",$title,$expire,'/');
header("location:browser.php");

?>