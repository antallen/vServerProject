<?php

	include_once(dirname(__FILE__)."../../../../../setup.inc.php");
	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	//echo $_POST['mysqlID'];
	//echo $_POST['userID'];
	
	//echo $_POST['database'];
	//echo $_POST['loginname'];
	//echo $_POST['passwd'];
	
	if (isset($_POST['add_mysql'])){
		if ($_POST['add_mysql'] == "確定新增"){

			//處理系統資料庫
			$sql_lang = 'show databases';
			$stmt1 = $db_conn->prepare($sql_lang);
			$stmt1->execute();
			$result_no = 1;
			while ($row1 = $stmt1->fetch()){
				if ($row1[0] == $_POST['database']){
					$result_no = 0;
				}
			}
			//在系統內，新增資料庫
			if ($result_no == 0){
				echo "已經有該資料庫了";
				echo "<input type=\"button\" value=\"回上一頁\" onClick=\"history.back()\"></input>";
				
			} else {
					$add_database_sql = 'CREATE DATABASE '.$_POST['database'].'';
					echo $add_database_sql;
					$stmt2 = $db_conn->prepare($add_database_sql);
					$stmt2->execute();
			}
			
			//處理使用者
			$user_sql = 'select User from mysql.user where User like "%'.$_POST['loginname'].'%";';
			$stmt3 = $db_conn->prepare($user_sql);
			$stmt3->execute();
			$result_user = 1;
			while ($row3 = $stmt3->fetch()){
				echo "該帳號已有人使用";
				$result_user = 0;
				$db_conn=null;
				echo "<input type=\"button\" value=\"回上一頁\" onClick=\"history.back()\"></input>";
				//location.href='../add_mysql.php'
			}
			//在系統內新增使用者
			if ($result_user == 1){
				$useradd_sql = 'CREATE USER \''.$_POST['loginname'].'\'@\'localhost\' IDENTIFIED BY \''.$_POST['passwd'].'\'';
				echo $useradd_sql;
				$stmt4 = $db_conn->prepare($useradd_sql);
				$stmt4->execute();
				
				//給予授權
				$grantuser_sql = 'GRANT ALL PRIVILEGES ON '.$_POST['database'].'.* TO \''.$_POST['loginname'].'\'@\'localhost\'';
				echo $grantuser_sql;
				$stmt5 = $db_conn->prepare($grantuser_sql);
				$stmt5->execute();
				
				$grantuser_sql2 = 'REVOKE ALL ON '.$_POST['database'].'.* FROM \''.$dbuser.'\'@\'localhost\'';
				$stmt8 = $db_conn->prepare($grantuser_sql2);
				$stmt8->execute();
				
				//確認執行
				$flush_sql = 'FLUSH PRIVILEGES';
				$stmt6 = $db_conn->prepare($flush_sql);
				$stmt6->execute();
				
				
				//寫入管理資料表內
				$admin_sql = 'INSERT INTO `baseRule_mysql_detail`(mysql_ID,login_name,login_password,database_name)
							 VALUES("'.$_POST['mysqlID'].'","'.$_POST['loginname'].'","'.$_POST['passwd'].'","'.$_POST['database'].'")';
				echo $admin_sql;
				$stmt7 = $db_conn->prepare($admin_sql);
				$stmt7->execute();
				
				$db_conn = null;
				header("Location:../mysql_list.php" );
			}
			
		}
	}
?>