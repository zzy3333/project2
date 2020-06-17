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
setcookie("flag5",0,time()+24*60*60*60,'/');
if ($_COOKIE['flag5'] == 0){
    setcookie('like','like',time()+24*60*60*60,'/');
}elseif($_COOKIE['flag5'] == 1){
    setcookie('like','liked',time()+24*60*60*60,'/');
}


function showInformation(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $name = $_COOKIE['name'];
    $sql = "SELECT * FROM travelimage WHERE PATH = '$name'";
    $result = $pdo->query($sql);
    $row = $result->fetch();
    $title = $row['Title'];
    $desc = $row['Description'];
    $like = $row['UID'];
    $lati = $row['Latitude'];
    $longi = $row['Longitude'];
    $content = $row['Content'];
    echo "<figure>";
    echo "<img src='../travel-images/square-medium/$name' width='500px' height='500px' id='image'>";
    echo "<figcaption>";
    echo "<div id='name'>";
    echo "<h3>";
    echo $title;
    echo "</h3>";
    echo "</div>";
    echo "<div class='detail'>";
    echo "<table><caption>details</caption><tr><td>theme:</td><td>";
    echo $content;
    echo "</td></tr><tr><td>Latitude:</td><td>";
    echo $lati;
    echo "</td></tr><tr><td>Longitude:</td><td>";
    echo $longi;
    echo "</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "<p class='description'>";
    echo $desc;
    echo "</p>";
    echo "<div class='like'><table><tr><th>liked</th></tr><tr><td>$like</td></tr></table>";
    echo "<form method='post' action='save.php'><input type='submit' value='{$_COOKIE['like']}' id='$name'></form>";
    echo "</div>";
    echo "</figcaption>";
    echo "</figure>";
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>图片详情</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="details.css" media="all">
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
	<section>
		<div>
			<?php
            showInformation();
            ?>
		</div>
	</section>
<footer><hr><p>&copyzzy iridescent</p></footer>
<script type="text/javascript" src="jquery-3.4.1.js"></script>
<script type="text/javascript">
$(function () {
    $("input").click(function () {
        var name = this.getAttribute("id");
        document.cookie = "name" + "=" + name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
    });
});
</script>
</body>
</html>