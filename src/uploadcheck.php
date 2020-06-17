<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$name = ($_POST['file']) ? $_POST['file'] : $_COOKIE['name'];
$title = $_POST['title'];
$description = $_POST['description'];
$country = $_POST['country'];
$city = $_POST['city'];
if ($title&$description&$country&$city&$name){
    $expires = time()+24*60*60;
    setcookie("name",$name,$expires,'/');
    setcookie("title",$title,$expires,'/');
    setcookie("description",$description,$expires,'/');
    setcookie("country",$country,$expires,'/');
    setcookie("city",$city,$expires,'/');
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "INSERT INTO myphoto (PATH,Title,Description,Country,City) VALUES ('$name','$title','$description','$country','$city')";
    $pdo->exec($sql);
    header("location:myphoto.php");
}else {
    echo "<script>alert('请把信息填写完整');</script>";
    echo "<script>window.location.href='upload.php';</script>";
}

?>