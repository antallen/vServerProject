<?php

	include_once("conf.php");

	$sql_lang1 = 'SELECT * FROM baseRule_email WHERE OwnerID = :user_ID';
	
	$stmt1 = $db_conn->prepare($sql_lang1);
	$stmt1->execute(array("user_ID" => $_SESSION['uid']));
	
	$row1 = $stmt1->fetch();
	
	$sql_lang2 = 'SELECT count(mailbox.username) FROM domain 
				  LEFT JOIN mailbox
				  ON domain.domain = mailbox.domain
					WHERE OwnerID = :user_ID';
	$stmt2 = $db_conn->prepare($sql_lang2);
	$stmt2->execute(array("user_ID" => $_SESSION['uid']));
	$row2 = $stmt2->fetch();
	
	if ($row1['webmail']){
		$webmail="pop3/imap 與 webmail";
	} else {
		$webmail="pop3/imap";
	}
	
	//echo $_SESSION['uid'];
	echo "訂購信箱數量：".$row1[2]."&nbsp;&nbsp;&nbsp;已使用信箱數量：".$row2[0]."<br>";
	echo "每一信箱空間：".(((int)$row1[3])/1024/1024)."MB<br>";
	echo "使用方式：".$webmail;
	
	$per_mail_space = ((int)$row1[3]);
	$reminder = ((int)$row1[2] - (int)$row2[0]);
	//echo "剩下數量".$reminder;
?>