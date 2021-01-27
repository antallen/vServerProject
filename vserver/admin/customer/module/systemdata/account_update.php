<?php
	date_default_timezone_set("Asia/Taipei");
	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$ad_id = $_POST['ad_id'];		
	$loginname = $_POST['loginname'];
	$createdate = $_POST['createdate'];
	$expiration = $_POST['expiration'];
	$base_sql = 'UPDATE `adminuser`
					 SET loginname="'.$loginname.'",createdate="'.$createdate.'",
					 expiration="'.$expiration.'"
					 WHERE ad_id="'.$ad_id.'"';
	$stmt = $db_conn->prepare($base_sql);
	$stmt->execute();
	
	$password = $_POST['password'];
	$pr1=explode("}",$password);
	$result=explode("{",$pr1[0]);
	if ($result[1] == "SHA"){
		echo "密碼已加密過了";	
	} else {
		$password_crypt = '{SHA}'.base64_encode(sha1($password,true));
		$pass_sql = 'UPDATE `adminuser` SET password="'.$password_crypt.'" WHERE ad_id="'.$ad_id.'"';
		$stmt = $db_conn->prepare($pass_sql);
		$stmt->execute();
	}
	
	if (isset($_POST['dataPath'])){
		echo $_POST['dataPath'];
		echo $_POST['basePath'];
		$total_path = ($_POST['basePath'])."/".($_POST['dataPath']);
		$path_sql = 'UPDATE `adminuser` SET dataPath="'.$total_path.'" WHERE ad_id="'.$ad_id.'"';
		$stmt = $db_conn->prepare($path_sql);
		$stmt->execute();
	} else {
		echo "目錄已經設定了";
	
	}
	
		
	$db_conn = null;
	header("Location:../../index.php" );
	
?>