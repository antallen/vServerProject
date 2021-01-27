<?php
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$sql_lang = 'SELECT * FROM baseRule_email WHERE OwnerID = "'.$user_ID.'"';
	
	$stmt = $db_conn->prepare($sql_lang);				
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	$result_no = 0;
	while ($row = $stmt->fetch()){
	
			echo "<tr>";
			echo "<td><input type=\"text\" name=\"email_num\" size=8 style=\"text-align: right\" value=\"".$row[2]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"email_quota\" size=15 style=\"text-align: right\" value=\"".((((int)$row[3])/1024)/1024)."\"></input></td>";
			echo "<td><input type=\"text\" name=\"email_start_date\" size=21 value=\"".$row[4]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"email_end_date\" size=21 value=\"".$row[5]."\"></input></td>";
			echo "<td><input type=\"hidden\" value=\"".$user_ID."\" name=\"user_ID\"></input>
					  <input type=\"submit\" value=\"更新\" name=\"update_email\"></input>
					  <input type=\"submit\" value=\"刪除\" name=\"delete_email\"></input>
				</td>";
			echo "</tr>";
			$result_no = 1;
	}
	if ($result_no == 0){
			echo "<tr>";
			echo "<td colspan=5 style=\"color: #3366FF\">暫無資料</td>";
			echo "</tr>";
			
			echo "<tr>
					<td><input type=\"text\" name=\"email_num\" size=8 style=\"text-align: right\"></input></td>
					<td><input type=\"text\" name=\"email_quota\" size=15 style=\"text-align: right\"></input></td>
					<td><input type=\"text\" name=\"email_start_date\" value=\"YYYY-MM-DD hh:mm:ss\" size=21></input></td>
					<td><input type=\"text\" name=\"email_end_date\" size=21></input></td>
					<td><input type=\"hidden\" value=\"".$user_ID."\" name=\"user_ID\"></input>
					    <input type=\"submit\" value=\"新增\" name=\"add_email\"></input></td>
				</tr>";
		}
	
?>