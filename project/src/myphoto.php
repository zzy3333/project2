<?php
define('DBHOST', 'localhost');
define('DBNAME', 'travels');
define('DBUSER', 'root');
define('DBPASS', 'Zhangbai78945611');
define('DBCONNSTRING','mysql:host=localhost;dbname=travels');

function showDropDown(){
    echo "<div class='dropdown'><li class='nav'><button id='personal'>个人中心</button></li>		
				<div class='dropdown-content'>
					<ul class='person'>					
						<li><img src='../img/upload.png' width='25px' height='25px'><a href='upload.php'>上传  </a></li>
						<li><img src='../img/photo.png' width='25px' height='25px'><a href='myphoto.php'>我的照片</a></li>
						<li><img src='../img/favor.png' width='25px' height='25px'><a href='favor.php'>我的收藏</a></li>
						<li><img src='../img/login.png' width='25px' height='25px'><a href='logout.php'>登出</a></li>
					</ul>
				</div>
			</div>";
}
function showLogOut(){
    echo "
    <div class='dropdown'><li class='nav'><form method='post' action='login.html'><button id='personal'>登录</button></form></li></div>
    ";
}

function outputPhotos(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM myphoto";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    if ($row){
        while ($row = $result->fetch()){
            outputPhoto($row);
        }
    }else{
        echo "<p style='color: lightgoldenrodyellow;'>您还没有上传照片，赶紧点击个人中心的上传按钮增加一张吧！</p>";
    }

}

function outputPhoto($row){
    $name = $row['PATH'];
    echo "<figure class='a_picture'>";
    echo "";
    echo "<a href='details.php'>";
    echo "<img src='../travel-images/square-medium/$name' width='200px' height='200px' class='pic'>";
    echo "</a>";
    echo "<div class='data1'><figcaption><h3>";
    echo $row['Title'];
    echo "</h3>";
    echo $row['Description'];
    echo "</figcaption>";
    echo "<form method='post' class='modify' name='$name' action='upload.php'><input type='submit' name='modify' value='modify'></form>";
    echo "<form method='post' class='delete' name='$name' action='deletemyphoto.php'><input type='submit' name='delete' value='delete'></form>";
    echo "</div>";
    echo "</figure><hr>";
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>我的照片</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="myphoto.css" media="all">
</head>
<body>
<nav>
    <ul>
        <li class="nav"><img src="../img/home.png" width="30px" height="30px"></li>
        <li class="nav"><a href="../index.php" class="home">首页</a></li>
        <li class="nav"><a href="browser.php" class="home">浏览页</a></li>
        <li class="nav"><a href="search.php" class="home">搜索页</a></li>
        <li class="nav" id="nav_person"><img src="../img/personal.png" width="30px" height="30px"></li>
        <?php
        if (isset($_COOKIE['username'])){
            showDropDown();
        }else {
            showLogOut();
        }
        ?>
    </ul>
</nav>
	<section id="picture">
		<?php
        outputPhotos();
        ?>
	</section>
<footer><hr><p>&copyzzy iridescent</p></footer>
<script type="text/javascript" src="jquery-3.4.1.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".pic").click(function () {
            var location = this.getAttribute("src");
            var pic_name = location.slice(31);
            document.cookie = "name" + "=" + pic_name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
        });
        $(".delete").click(function () {
            var image = this.getAttribute('name');
            document.cookie = "name" + "=" + image + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
        });
        $(".modify").click(function () {
            var image = this.getAttribute('name');
            document.cookie = "name" + "=" + image + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
            document.cookie = "flag6" + "=" + 1 + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
        });
    });
</script>
</body>
</html>