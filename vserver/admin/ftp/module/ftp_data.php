<?php
	include_once("conf.php");
/*
	$sql_lang = 'SELECT ftpuser.userid,ftpuser.passwd,ftpquotalimits.bytes_in_avail,ftpquotatallies.bytes_in_used,
	             FROM ftpuser,ftpquotalimits, ftpquotatallies 
				 ON (ftpuser.userid = ftpquotalimits.name AND ftpquotalimits.name = ftpquotatallies.name)
				 WHERE ownerID = :user_ID';
*/
	$sql_lang = 'SELECT ftpuser.userid,ftpuser.passwd,ftpquotalimits.bytes_in_avail,ftpquotatallies.bytes_in_used,
				ftpuser.homedir,ftpuser.id
				 FROM ftpuser LEFT JOIN ftpquotalimits
				 ON (ftpuser.userid = ftpquotalimits.name )
				 LEFT JOIN ftpquotatallies
				 ON (ftpquotalimits.name = ftpquotatallies.name)
				 WHERE ftpuser.ownerID = :user_ID';
				 
	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	while ($row = $stmt->fetch()){
		
		?><form action="./module/ftp_process.php" method="post"><?php
		if ($row[4] == $dataPath){
			echo "<tr>";
			echo "<td><input type=\"text\" name=\"ftpuser\" value=\"".$row[0]."\" size=\"23\"></input></td>";
			echo "<td><input type=\"text\" name=\"ftppasswd\" value=\"".$row[1]."\" size=\"18\"></input></td>";
			echo "<td>".ceil(((int)$row[2]/1024)/1024)."MB</td>";
			echo "<td style=\"text-align: right;\">".ceil(((int)$row[3]/1024)/1024)."MB</td>";
			echo "<td>/</td>";
			echo "<td>
						<input type=\"hidden\" name=\"subpath\" value=\"".substr($row[4],((int)$dataPath_size+1))."\" size=\"15\"></input>
						<input type=\"hidden\" name=\"ftplimits\" value=\"不動\" size=\"10\"></input>
						<input type=\"hidden\" name=\"dataPath\" value=\"不改\"></input>
						<input type=\"hidden\" name=\"ftp_reminder\" value=\"".$reminder."\"></input>
						<input type=\"hidden\" name=\"ftp_id\" value=\"".$row[5]."\"></input>
						<input type=\"submit\" value=\"修改\" name=\"update_ftp\"></input>
						
				
		      </td>";
			echo "</tr>";
		} else {
		//$pathrow = explode($dataPath."/",$row[4]);
		echo "<tr>";
		echo "<td><input type=\"text\" name=\"ftpuser\" value=\"".$row[0]."\" size=\"23\"></input></td>";
		echo "<td><input type=\"text\" name=\"ftppasswd\" value=\"".$row[1]."\" size=\"18\"></input></td>";
		echo "<td><input type=\"text\" name=\"ftplimits\" value=\"".ceil(((int)$row[2]/1024)/1024)."\" size=\"10\">MB</input></td>";
		echo "<td style=\"text-align: right;\">".ceil(((int)$row[3]/1024)/1024)."MB</td>";
		echo "<td><input type=\"text\" name=\"subpath\" value=\"".substr($row[4],((int)$dataPath_size+1))."\" size=\"15\"></input></td>";
		echo "<td>
						<input type=\"hidden\" name=\"dataPath\" value=\"".$dataPath."\"></input>
						<input type=\"hidden\" name=\"ftp_reminder\" value=\"".$reminder."\"></input>
						<input type=\"hidden\" name=\"ftp_id\" value=\"".$row[5]."\"></input>
						<input type=\"submit\" value=\"修改\" name=\"update_ftp\"></input>
						<input type=\"submit\" value=\"刪除\" name=\"delete_ftp\"></input>
				
		      </td>";
		echo "</tr>";
		}
		echo "</form>";
		
	}
	
?>