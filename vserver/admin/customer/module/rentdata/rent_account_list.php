<?php 
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$sql_lang = 'SELECT * FROM adminuser WHERE userID = "'.$user_ID.'"';
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	$result_no = 0;
		while ($row = $stmt->fetch()){
			echo "<tr>";
			echo "<td>";
			echo $row['loginname'];
			echo "</td>";
			echo "<td>";
			echo $row['createdate'];
			echo "</td>";
			echo "</tr>";
			$result_no = 1;
		}
	if ($result_no == 0){
			echo "<tr>";
			echo "<td colspan=2 style=\"color: #3366FF\">暫無資料</td>";
			echo "</tr>";
		}
?>