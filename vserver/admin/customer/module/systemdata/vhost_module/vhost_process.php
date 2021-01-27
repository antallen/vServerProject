<?php
	require_once("../../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	
	//echo $_POST['userID'];
	
	if(isset($_POST['vhost_update'])){
	
		if($_POST['vhost_update'] == "確定修改"){
		/*
			echo $_POST['vhost_name'];
			echo $_POST['vhost_alias'];
			echo $_POST['ON_OFF'];
			echo $_POST['path'];
			echo $_POST['main_path'];
			echo $_POST['email'];
			echo $_POST['vt_id'];
		*/
			$total_path = $_POST['main_path']."/".$_POST['path'];
			$path_search = glob($total_path);
			if (!is_null($path_search[0])){
		
				$update_sql = 'UPDATE `vhosts` SET vhost = "'.$_POST['vhost_name'].'",
								valias = "'.$_POST['vhost_alias'].'", enabled="'.$_POST['ON_OFF'].'",
								rootdir = "'.$total_path.'",
								admin = "'.$_POST['email'].'"
								WHERE (userID = "'.$_POST['userID'].'" and vt_id = '.$_POST['vt_id'].')';
				
				//echo $update_sql;
				
				$stmt1 = $db_conn->prepare($update_sql);
				$stmt1->execute();
				$db_conn=null;
				header("Location:../vhosts_list.php" );
			} else {
				echo "沒有子目錄！請在主目錄內，建立 ".$_POST['path']." 子目錄<br>";
				$db_conn=null;
				echo "<input type=\"button\" value=\"回上一頁\" onClick=\"location.href='../vhosts_list.php'\"></input>";
				
			}
		}
	
	}
	if (isset($_POST['vhost_del'])){
	
		if ($_POST['vhost_del']){
		
			$sql_del = 'DELETE FROM `vhosts` WHERE (userID = "'.$_POST['userID'].'" and vt_id = '.$_POST['vt_id'].')';
			$stmt2 = $db_conn->prepare($sql_del);
			$stmt2->execute();
			$db_conn=null;
			header("Location:../vhosts_list.php" );
		}
	}
	
?>