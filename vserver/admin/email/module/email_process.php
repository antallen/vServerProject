<?php
	date_default_timezone_set('Asia/Taipei');
	$datetime = date ("Y-m-d H:i:s"); 
	
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	
	//處理 update 
	if (isset($_POST['email_update'])){
	
		if ($_POST['email_update'] == "確定修改"){
	
			//拆解送過來的信箱名稱
			$name = explode("@",$_POST['name']);
			echo $name[0];
			echo $name[1];
			
			//處理有附上網域名稱的帳號
			if (!empty($name[1]) or !is_null($name[1])){
			
				$domain_sql = 'SELECT * from domain WHERE (domain = "'.$name[1].'" and OwnerID = :user_ID)';
				$stmt1 = $db_conn->prepare($domain_sql);
				$stmt1->execute(array("user_ID" => $_POST['userID']));
				$row = $stmt1->fetch();
				//判斷是否有 domain 在資料表內
				if ($row['domain'] == $name[1]){
					$email_sql1 = 'UPDATE `mailbox` SET username = "'.trim($_POST['name']).'",
								   password = "'.trim($_POST['passwd']).'"
								   WHERE username = "'.trim($_POST['olduser']).'"';
					$stmt2 = $db_conn->prepare($email_sql1);
					$stmt2->execute();
					$db_conn = null;
					header("Location:../index.php" );
				} else {
					echo "只能先新增該帳號，再裝舊帳號刪除！";
					$db_conn=null;
					echo "<input type=\"button\" value=\"回上一頁\" onClick=\"location.href='../index.php'\"></input>";
				
				}
			} else {
			//處理未附上網域名稱的帳號
				$realusername = trim($_POST['name'])."@".trim($_POST['domain']);
				$email_sql1 = 'UPDATE `mailbox` SET username = "'.$realusername.'",
								   password = "'.trim($_POST['passwd']).'"
								   WHERE username = "'.trim($_POST['olduser']).'"';
				$stmt3 = $db_conn->prepare($email_sql1);
				$stmt3->execute();
				$db_conn = null;
				header("Location:../index.php" );
			
			}
			
			
		}
	
	}
	
	//處理刪除的資料
	
	if (isset($_POST['email_delete'])){
	
		if ($_POST['email_delete'] == "確定刪除"){
		
			$delete_sql = 'DELETE FROM `mailbox` WHERE username = "'.trim($_POST['olduser']).'"';
			$stmt4 = $db_conn->prepare($delete_sql);
			$stmt4->execute();
			
			//判斷在該網域下，是否有其他的帳號，如果沒有，就連帶刪除該網域
			$search_mail_sql = 'SELECT * FROM `mailbox` WHERE domain = "'.trim($_POST['domain']).'"';
			$stmt5 = $db_conn->prepare($search_mail_sql);
			$stmt5->execute();
			$row = $stmt5->fetch();
			if (empty($row) or is_null($row)){
			
				echo "沒有該網域的信箱了";
				$delete_domain = 'DELETE FROM `domain` WHERE domain = "'.trim($_POST['domain']).'"';
				$stmt6 = $db_conn->prepare($delete_domain);
				$stmt6->execute();
			
			}
			
			
			$db_conn = null;
			header("Location:../index.php" );
		}
	}
	
?>