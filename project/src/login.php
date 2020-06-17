<?php

define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
//very simple (and insecure) check of valid credentials.
$sql = "SELECT UserName,Pass FROM traveluser";

$result = $pdo->query($sql);

foreach ($result as $row) {
    if ($_POST["username"] == $row['UserName'] && $_POST["password"] == $row['Pass']) {
        if (!isset($_COOKIE['username'])) {
            $expiryTime = time() + 24 * 60 * 60;
            setcookie('username', $_POST['username'], $expiryTime, '/');
        }
        header("location:../index.php");
        die("stop");
    }
}

echo "<script>alert('用户名或密码错误');history.back();</script>";


?>