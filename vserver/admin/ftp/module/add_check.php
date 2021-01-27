<?php
	include_once("../../setup.inc.php");
	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	//剩餘空間不足
	if (((int)$_POST['reminder']) < ((int)$_POST['space'])){
		$db_conn = null;
		header("Location:../index.php" );
		
	}
	if (isset($_POST['add_ftp'])){
		if ($_POST['add_ftp'] == "新增"){
			
			//處理 ftpuser 表格
			$ftp_sql1 = 'INSERT INTO `ftpuser` (userid,passwd,homedir,ownerID)
						VALUES("'.$_POST['loginname'].'","'.$_POST['passwd'].'",
						"'.$_POST['dataPath']."/".$_POST['subPath'].'","'.$_POST['user_ID1'].'")';
			echo $ftp_sql1;
			$stmt1 = $db_conn->prepare($ftp_sql1);
			$stmt1->execute();
			
			//處理 ftpquotalimits
			$ftp_sql2 = 'INSERT INTO `ftpquotalimits`(name,bytes_in_avail)
						VALUES("'.$_POST['loginname'].'",'.(((int)$_POST['space'])*1024*1024).')';
			$stmt2 = $db_conn->prepare($ftp_sql2);
			$stmt2->execute();

			//處理 ftpquotatallies
			$ftp_sql3 = 'INSERT INTO `ftpquotatallies`(name)
						VALUES("'.$_POST['loginname'].'")';
			$stmt3 = $db_conn->prepare($ftp_sql3);
			$stmt3->execute();			
			/*
			echo $_POST['loginname'];
			echo $_POST['passwd'];
			echo $_POST['space'];
			echo $_POST['subPath'];
			echo $_POST['reminder'];
			echo $_POST['reminder_user'];
			echo $_POST['user_ID1'];
			echo $_POST['dataPath'];
			*/
		}
	}
	$db_conn = null;
	header("Location:../index.php" );
?>