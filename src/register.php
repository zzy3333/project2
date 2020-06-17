<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);

$pdo->exec('set names utf8');

        $user = $_POST["username"];
        $email = $_POST['email'];
        $pass = $_POST["password"];
        $re_pass = $_POST["passwordconfirm"];

        if($user == ""||$pass == ""||$email == ""){
            //用户名or密码为空
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名或密码或邮箱不能为空！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.html"."\""."</script>";
            exit;
        }
        if($pass == $re_pass){
            $sql_insert = "INSERT INTO traveluser (UserName,Email,Pass) VALUES ('$user','$email','$pass')";

            $query = $pdo->exec($sql_insert);
            //跳转注册成功页面
            header("location:login.html");
        }
        else{
            //两次密码输入不一致
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."两次密码输入不一致！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.html"."\""."</script>";
            exit;
        }



?>