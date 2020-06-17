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
setcookie("title","default",time()+24*60*60,'/');
setcookie("description","default",time()+24*60*60,'/');
function outputSingle($row){
    $name = $row['PATH'];
    echo "<figure class='a_picture'>";
    echo "<a href='details.php'><img src='../travel-images/medium/$name' width='200px' height='200px' class='pic'></a>";
    echo "<div class='data1'>";
    echo "<figcaption><h3>";
    echo $row['Title'];
    echo "</h3>";
    echo $row['Description'];
    echo "</figcaption></div></figure>";
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>搜索页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="search.css" media="all">
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
	<main>
		<div id="search">
		    <form method="post" name="select1" action="select.php">
			    <input type="radio" name="select" value="title" checked="checked" class="radio"><span class="radio-content">标题筛选</span><br>
			    <input type="text" name="title"><br>
			    <input type="radio" name="select" value="desciption" class="radio"><span class="radio-content">描述筛选</span><br>
			    <input type="text" name="description"><br>
			    <input type="submit" name="search" value="search"><br>
		    </form>
	    </div>

	    <div id="picture">
	    	<?php
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
            if ($_COOKIE['title'] != 'default' && $_COOKIE['description'] == 'default'){
                $sql = "SELECT * FROM travelimage WHERE Title LIKE '%{$_COOKIE['title']}%'";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    outputSingle($row);
                }
            } elseif($_COOKIE['title'] == 'default' && $_COOKIE['description'] != 'default'){
                $sql = "SELECT * FROM travelimage WHERE Description LIKE '%{$_COOKIE['description']}%'";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    outputSingle($row);
                }
            } else{
                echo "<figure class='a_picture'>";
                echo "<a href='details.php'><img src='../travel-images/medium/5855174537.jpg' width='200px' height='200px' class='pic'></a>";
                echo "<div class='data1'>";
                echo "<figcaption><h3>";
                echo "Grace Presbyterian Church";
                echo "</h3>";
                echo "Calgary Beltline during the first snowfall";
                echo "</figcaption></div></figure>";
                echo "<figure class='a_picture'>";
                echo "<a href='details.php'><img src='../travel-images/medium/5855209453.jpg' width='200px' height='200px' class='pic'></a>";
                echo "<div class='data1'>";
                echo "<figcaption><h3>";
                echo "Near Peggy's Cove";
                echo "</h3>";
                echo "An interesting pile of junk";
                echo "</figcaption></div></figure>";
            }
            ?>
	    </div>
	</main>
<footer><hr><p>&copyzzy iridescent</p></footer>
<script type="text/javascript" src="jquery-3.4.1.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $(".pic").click(function () {
        var location = this.getAttribute("src");
        var pic_name = location.slice(24);
        document.cookie = "name" + "=" + pic_name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
    });
});
</script>
</body>
</html>