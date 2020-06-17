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
setcookie("flag1",0,time()+24*60*60,'/');
setcookie("flag2",0,time()+24*60*60,'/');
setcookie("flag3",0,time()+24*60*60,'/');
setcookie("flag4",0,time()+24*60*60,'/');
function outputByTitle(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM travelimage WHERE Title LIKE '%{$_COOKIE['name']}%'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        outputApainting($row);
    }
}

function outputApainting($row){
    $name1 = $row['PATH'];
    echo "<figure class='a_picture'>";
    echo "<a href='details.php'>";
    echo "<img src='../travel-images/medium/$name1' width='550px' height='200px' class='pic'>";
    echo "</a>";
    echo "</figure>";
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>浏览页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="browser.css" media="all">
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
	<aside>
		<div><h3>标题预览</h3>
			<form method="post" name="title" action="searchByTitle.php">
				<span>输入标题：</span><input type="text" name="title1"><br>
				<input type="submit" name="search" value="search" class="sub"><br>
			</form>
		</div>
		<div><h3>热⻔国家快速浏览</h3>
			<ul>
				<li class="hot1">Canada</li>
				<li class="hot1">United States</li>
				<li class="hot1">Italy</li>
			</ul>
		</div>
		<div><h3>热⻔城市快速浏览</h3>
			<ul>
				<li class="hot2">Firenze</li>
				<li class="hot2">London</li>
				<li class="hot2">Calgary</li>
			</ul>
		</div>
	</aside>
	<main>
		<div id="select">
			<form method="post" name="form1" action="searchByCity.php">
                <select><option>scenery</option></select>
				<select name="country" onchange="getcity()" id="country">
					<option value="">选择国家</option>
					<option value="China">China</option>
					<option value="Japan">Japan</option>
					<option value="Italy">Italy</option>
					<option value="United States">America</option>
				</select>
				<select name="city" id="city">
					<option>选择城市</option>
				</select>
				<input type="submit" name="select" value="submit" class="sub" id="search">
			</form>
		</div>
		<div id="picture">
			<?php
            if ($_COOKIE['flag1'] == 1){
                outputByTitle();
            } elseif ($_COOKIE['flag2'] == 1){
                setcookie("flag2",0,time()+24*60*60,'/');
                outputByCity();
            } elseif ($_COOKIE['flag3'] == 1){
                setcookie("flag3",0,time()+24*60*60,'/');
                outputByHotCountry();
            } elseif ($_COOKIE['flag4'] == 1){
                setcookie("flag4",0,time()+24*60*60,'/');
                outputByHotCity();
            }
            else {
                echo "<figure class='a_picture'>";
                echo "<a href='details.php'>";
                echo "<img src='../travel-images/medium/5855174537.jpg' width='550px' height='200px' class='pic'>";
                echo "</a>";
                echo "</figure>";
                echo "<figure class='a_picture'>";
                echo "<a href='details.php'>";
                echo "<img src='../travel-images/medium/5855209453.jpg' width='550px' height='200px' class='pic'>";
                echo "</a>";
                echo "</figure>";
            }
            ?>
		</div>
	</main>

<div id="footer"><footer><hr><p>&copyzzy iridescent</p></footer></div>

<script type="text/javascript" src="jquery-3.4.1.js"></script>
<script type="text/javascript">
        var city=[['Shanghai','Kunming','Beijing','Yantai'],
            ['Tokyo', 'Osaka', 'Kamakura'],
            ['Roma','Milan','Venice','Florence'],
            ['New York','San Francisco', 'Washington']];
        function getcity(){
            var sltCountry=document.form1.country;
            var sltCity=document.form1.city;
            var country=city[sltCountry.selectedIndex-1];
            sltCity.length=1;
            for(var i=0;i<country.length;i++){
                sltCity[i+1]=new Option(country[i],country[i]);
            }
        }

        $(document).ready(function () {
            $(".pic").click(function () {
                var location = this.getAttribute("src");
                var pic_name = location.slice(24);
                document.cookie = "name" + "=" + pic_name + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
            });

            $(".hot1").click(function () {
                var hotCountry = this.innerHTML;
                document.cookie = "hotCountry" + "=" + hotCountry + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
                window.location.href = 'searchByHotCountry.php';
            });
            $(".hot2").click(function () {
                var hotCity = this.innerHTML;
                document.cookie = "hotCity" + "=" + hotCity + "; " + "expires=Thu, 18 Dec 2043 12:00:00 GMT; path=/";
                window.location.href = 'searchByHotCity.php';
            });
        });
</script>
<?php
function outputByCity(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $country = $_COOKIE['country'];
    $sql1 = "SELECT ISO FROM geocountries WHERE CountryName = '$country'";
    $result1 = $pdo->query($sql1);
    $row1 = $result1->fetch();
    $countryISO = $row1[0];
    $sql2 = "SELECT GeoNameID FROM geocities WHERE CountryCodeISO = '$countryISO'";
    $result2 = $pdo->query($sql2);
    $row2 = $result2->fetchAll();
    for ($i = 0; $i < count($row2);$i++){
        $code = $row2[$i][0];
        $sql3 = "SELECT * FROM travelimage WHERE CityCode = $code";
        $result3 = $pdo->query($sql3);
        $row3 = $result3->fetchAll();
        for ($j = 0; $j < count($row3);$j++){
            outputApainting($row3[$j]);
        }
    }
}

function outputByHotCountry(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $hotCountry = $_COOKIE['hotCountry'];
    $sql1 = "SELECT ISO FROM geocountries WHERE CountryName = '$hotCountry'";
    $result1 = $pdo->query($sql1);
    $row1 = $result1->fetch();
    $countryISO = $row1[0];
    $sql2 = "SELECT * FROM travelimage WHERE CountryCodeISO = '$countryISO'";
    $result2 = $pdo->query($sql2);
    $row2 = $result2->fetchAll();
    for ($i = 0; $i < count($row2); $i++){
        outputApainting($row2[$i]);
    }
}

function outputByHotCity(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $hotCity = $_COOKIE['hotCity'];
    $sql1 = "SELECT GeoNameID FROM geocities WHERE AsciiName = '$hotCity'";
    $result1 = $pdo->query($sql1);
    $row1 =$result1->fetchAll();
    $code = $row1[0][0];
    $sql2 = "SELECT * FROM travelimage WHERE CityCode = $code";
    $result2 = $pdo->query($sql2);
    $row2 = $result2->fetchAll();
    for ($i = 0; $i < count($row2); $i++){
        outputApainting($row2[$i]);
    }
}

?>
</body>
</html>