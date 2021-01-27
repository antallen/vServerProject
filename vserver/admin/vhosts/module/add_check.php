<?php
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	if (isset($_POST['add_vhosts'])){
	
		if ($_POST['add_vhosts'] == "新增"){
		
			$path = $_POST['basePath'].$_POST['path'];
			//$row1 = glob($path);
			$shell_string = "find ".$_POST['basePath']." -type d -name ".$_POST['path'];
			$output_cmd = shell_exec($shell_string);
			
			$key = $_POST['other'];
			if (($key[0] == "未知者") || (empty($_POST['other']))){
				$php_other = "open_basedir=".$_POST['basePath'];
				echo $php_other;
			} else {
				$key = explode("=",$_POST['other']);
				if ($key[0]){
					$php_other = $_POST['other'];
					echo $php_other;
				} else {
					$php_other = "open_basedir=".$_POST['basePath'];
					echo $php_other;
				}
			}
			
			if (!is_null($output_cmd)){
				echo $output_cmd."<BR>";
				
				$add_sql = 'INSERT INTO `vhosts`(vhost,valias,enabled,rootdir,admin,extra_php_config,userID)
							VALUES("'.$_POST['vhost_name'].'","'.$_POST['vhost_alias'].'","'.$_POST['ON_OFF'].'",
							"'.$path.'","'.$_POST['email'].'","'.$php_other.'","'.$_POST['userID'].'")';
						
				$stmt = $db_conn->prepare($add_sql);
				$stmt->execute();
				$db_conn=null;
				header("Location:../index.php" );
			} else {
				echo "沒有子目錄！請在主目錄內，建立 ".$_POST['path']." 子目錄<br>";
				
				echo "<input type=\"button\" value=\"回上一頁\" onClick=\"location.href='../index.php'\"></input>";
				
			}
		
		/*
		echo $_POST['vhost_name'];
		echo $_POST['vhost_alias'];
		echo $_POST['ON_OFF'];
		echo $_POST['path'];
		echo $_POST['email'];
		echo $_POST['other'];
		echo $_POST['basePath'];
		echo $_POST['userID'];
		*/
		
		}
	}
	$db_conn="";
?>