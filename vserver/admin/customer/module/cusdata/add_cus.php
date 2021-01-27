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
		<h4>Vserver 管理介面--客戶管理</h4>
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
		
		<br>
		<ul class="aside">
			<li><a href="../../">客戶資料管理</a></li>
			<li><a href="../../">客戶使用狀況</a></li>
			<li><a href="../../">客戶繳費狀況</a></li>
			<li><a href="../../">客戶申訴資料</a></li>
			<li><a href="../..">站台統計</a></li>
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
						
			<form action="add_cus_check.php" method="post">
			<table class="basetable">	
				<tr><td colspan='2' class="title">新增客戶資料</td></tr>
				<tr>
					<td width="120">公司名稱</td><td><input type="text" size="70" name="com_name"></input>個人申請者免填</td>
				</tr>
				<tr>
					<td>統一編號</td><td><input type="text" size="30" name="com_id"></input>個人申請者免填</td>
				</tr>
				<tr>
					<td>連絡人</td>
					<td><input type="text" size="50" name="cus_name"></input></td>
				</tr>
				<tr>
					<td>身份證號碼</td>
					<td><input type="text" size="50" name="cus_id"></input>公司申請者免填</td>
				</tr>
				<tr>
					<td>連絡電話</td>
					<td><input type="text" size="10" name="no1"></input>-<input type="text" size="50" name="no2"></input></td>	
				</tr>
				<tr>
					<td>手機號碼</td>
					<td><input type="text" size="20" name="mobile"></input></td>
				</tr>	
				<tr>
					<td>連絡地址</td><td><input type="text" size="90" name="address"></input></td>
				</tr>
				<tr>
					<td>E-mail</td><td><input type="text" size="40" name="email"></input></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr><td colspan='2' class="title">系統資料設定</td></tr>
				<tr>
					<td colspan='2'>會員編號 (目前最後一個編號：<?php require_once("cus_no_compute.php"); ?>)</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" size="30" name="userID"></input></td>	
				</tr>
				<tr>
					<td>系統管理帳號</td>
					<td><input type="text" size="30" name="loginname"></input> 密碼：<input type="text" size="30" name="password"></input></td>
				</tr>
				<tr><td colspan=2>系統基本路徑請至「客戶資料管理」-->「系統資料設定」內指定</td>
				</tr>
			</table>
				<input type="submit" value="送出"></input><input type="reset" value="重設"></input>
			</form>
			
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C) 無料文件網  宜明資訊有限公司  All Right Reserved.</address>
	</footer>
</body>
</html>