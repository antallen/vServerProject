<?php
	require_once("../../../setup.inc.php");

	$db_conn = new PDO('mysql:host=localhost;dbname=vServer',$dbuser,$dbpasswd);
	$db_conn->exec("set names utf8");

	$sql_lang = 'SELECT * FROM adminuser WHERE userID = "'.$user_ID.'"';
	
	$stmt = $db_conn->prepare($sql_lang);				
	$stmt->execute();
	
	while ($row = $stmt->fetch()){
			echo "<tr>
					<td>
						<form action=\"account_update.php\" method=\"post\">
						<table class=\"inner_table\">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td class=\"inner_table_td\">帳號</td>
								<td><input type=\"text\" value=\"".$row['loginname']."\" name=\"loginname\"></input></td>
								<td class=\"inner_table_td\">密碼</td>
								<td><input type=\"password\" value=\"".$row['password']."\" name=\"password\"></input></td>
								<td>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td  class=\"inner_table_td\">建立日期</td>
								<td><input type=\"text\" value=\"".$row['createdate']."\" name=\"createdate\"></input></td>
								<td  class=\"inner_table_td\">到期日期</td>
								<td><input type=\"text\" value=\"".$row['expiration']."\" name=\"expiration\"></td>
								<td>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td class=\"inner_table_td\">系統基本路徑</td>
								<td colspan=3>";
								if ($level > 90 and (is_null($row['dataPath']) or ($row['dataPath'] == ""))){
									echo $basePath."/";
									echo "<input type=\"text\" size=\"50\" name=\"dataPath\"></input>";
									echo "<input type=\"hidden\" name=\"basePath\" value=\"".$basePath."\"></input>";
								} else {
								
									echo $row['dataPath']." (不可修改)";
								}
								echo "</td>";
								echo "<td>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td colspan=5>
									<input type=\"submit\" value=\"確定修改\" name=\"update_check\"></input>
									<input type=\"button\" value=\"回上一頁\" onclick=\"history.back()\"></input>
									<input type=\"hidden\" value=\"".$row['ad_id']."\" name=\"ad_id\"></input>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>";
			echo "<tr><td colspan=3></td></tr>";
		}
	$db_conn = NULL;
?>