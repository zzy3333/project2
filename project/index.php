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
						<li><img src='img/upload.png' width='25px' height='25px'><a href='src/upload.php'>上传  </a></li>
						<li><img src='img/photo.png' width='25px' height='25px'><a href='src/myphoto.php'>我的照片</a></li>
						<li><img src='img/favor.png' width='25px' height='25px'><a href='src/favor.php'>我的收藏</a></li>
						<li><img src='img/login.png' width='25px' height='25px'><a href='src/logout.php'>登出</a></li>
					</ul>
				</div>
			</div>";
}
function showLogOut(){
    echo "
    <div class='dropdown'><li class='nav'><form method='post' action='src/login.html'><button id='personal'>登录</button></form></li></div>
    ";
}

function outputPaintings1(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage ORDER BY UID DESC limit 0,3";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        outputSinglePainting($row);
    }
    $pdo = null;
}

function outputPaintings2(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage ORDER BY UID DESC limit 3,3";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        outputSinglePainting($row);
    }
    $pdo = null;
}

function outputPaintingsRandom(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage ORDER BY rand() limit 3";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        outputSinglePainting($row);
    }
    $pdo = null;
}

function outputSinglePainting($row){
    echo '<td>';
    echo '<figure>';
    echo '<a href="src/details.php">';
    echo '<img src=travel-images/square-medium/'.$row['PATH'].' width="130px" height="130px" class="pic">';
    echo '</a>';
    echo '<figcaption>';
    echo '<h4>';
    echo $row['Title'];
    echo '</h4>';
    echo $row['Description'];
    echo '</figcaption>';
    echo '</figure>';
    echo '</td>';
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>首页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="src/reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="src/index.css" media="all">
</head>
<body>
	<nav>
		<ul>
			<li class="nav"><img src="img/home.png" width="30px" height="30px"></li>
			<li class="nav"><a href="index.php" class="home">首页</a></li>
			<li class="nav"><a href="src/browser.php" class="home">浏览页</a></li>
			<li class="nav"><a href="src/search.php" class="home">搜索页</a></li>
			<li class="nav" id="nav_person"><img src="img/personal.png" width="30px" height="30px"></li>
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
		<figure id="main_image">
			<img src="img/9505536014.jpg" width="1200px" height="100px">
		</figure>
		<div>
			<table>
				<tr>
				    <?php
                        outputPaintingsRandom();
                        echo "</tr>";
                        echo "<tr>";
                        outputPaintingsRandom();
                    ?>
				</tr>
			</table>
		</div>
		<div class="refresh">
			<img src="img/refresh.png" width="30px" height="30px">
		</div>
		<div class="top">
			<span title="Top" id="topArrow"><img src="img/totop.png"></span>
		</div>
	</section>
    <script type="text/javascript" src="src/jquery-3.4.1.js"></script>
	<script type="text/javascript">
		$("#topArrow").click(function(){
			$(document).scrollTop(0);
		});
		var topArrow=document.getElementById('topArrow');
		topArrow.οnclick=function(){
			document.scrollTop = document.body.scrollTop =0;
		}
		var topArrow=document.getElementById('topArrow');
		var img2=document.getElementById('img2');
		topArrow.οnclick=function(){
			var h=img2.offsetTop;
			document.body.scrollTop=h;
		}

		$(".pic").click(function () {
            var location = this.getAttribute("src");
            var pic_name = location.slice(28);
            document.cookie = "name" + "=" + pic_name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
        });

		$(".refresh").click(function () {
		    location.reload(true);
        });
	</script>
<footer><hr><p>&copyzzy iridescent</p></footer>
</body>
</html>