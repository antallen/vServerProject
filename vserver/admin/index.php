<!DOCTYPE html>
<?php
	session_start();
	
	if(!$_SESSION['user']){
		header("Location:login.php" );
	}
?>
<html>
<!-- 文件資訊 -->
<head>
<title>Vserver 管理介面</title>
<link type="text/css" rel="stylesheet" href="./style.css">
</head>
<body>
	<!-- 網頁標頭標語區 -->
	<section>
		<header id="mainHeader" class="header_logo">
		<!-- 上方的選單區 -->
		
		<div>
			<ul>
				<!-- 最高權限的使用者才可以使用 -->
				<?php
					if ($_SESSION['level'] > 90){
						echo "<li><a href='./customer/index.php'>客戶管理</a></li>";
					}
				?>
				<li>聯絡客服</li>
				<li><a href="../../">回首頁</a></li>
				<li><a href="logout.php">登出</a></li>
			</ul>
		</div>
		<h4>Vserver 管理介面</h4>
		<div>
		<?php
			echo '<strong>登入者：</strong>' . $_SESSION['user'];
		?>
		</div>
		</header>
	</section>
	
	<div class="sub">
	<!-- 側邊欄位區 -->
		<aside>
		
		<ul class="aside">
			<li><a href="./base">基本資料管理</a></li>
			<li><a href="./vhosts">虚擬站台管理</a></li>
			<li><a href="./dns">DNS 管理</a></li>
			<li><a href="./ftp">FTP 管理</a></li>
			<li><a href="./email">Email 管理</a></li>
			<li><a href="./mysql">MySQL 管理</a></li>
		</ul>
		<br>
		<ul class="aside">
			<li><a href="./">使用狀況總覽</a></li>
			<li><a href="./">帳單與繳費</a></li>
			<li><a href="./">站台使用統計</a></li>
		</ul>
		</aside>
	
		<!-- 首頁內容區 -->
		<section id="head_doc">
					
			
				<?php
					//---------看等級----------------------------
					$level = $_SESSION['level'];
			  
					if(!$level or $level > 100 or $level < 0){
						echo "<script>alert('Please login again!');location.href='login.php';</script>";
					}
				  
					//---------登入者-------------------------------------------
					//echo '<h4>個人資料</h4>' . '<br>';	
				?>
            <h4>站台公告：</h4>
			<p>1.本站目前的IP：118.163.161.176，請將www、ftp的 A 記錄，指到這個IP！
			<p>2.有需要使用本站 E-mail的客戶，請將 MX 記錄，指到這個IP位置！
			<p>3.目前本站尚未開放自行設定 DNS 代管服務！有需要代管DNS的客戶，請洽服務人員！
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C)2015 vServer 經營團隊  All Right Reserved.</address>
	</footer>
</body>
</html>
