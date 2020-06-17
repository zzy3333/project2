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

function showFavors(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimagefavor";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    if ($row){
        while ($row = $result->fetch()){
            showfavor($row);
        }
        $pdo = null;
    }else{
        echo "<p style='color: lightgoldenrodyellow;'>您还没有收藏照片，赶紧收藏一张吧！</p>";
    }
}

function showfavor($row){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $img = $row['ImageID'];
    $sql = "SELECT * FROM travelimage WHERE ImageID = $img";
    $result1 = $pdo->query($sql);
    $row1 = $result1->fetch();
    $name = $row1['PATH'];
    //setcookie($name,"$name",time()+24*60*60,'/');
    echo "<figure class='a_picture'>";
    echo "<a href='details.php'>";
    echo "<img src='../travel-images/square-medium/$name' width='340px' height='340px' class='pic'>";
    echo "<a>";
    echo "<div class='data1' id='$name'><figcaption><h3>";
    echo $row1['Title'];
    echo "</h3>";
    echo $row1['Description'];
    echo "</figcaption>";
    echo "<form method='post' action='deletefavor.php' class='delete'><input type='submit' value='delete'></form>";
    echo "</div>";
    echo "</figure><hr>";
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>我的收藏</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="favor.css" media="all">
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
            showFavors();
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
        var name = this.parentNode.getAttribute('id');
        document.cookie = "name" + "=" + name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
    });
});
</script>
</body>
</html>