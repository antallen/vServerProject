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
						echo "<script>alert('Please login again!');location.href='../../../login.php';</script>";
					}	
				?>
			<!-- --------登入者----------------------------------------- -->
			<form action="./cusdata/update_check.php" method="post">
			<?php
					require_once("../../setup.inc.php");

					$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
					$db_conn->exec("set names utf8");

					$user_ID = $_POST['q'];
					
					$sql_lang = 'SELECT * FROM customerData LEFT JOIN adminuser ON customerData.userID = adminuser.userID WHERE customerData.userID = :user_ID';

					$stmt = $db_conn->prepare($sql_lang);
					
					$stmt->execute(array("user_ID" => $user_ID));
					
					$row = $stmt->fetch()
			?>
			<table class="basetable">	
				<tr><td colspan='2' class="title">客戶資料內容</td></tr>
				<tr>
					<td width="90">公司名稱</td><td><input type="text" size="60" name="com_name" value="<?php echo $row['company'];?>"></input>個人申請者免填</td>
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
					<td>連絡地址</td><td><input type="text" size="80" name="address" value="<?php echo $row['address']; ?>"></input></td>
				</tr>
				<tr>
					<td>E-mail</td><td><input type="text" size="40" name="email" value="<?php echo $row['email']; ?>"></input></td>
				</tr>	
			</table>
				<input type="hidden" size="30" name="userID" value="<?php echo $row['userID']; ?>"></input>
				<input type="submit" value="確定修改"></input><input type="button" value="回上一頁" onclick="history.back()"></input>
			</form>			
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C)2015 vServer 經營團隊 All Right Reserved.</address>
	</footer>
</body>
</html>
	
