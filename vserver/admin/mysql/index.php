<!DOCTYPE html>
<?php
	include_once("../setup.inc.php");
	session_start();
	
	if(!$_SESSION['user']){
		header("Location:../login.php" );
	}
?>
<html>
<!-- 文件資訊 -->
<head>
<title>Vserver 管理介面-- MySQL 管理</title>
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
						echo "<li><a href='../customer/index.php'>客戶管理</a></li>";
					}
				?>
				<li>聯絡客服</li>
				<li><a href="../">回管理首頁</a></li>
				<li><a href="../../">回首頁</a></li>
				<li><a href="../logout.php">登出</a></li>
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
			<li><a href="../base">基本資料管理</a></li>
			<li><a href="../vhosts">虚擬站台管理</a></li>
			<li><a href="../dns">DNS 管理</a></li>
			<li><a href="../ftp">FTP 管理</a></li>
			<li><a href="../email">Email 管理</a></li>
			<li><a href="../mysql">MySQL 管理</a></li>
		</ul>
		<br>
		<?php
			include_once ('cus_aside.php');
		?>
		</aside>
	
		<!-- 首頁內容區 -->
		<section id="head_doc">
					
			
				<?php
					//---------看等級----------------------------
					$level = $_SESSION['level'];
			  
					if(!$level or $level > 100 or $level < 0){
						echo "<script>alert('Please login again!');location.href='../login.php';</script>";
					}
				  
				?>
            <!-- //---------登入者------------------------------------------->
			<table class="basetable">	
				<tr><td colspan=3 class="title">MySQL 帳號列表 &nbsp;&nbsp;&nbsp;&nbsp;<a href="#add">新增資料庫</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php echo $database; ?>">登入 MySQL</a></td>
				</tr>
				<tr>
					<td colspan=3><?php include_once("./module/mysql_status.php"); ?></td>
				</tr>
			</table>
			<br>
			<?php 
				include_once("./module/mysql_data.php");
			?>
			<a name="add"></a>
			<?php
				if ($database_reminder > 0){
				
					include_once("./module/add_mysql.php");
				}
			
			?>
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C)2015 vServer 經營團隊  All Right Reserved.</address>
	</footer>
</body>
</html>
