<?php

	require_once("../../../../../setup.inc.php");
	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	if (isset($_POST['mysql_update'])){
	
		if ($_POST['mysql_update'] == "確定修改"){
		
			//修改 baseRule_mysql_detail
			$update_sql = 'UPDATE `baseRule_mysql_detail`
						   SET login_name = "'.$_POST['loginname'].'",
						   login_password = "'.$_POST['passwd'].'",
						   database_name = "'.$_POST['database'].'"
						   WHERE br_md_id = '.(int)trim($_POST['br_md_id']).'';
		
			echo $update_sql;
			$stmt1 = $db_conn->prepare($update_sql);
			$stmt1->execute();
			
			if ($_POST['database'] == $_POST['olddatabase']){
				echo "資料庫名稱未修改！";
			} else {
			//修改系統內的資料
			  //1. 首先使用 mysqldump 來備份資料
				//$dump_file =  $basePath."/tmp/".$_POST['olddatabase'].".sql".'';
				$dump_file =  dirname(__FILE__)."/tmp/".$_POST['olddatabase'].".sql".'';
				
				//$dump_file =  "./tmp/".$_POST['olddatabase'].".sql".'';
				$mysqldump = 'mysqldump -u '.$dbuser.' --password="'.$dbpasswd.'" '.$_POST['olddatabase'].' > '.$dump_file.'';
				echo $mysqldump;
				exec($mysqldump);
				
			 //2.刪除資料庫
			 //DROP {DATABASE | SCHEMA} [IF EXISTS]
				$del_database_sql = 'DROP SCHEMA  IF EXISTS '.trim($_POST['olddatabase']).'';
				$stmt2 = $db_conn->prepare($del_database_sql);
				$stmt2->execute();
				$del_database_sql = 'DROP DATABASE IF EXISTS '.trim($_POST['olddatabase']).'';
				$stmt2 = $db_conn->prepare($del_database_sql);
				$stmt2->execute();
				
			//3.建立資料庫
				$create_database_sql = 'CREATE DATABASE '.trim($_POST['database']).'';
				$stmt3 = $db_conn->prepare($create_database_sql);
				$stmt3->execute();
				
			//4.將原來的資料倒回去
				$mysql_sql = 'mysql -u '.$dbuser.' --password="'.$dbpasswd.'" '.trim($_POST['database']).' < '.$dump_file.'';
				$stmt4 = $db_conn->prepare($mysql_sql);
				$stmt4->execute();
				
			//5.更新使用者帳密
			//UPDATE user SET Password=PASSWORD("密碼") WHERE User='目標使用者';
				$user_update = 'UPDATE user SET User = '.trim($_POST['loginname']).', Password=PASSWORD("'.trim($_POST['passwd']).'")
				                WHERE User='.trim($_POST['olduser']).'';
				$stmt5 = $db_conn->prepare($user_update);
				$stmt5->execute();
			
			//6.更新授權
				$grantuser_sql = 'GRANT ALL PRIVILEGES ON '.$_POST['database'].'.* TO \''.$_POST['loginname'].'\'@\'localhost\'';
				
				$stmt6 = $db_conn->prepare($grantuser_sql);
				$stmt6->execute();
				
				$grantuser_sql2 = 'REVOKE ALL ON '.$_POST['database'].'.* FROM \''.$dbuser.'\'@\'localhost\'';
				$stmt7 = $db_conn->prepare($grantuser_sql2);
				$stmt7->execute();
			
			//7.確認執行
				$flush_sql = 'FLUSH PRIVILEGES';
				$stmt8 = $db_conn->prepare($flush_sql);
				$stmt8->execute();
				
				$db_conn = null;
				header("Location:../mysql_list.php" );
			
			}
		}
	}
/*	
	br_md_id
database
loginname
passwd
olddatabase
olduser
oldpasswd
userID
確定修改" name="mysql_update"
確定刪除" name="mysql_delete"
*/
?>