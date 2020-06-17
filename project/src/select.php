<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

if ($_POST['title']){
    setcookie("title",$_POST['title'],time()+24*60*60,'/');
}
if ($_POST['description']){
    setcookie("description",$_POST['description'],time()+24*60*60,'/');
}

header("location:search.php");

?>