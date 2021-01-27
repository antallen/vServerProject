<?php
	require_once("../../../../setup.inc.php");
	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	echo $_POST['ftpuser'];
	
	if (isset($_POST['update_ftp'])){
		if ($_POST['update_ftp'] == "修改"){
		
		//先取出原帳號值
		$sql1 = 'select ftpuser.userid,ftpquotalimits.bytes_in_avail FROM ftpuser
				 LEFT JOIN ftpquotalimits
				 ON ftpuser.userid = ftpquotalimits.name
				where ftpuser.id = '.$_POST['ftp_id'].'';
		$stmt1 = $db_conn->prepare($sql1);
		$stmt1->execute();
		$row1 = $stmt1->fetch();
		$orign_user = $row1[0];
		$orign_limit = $row1[1];
		
		//開始更新新值
		echo $_POST['dataPath'];
		
		if ($_POST['dataPath']=="不改"){
		$sql2 = 'UPDATE `ftpuser` SET userid = "'.$_POST['ftpuser'].'",
				passwd = "'.$_POST['ftppasswd'].'"
				WHERE id = '.$_POST['ftp_id'].'';
		
		} else {
		$path = $_POST['dataPath']."/".$_POST['subpath'];
		//ftpuser表格
		$sql2 = 'UPDATE `ftpuser` SET userid = "'.$_POST['ftpuser'].'",
				passwd = "'.$_POST['ftppasswd'].'",
				homedir = "'.$path.'"
				WHERE id = '.$_POST['ftp_id'].'';
		}
		$stmt2 = $db_conn->prepare($sql2);
		$stmt2->execute();
	
		//ftpquotalimits 表格
		echo $_POST['ftplimits'];
		
		if ($_POST['ftplimits']=="不動"){
			$sql3 = 'UPDATE `ftpquotalimits` SET name = "'.$_POST['ftpuser'].'"
					WHERE name = "'.$orign_user.'"';
		} else {
			$reminder = $_POST['ftp_reminder'];
			$total = (int)$orign_limit + (int)$reminder*1024*1024;
			echo (int)$orign_limit;
			echo (int)$reminder;
			echo $total;
			echo (int)$_POST['ftplimits'];
			
			if ($total > (((int)$_POST['ftplimits'])*1024*1024)){
			
			$sql3 = 'UPDATE `ftpquotalimits` SET name = "'.$_POST['ftpuser'].'",
					bytes_in_avail = '.(((int)$_POST['ftplimits'])*1024*1024).'
					WHERE name = "'.$orign_user.'"';
			} else {
				$sql3 = 'UPDATE `ftpquotalimits` SET name = "'.$_POST['ftpuser'].'"
					WHERE name = "'.$orign_user.'"';
			}		
		}
		$stmt3 = $db_conn->prepare($sql3);
		$stmt3->execute();
		
		//ftpquotatallies 表格
		$sql4 = 'UPDATE `ftpquotatallies` SET name = "'.$_POST['ftpuser'].'"
				WHERE name = "'.$orign_user.'"';
		$stmt4 = $db_conn->prepare($sql4);
		$stmt4->execute();
		
		
		}
	}
	
	if (isset($_POST['delete_ftp'])){
		if ($_POST['delete_ftp'] == "刪除"){
		echo $_POST['ftpuser'];
		
		$del_sql = 'DELETE FROM `ftpuser` WHERE userid = "'.$_POST['ftpuser'].'"';
		$stmt5 = $db_conn->prepare($del_sql);
		$stmt5->execute();
		}
	}
	$db_conn = null;
	header("Location:../ftp_list.php" );
	
?>