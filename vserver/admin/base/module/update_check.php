<?php
	date_default_timezone_set("Asia/Taipei");
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");
	
	if(isset($_POST['check_update'])){
		if($_POST['check_update'] == "確定修改"){
	
		$company_name = $_POST["com_name"];
		$customer_name = $_POST["cus_name"];
		
		if (($_POST["com_name"] == "") && ($_POST["cus_name"]=="")){
				header("Location:../base_data.php" );
		}
		
		
		$company_id = $_POST["com_id"];
		$customer_id = $_POST["cus_id"];
		$telphone_num = $_POST["no1"]."-".$_POST["no2"];
		$address = $_POST["address"];
		$mobile = $_POST["mobile"];
		$emaila = $_POST["email"];
		$userID = $_POST["userID"];
		
		$cus_sql = 'UPDATE `customerData`
					SET cusname="'.$customer_name.'",company="'.$company_name.'",
						cus_id="'.$customer_id.'",com_id="'.$company_id.'",
						phoneNo="'.$telphone_num.'",Mobilephone="'.$mobile.'",
						address="'.$address.'",email="'.$emaila.'"
						WHERE userID="'.$userID.'"';
				   
		echo $cus_sql;
		$stmt = $db_conn->prepare($cus_sql);
		$stmt->execute();
		
	}
	}
	header("Location:../../index.php" );
	
?>