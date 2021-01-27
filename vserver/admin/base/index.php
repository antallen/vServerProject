<!DOCTYPE html>
<?php
	session_start();
	
	if(!$_SESSION['user']){
		header("Location:../login.php" );
	}
?>
<html>
<!-- 文件資訊 -->
<head>
<title>Vserver 管理介面--基本資料管理</title>
<link type="text/css" rel="stylesheet" href="style.css">
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
			<li><a href="./">基本資料管理</a></li>
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
			<!-- --------登入者----------------------------------------- -->
			<?php
					include_once("./module/base_data.php");
			?>
			<form action="./module/update_check.php" method="post">
			<table class="basetable">	
				<tr><td colspan='2' class="title">客戶資料內容</td></tr>
				<tr>
					<td>公司名稱</td><td><input type="text" size="70" name="com_name" value="<?php echo $row['company'];?>"></input>個人申請者免填</td>
				</tr>
				<tr>
					<td>統一編號</td><td><input type="text" size="30" name="com_id" value="<?php echo $row['com_id']; ?>"></input>個人申請者免填</td>
				</tr>
				<tr>
					<td>連絡人</td>
					<td><input type="text" size="50" name="cus_name" value="<?php echo $row['cusname']; ?>"></input></td>
				</tr>
				<tr>
					<td>身份證號碼</td>
					<td><input type="password" size="50" name="cus_id" value="<?php echo $row['cus_id']; ?>"></input>公司申請者免填</td>
				</tr>
				<tr>
					<td>連絡電話<?php $pn_array=explode("-",$row['phoneNo']); ?></td>
					<td><input type="text" size="10" name="no1" value="<?php echo $pn_array[0]; ?>"></input>-<input type="text" size="50" name="no2" value="<?php echo $pn_array[1]; ?>"></input></td>	
				</tr>
				<tr>
					<td>手機號碼</td>
					<td><input type="text" size="20" name="mobile" value="<?php echo $row['Mobilephone']; ?>"></input></td>
				</tr>	
				<tr>
					<td>連絡地址</td><td><input type="text" size="90" name="address" value="<?php echo $row['address']; ?>"></input></td>
				</tr>
				<tr>
					<td>E-mail</td><td><input type="text" size="40" name="email" value="<?php echo $row['email']; ?>"></input></td>
				</tr>
				
				<tr>
					<td colspan='2'>
						<input type="hidden" value="<?php echo $row['userID']; ?>" name="userID"></input>
						<input type="submit" value="確定修改" name="check_update"></input><input type="button" value="回上一頁" onClick="location.href='../index.php'"></input>
					</td>
				</tr>
			</table>
			</form>
			<br>
			<?php
				include_once("./module/account_data.php");
				while($row = $stmt->fetch()){
			?>
			<form action="./module/update_account.php" method="post">
			<table class="basetable">		
				<tr><td colspan='2' class="title">系統資料設定</td></tr>
				
				<tr>
					<td>系統管理帳號</td>
					<td><input type="text" size="30" name="loginname" value="<?php echo $row['loginname']; ?>"></input> 密碼：<input type="password" size="30" name="password" value="<?php echo $row['password']; ?>"></input></td>
				</tr>
				
				<tr>
					<td>
					<input type="hidden" value="<?php echo $row['ad_id']; ?>" name="ad_id"></input>
					<input type="submit" value="確定修改" name="check_update"></input><input type="button" value="回上一頁" onClick="location.href='../index.php'"></input>
					</td>
				</tr>
				
			</table>
			</form>
			<br>
			<?php 
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
