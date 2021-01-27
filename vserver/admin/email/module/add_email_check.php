<?php
	date_default_timezone_set('Asia/Taipei');
	$datetime = date ("Y-m-d H:i:s"); 
	
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	if (isset($_POST['add_email'])){
	
		if (($_POST['add_email']) == "確定新增"){
			
			//檢查 domain 是否存在！
			echo $_POST['userID'];
			echo $_POST['domain'];
			
			$domain_sql = 'SELECT * from domain WHERE (domain = "'.$_POST['domain'].'" and OwnerID = :user_ID)';
			$stmt1 = $db_conn->prepare($domain_sql);
			$stmt1->execute(array("user_ID" => $_POST['userID']));
			$row = $stmt1->fetch();
			
			//如果 domain 相同，就直接新增到 mailbox 內！
			if ($row['domain'] == $_POST['domain']){
			
				//拆解送來的帳號，順便防呆
				$name = explode("@",$_POST['name']);
				$email_account = $name[0]."@".$row['domain'];
				echo $email_account;
				echo $datetime;
				$mail_box1_sql = 'INSERT INTO `mailbox` (username,password,name,maildir,quota,domain,created,local_part)
									VALUES("'.$email_account.'","'.trim($_POST['passwd']).'","'.$name[0].'",
									"'.$name[0]."/".'",'.((int)$_POST['per_mail_space']).',"'.$row['domain'].'",
									"'.$datetime.'","'.$name[0].'")';
				
				
			} else {
			//如果不同，就先新增 domain ，再新增 mailbox!!
				$newdomain = trim($_POST['domain']);
				$mailboxes_num = 10;
				$newdomain_sql = 'INSERT INTO `domain`(domain,mailboxes,created,OwnerID)
								 VALUES("'.$newdomain.'",'.$mailboxes_num.',"'.$datetime.'","'.$_POST['userID'].'")';
				$stmt4 = $db_conn->prepare($newdomain_sql);
				$stmt4->execute();
				
				$name = explode("@",$_POST['name']);
				$email_account = $name[0]."@".$newdomain;
				$mail_box1_sql = 'INSERT INTO `mailbox` (username,password,name,maildir,quota,domain,created,local_part)
									VALUES("'.$email_account.'","'.trim($_POST['passwd']).'","'.$name[0].'",
									"'.$name[0]."/".'",'.((int)$_POST['per_mail_space']).',"'.$newdomain.'",
									"'.$datetime.'","'.$name[0].'")';
				
			}
			
			$stmt2 = $db_conn->prepare($mail_box1_sql);
			$stmt2->execute();	
			$mail_quota_sql = 'INSERT INTO `quota2` (username) VALUES("'.$email_account.'")';
			$stmt3 = $db_conn->prepare($mail_quota_sql);
			$stmt3->execute();	
			/*
			echo $_POST['per_mail_space'];
			echo $_POST['add_email'];
			echo $_POST['passwd'];
			echo $_POST['name'];
			echo $_POST['domain'];
			*/
		}
	}
	
	
	
	$db_conn = null;
	header("Location:../index.php" );
?>