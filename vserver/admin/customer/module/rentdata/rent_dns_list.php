<?php
	require_once("../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$sql_lang = 'SELECT * FROM baseRule_dns WHERE OwnerID = "'.$user_ID.'"';
	
	$stmt = $db_conn->prepare($sql_lang);				
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	$result_no = 0;
	while ($row = $stmt->fetch()){
	
			echo "<tr>";
			echo "<td><input type=\"text\" name=\"dns_num\" size=8 style=\"text-align: right\" value=\"".$row[3]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"dns_sub_num\" size=8 style=\"text-align: right\" value=\"".$row[4]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"dns_host_num\" size=6 style=\"text-align: right\" value=\"".$row[5]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"dns_start_date\" size=21 value=\"".$row[6]."\"></input></td>";
			echo "<td><input type=\"text\" name=\"dns_end_date\" size=21 value=\"".$row[7]."\"></input></td>";
			echo "<td><input type=\"hidden\" value=\"".$user_ID."\" name=\"user_ID\"></input>
					  <input type=\"submit\" value=\"更新\" name=\"update_dns\"></input>
					  <input type=\"submit\" value=\"刪除\" name=\"delete_dns\"></input>
				</td>";
			echo "</tr>";
			$result_no = 1;
	}
	if ($result_no == 0){
			echo "<tr>";
			echo "<td colspan=6 style=\"color: #3366FF\">暫無資料</td>";
			echo "</tr>";
			
			echo "<tr>
					<td><input type=\"text\" name=\"dns_num\" size=8 style=\"text-align: right\"></input></td>
					<td><input type=\"text\" name=\"dns_sub_num\" size=8 style=\"text-align: right\"></input></td>
					<td><input type=\"text\" name=\"dns_host_num\" size=6 style=\"text-align: right\"></input></td>
					<td><input type=\"text\" name=\"dns_start_date\" value=\"YYYY-MM-DD hh:mm:ss\" size=21></input></td>
					<td><input type=\"text\" name=\"dns_end_date\" size=21></input></td>
					<td><input type=\"hidden\" value=\"".$user_ID."\" name=\"user_ID\"></input>
						<input type=\"submit\" value=\"新增\" name=\"add_dns\"></input></td>
				</tr>";
		}
?>