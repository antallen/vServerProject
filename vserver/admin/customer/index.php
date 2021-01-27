<!DOCTYPE html>
<?php
	session_start();
	
	if(!$_SESSION['user']){
		header("Location:../login.php" );
	}
	
	$level = $_SESSION['level'];
	if($level<90){
		header("Location:../index.php");
	}
	
?>
<html>
<!-- 文件資訊 -->
<head>
<title>Vserver 管理介面--客戶資料管理</title>
<link type="text/css" rel="stylesheet" href="./style.css">
<script type="text/javascript">

	function post_to_url(path, params, method) {
    method = method || "post"; 
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);

        form.appendChild(hiddenField);
    }

    document.body.appendChild(form);    
    form.submit();
}
</script>
</head>
<body>
	<!-- 網頁標頭標語區 -->
	<section>
		<header id="mainHeader" class="header_logo">
		<!-- 上方的選單區 -->
		
		<div>
			<ul>
				<li>聯絡客服</li>
				<li><a href="../">回管理首頁</a></li>
				<li><a href="../../">回首頁</a></li>
				<li><a href="../logout.php">登出</a></li>
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
			<li><a href="./">客戶資料管理</a></li>
			<li><a href="./">客戶使用狀況</a></li>
			<li><a href="./">客戶繳費狀況</a></li>
			<li><a href="./">客戶申訴資料</a></li>
			<li><a href="./">站台統計</a></li>
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
			<form name ="sample" action="default.php">			
			<table class="basetable">	
				<tr><td colspan='3' class="title">客戶資料列表</td>
				</tr>
				<tr>
					<td>公司名稱</td>
					<td>連絡人</td>
					<td>詳細資料列表</td>
				</tr>
				<?php
					include_once("./module/account_list.php");
				?>
			</table>
			</form>
			<form action="./module/cusdata/add_cus.php" method="post">
				<input type="submit" value="新增"></input>
			</form>
		</section>
		
	</div>
	
	<!-- 頁尾宣告 -->
	
	<footer>
		<address>CopyRight (C)2015 vServer 經營團隊 All Right Reserved.</address>
	</footer>
</body>
</html>
