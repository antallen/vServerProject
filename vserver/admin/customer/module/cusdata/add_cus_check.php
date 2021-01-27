<?php
	date_default_timezone_set("Asia/Taipei");
	require_once("conf.php");
	
	$company_name = $_POST["com_name"];
	$customer_name = $_POST["cus_name"];
	
	if (($_POST["com_name"] == "") && ($_POST["cus_name"]=="")){
			header("Location:add_cus.php" );
	}
		
	$company_id = $_POST["com_id"];
	$customer_id = $_POST["cus_id"];
	$telphone_num = $_POST["no1"]."-".$_POST["no2"];
	$address = $_POST["address"];
	$mobile = $_POST["mobile"];
	$emaila = $_POST["email"];
	$userID = $_POST["userID"];
	
	$cus_sql = 'INSERT INTO customerData (cusname,company,cus_id,com_id,phoneNo,Mobilephone,address,email,userID)
	            VALUES("'.$customer_name.'","'.$company_name.'","'.$customer_id.'","'.$company_id.'","'.$telphone_num.'","'.$mobile.'","'.$address.'","'.$emaila.'","'.$userID.'")';
	echo $cus_sql;
	$stmt = $db_conn->prepare($cus_sql);
	$stmt->execute();
	
	$loginname = $_POST["loginname"];
	$password = $_POST["password"];
	$password_crypt = '{SHA}'.base64_encode(sha1($password,true));
	
	$create_date = date('Y-m-d H:i:s', time());
	
	$admin_sql = 'INSERT INTO adminuser(userID,loginname,password,createdate,level)
				 VALUES("'.$userID.'","'.$loginname.'","'.$password_crypt.'","'.$create_date.'",50)';
	
	echo $admin_sql;
	$stmt1 = $db_conn->prepare($admin_sql);
	$stmt1->execute();
	
	header("Location:../../index.php" );
	
?>