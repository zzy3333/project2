<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$countrySelected = $_POST['country'];
$citySelected = $_POST['city'];
setcookie("country",$countrySelected,time()+24*60*60,'/');
setcookie("city",$citySelected,time()+24*60*60,'/');
setcookie("flag2",1,time()+24*60*60,'/');
header("location:browser.php")

?>