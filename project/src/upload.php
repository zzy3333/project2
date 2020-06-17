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
setcookie("flag6",0,time()+24*60*60*60,'/');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>上传页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="upload.css" media="all">
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
		<div id="upload">
            <form method="post" name="upload2" action="uploadcheck.php">
                <?php
                if ($_COOKIE['flag6'] == 0){
                    echo '<img src="" class="suggestImg" width="100px" height="100px">
                <input id="file0" type="file" class="clip" name="file">
                <label for="file0" class="button">上传</label>
				<p>图片标题：</p><input type="text" name="title">
				<p>图片描述：</p><input type="textarea" name="description">
				<p>拍摄国家：</p><input type="text" name="country">
				<p>拍摄城市：</p><input type="text" name="city"><br>
				<input type="submit" name="submit" value="upload" class="submit">';
                }else{
                    $name = $_COOKIE['name'];
                    echo "<img src='../travel-images/square-medium/$name' class='suggestImg' width='100px' height='100px'>
                <input id='file0' type='file' class='clip' name='file'>
                <label for='file0' class='button'>修改</label>
				<p>图片标题：</p><input type='text' name='title'>
				<p>图片描述：</p><input type='textarea' name='description'><br>
				<select>
				<option value=''>选择主题</option>
				<option value='Scenery'>Scenery</option>
				<option value='City'>City</option>
				<option value='People'>People</option>
				<option value='Animal'>Animal</option>
				<option value='Building'>Building</option>
				<option value='Wonder'>Wonder</option>
				<option value='Other'>Other</option>
				</select>
				<select name='country' onchange='getcity()' id='country'>
					<option value=''>选择国家</option>
					<option value='China'>China</option>
					<option value='Japan'>Japan</option>
					<option value='Italy'>Italy</option>
					<option value='United States'>America</option>
				</select>
				<select name='city' id='city'>
					<option>选择城市</option>
				</select><br>
				<input type='submit' name='submit' value='upload' class='submit'>";
                }
                ?>

			</form>
		</div>
	</section>
	<script type="text/javascript" src="jquery-3.4.1.js"></script>
	<script type="text/javascript">
        var city=[['Shanghai','Kunming','Beijing','Yantai'],
            ['Tokyo', 'Osaka', 'Kamakura'],
            ['Roma','Milan','Venice','Florence'],
            ['New York','San Francisco', 'Washington']];
        function getcity(){
            var sltCountry=document.upload2.country;
            var sltCity=document.upload2.city;
            var country=city[sltCountry.selectedIndex-1];
            sltCity.length=1;
            for(var i=0;i<country.length;i++){
                sltCity[i+1]=new Option(country[i],country[i]);
            }
        }
	</script>
	<script type="text/javascript">
        $(function () {
            $("#file0").change(function(){
                var objUrl = getObjectURL(this.files[0]) ;
                if (objUrl) {
                    $(".suggestImg").attr("src", objUrl) ;
                }
            }) ;
        });
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }
	</script>
<footer><hr><p>&copyzzy iridescent</p></footer>
</body>
</html>