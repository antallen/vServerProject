<?php
	include_once("conf.php");
	
	//echo $_SESSION['uid'];
	//找出主目錄
	$sql_lang1 = 'SELECT dataPath from adminuser where userID = :user_ID';
	$stmt1 = $db_conn->prepare($sql_lang1);
	$stmt1->execute(array("user_ID" => $_SESSION['uid']));
	$row1 = $stmt1->fetch();
	echo "主目錄位置：".$row1[0]."<br>";
	
	$dataPath = $row1[0];
	$dataPath_size = strlen($dataPath);
	
	//找出可用空間
	$sql_lang2 = 'SELECT total_bytes,ftp_num from baseRule_ftp WHERE OwnerID = :user_ID';
	$stmt2 = $db_conn->prepare($sql_lang2);
	$stmt2->execute(array("user_ID" => $_SESSION['uid']));
	$row2 = $stmt2->fetch();
	$total_space = (((int)$row2[0]/1024)/1024);
	echo "總空間：".$total_space."MB";
	
	//找出可配置空間
	$sql_lang3 = 'SELECT SUM(ftpquotalimits.bytes_in_avail) FROM ftpuser
				  LEFT JOIN ftpquotalimits 
				  ON ftpuser.userid = ftpquotalimits.name
				  WHERE ownerID = :user_ID';
	$stmt3 = $db_conn->prepare($sql_lang3);
	$stmt3->execute(array("user_ID" => $_SESSION['uid']));
	$row3 = $stmt3->fetch();
	$userd_space = ceil(((int)$row3[0]/1024)/1024)-$total_space;
	
	echo "&nbsp;&nbsp;&nbsp;&nbsp;已配置空間：".$userd_space."MB";
	
	if ($userd_space > $total_space){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;剩餘可配置空間：<font color=\"red\"> 0 </font>MB";
	} else {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;剩餘可配置空間：".($total_space-$userd_space)."MB";
	}
	
	$reminder = ($total_space-$userd_space);
	
	if ($reminder < 0){
		$reminder = 0;
	}
	echo "<br>";
	
	
	//找出可用的帳號數量
	echo "可配置帳號數量：".$row2[1];
	$sql_lang4 = 'SELECT count(userid) FROM ftpuser
				  WHERE ownerID = :user_ID';
	$stmt4 = $db_conn->prepare($sql_lang4);
	$stmt4->execute(array("user_ID" => $_SESSION['uid']));
	$row4 = $stmt4->fetch();
	echo "&nbsp;&nbsp;&nbsp;&nbsp;已配置帳號數量：".$row4[0];
	$reminder_user = (int)$row2[1] - (int)$row4[0];
?>