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
<link type="text/css" rel="stylesheet" href="../style.css">
</head>
<body>
	<!-- 網頁標頭標語區 -->
	<section>
		<header id="mainHeader" class="header_logo">
		<!-- 上方的選單區 -->
		
		<div>
			<ul>
				<li>聯絡客服</li>
				<li><a href="../../">回管理首頁</a></li>
				<li><a href="../../../">回首頁</a></li>
				<li><a href="../../logout.php">登出</a></li>
			</ul>
		</div>
		<h4>Vserver 管理介面--租用資料管理</h4>
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
			<li><a href="../">客戶資料管理</a></li>
			<li><a href="../">客戶使用狀況</a></li>
			<li><a href="../">客戶繳費狀況</a></li>
			<li><a href="../">客戶申訴資料</a></li>
			<li><a href="../">站台統計</a></li>
		</ul>
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
			<!-- --------登入者----------------------------------------- -->
			<?php
				if (!isset($_POST['q'])){
					header("Location:../index.php" );
				} else {
					$user_ID = $_POST['q'];
				
				}
			?>					
			<table class="basetable">
				<tr><td colspan=2 class="title">管理帳號列表</td>
				</tr>
				<tr>
					<td>帳號名稱</td>
					<td>建造日期</td>
				</tr>
				<?php
					include_once("./rentdata/rent_account_list.php");
				?>
				<tr>
				<td colspan=2>* 想要修改管理帳號與密碼，請至客戶資料管理-->基木資料內修改！
				</td>
				</tr>
            </table>
			<br>
			<form action="./move/add_vhosts.php" method="post">
			<table class="basetable">
				<tr><td colspan=4 class="title">網頁空間租用列表</td>
				</tr>
				<tr>
					<td width=100>站台數量</td>
					<td>租用起始日期</td>
					<td>租用到期日</td>
					<td>資料異動</td>
				</tr>
				<?php
					include_once("./rentdata/rent_vhosts_list.php");
				?>
				
				<tr>
					<td colspan=4>* 網頁總空間與 FTP 總空間大小相同</td>
				</tr>
            </table>
			</form>
			<br>
			<form action="./move/add_ftp.php" method="post">
			<table class="basetable">
				<tr><td colspan=5 class="title">FTP 租用資料列表</td>
				</tr>
				<tr>
					<td>帳號數量</td>
					<td>總空間大小(MB)</td>
					<td>租用起始日期</td>
					<td>租用到期日</td>
					<td>資料異動</td>
				</tr>
				<?php
					include_once("./rentdata/rent_ftp_list.php");
				?>
				
            </table>
			</form>
			<br>
			<form action="./move/add_email.php" method="post">
			<table class="basetable">
				<tr><td colspan=5 class="title">Email 租用資料列表</td>
				</tr>
				<tr>
					<td>信箱數量</td>
					<td>每個信箱大小(MB)</td>
					<td>租用起始日期</td>
					<td>租用到期日</td>
					<td>資料異動</td>
				</tr>
				<?php
					include_once("./rentdata/rent_mail_list.php");
				?>
				
            </table>
			</form>
			<br>
			<form action="./move/add_mysql.php" method="post">
			<table class="basetable">
				<tr><td colspan=4 class="title">MySQL 租用資料列表</td>
				</tr>
				<tr>
					<td>可使用數量</td>
					<td>租用起始日期</td>
					<td>租用到期日</td>
					<td>資料異動</td>
				</tr>
				<?php
					include_once("./rentdata/rent_mysql_list.php");
				?>
				
            </table>
			</form>
			<br>
			<form action="./move/add_dns.php" method="post">
			<table class="basetable">
				<tr><td colspan=6 class="title">DNS 租用資料列表</td>
				</tr>
				<tr>
					<td>主網域數量</td>
					<td>次網域數量</td>
					<td>主機數量</td>
					<td>租用起始日期</td>
					<td>租用到期日</td>
					<td>資料異動</td>
				</tr>
				<?php
					include_once("./rentdata/rent_dns_list.php");
				?>
								
            </table>
			</form>
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C)2015 vServer 經營團隊  All Right Reserved.</address>
	</footer>
</body>
</html>
