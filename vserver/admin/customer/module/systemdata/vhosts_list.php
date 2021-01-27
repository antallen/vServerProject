<!DOCTYPE html>
<?php
	session_start();
	
	if(!$_SESSION['user']){
		header("Location:../../../login.php" );
	}
	
	$level = $_SESSION['level'];
	if($level<90){
		header("Location:../../../index.php");
	}
	
?>
<html>
<!-- 文件資訊 -->
<head>
<title>Vserver 管理介面--客戶資料管理</title>
<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<!-- 網頁標頭標語區 -->
	<section>
		<header id="mainHeader" class="header_logo">
		<!-- 上方的選單區 -->
		
		<div>
			<ul>
				
				<li>聯絡客服</li>
				<li><a href="../../../">回管理首頁</a></li>
				<li><a href="../../../../">回首頁</a></li>
				<li><a href="../../../logout.php">登出</a></li>
			</ul>
		</div>
		<h4>Vserver 管理介面--系統設定資料管理</h4>
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
			<li><a href="../../">客戶資料管理</a></li>
			<li><a href="../../">客戶使用狀況</a></li>
			<li><a href="../../">客戶繳費狀況</a></li>
			<li><a href="../../">客戶申訴資料</a></li>
			<li><a href="../../">站台統計</a></li>
		</ul>
		</aside>
	
		<!-- 首頁內容區 -->
		<section id="head_doc">
					
				<?php
					//---------看等級----------------------------
					$level = $_SESSION['level'];
			  
					if(!$level or $level > 100 or $level < 0){
						echo "<script>alert('Please login again!');location.href='../../../login.php';</script>";
					}	
				?>
			<!-- --------登入者----------------------------------------- -->
			
			<div>
				<ul>
					<li><a href="system_list.php">管理帳號列表</a></li>
					<li><a href="ftp_list.php">FTP 帳號管理</a></li>
					<li><a href="mail_list.php">Email 帳號管理</a></li>
					<li><a href="dns_list.php">DNS 設定管理</a></li>
					<li><a href="mysql_list.php">MySQL 帳號管理</a></li>
				</ul>
			</div>
			
			
			<table class="basetable2">	
				<tr>
				<td colspan=4 class="title2">&nbsp;虚擬主機資料列表 &nbsp;&nbsp;&nbsp;<a href="#add">新增站台</a>
				</td>
				</tr>	
				<tr>
				<td colspan=4><?php
						include("./vhost_module/vhost_order.php"); 
				?><br><?php
						$order_result = (int)$row[2];
						include("./vhost_module/vhost_status.php");
						$status_result = (int)$row[0];
						$reminder = $order_result - $status_result;
				?></td>
				</tr>	
				<tr>
					<td colspan=4></td>
				</tr>
					<?php
						include_once("./vhost_module/vhosts_data.php");
					?>
				
			</table>
			<br>
			<a name="add"></a>
			<?php
				if ($reminder > 0){
					include_once("./vhost_module/add_vhosts.php");
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