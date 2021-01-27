<?php
	include_once("conf.php");

	$sql_lang = 'SELECT baseRule_mysql_detail.database_name,baseRule_mysql_detail.login_password,baseRule_mysql_detail.login_name,baseRule_mysql_detail.br_md_id
				 FROM baseRule_mysql
				 LEFT JOIN baseRule_mysql_detail
				 ON (baseRule_mysql.mysql_ID = baseRule_mysql_detail.mysql_ID)
				 WHERE baseRule_mysql.OwnerID = :user_ID';
				 
	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['manage_uid']));

	while ($row = $stmt->fetch()){
?>
		<form action="./mysql_module/mysql_process.php" method="post"> 
		<table class="inner_table" style="width: 680px;">
			<tr>
				<td class="inner_table_td">&nbsp;資料庫名稱</td>
				<td colspan=5><input type="text" name="database" value="<?php echo $row[0]; ?>" size="20"></input></td>
			</tr>
			<tr>
				<td class="inner_table_td">帳號名稱</td>
				<td colspan=2><input type="text" name="loginname" value="<?php echo $row[2]; ?>" size="20"></input></td>
				<td class="inner_table_td">密碼</td>
				<td colspan=2><input type="text" name="passwd" value="<?php echo $row[1]; ?>" size="20"></input></td>
			</tr>
			<tr>
				<td colspan=6>
						<input type="hidden" name="br_md_id" value="<?php echo $row[3]; ?>"></input>
						<input type="hidden" name="olddatabase" value="<?php echo $row[0]; ?>"></input>
						<input type="hidden" name="userID" value="<?php echo $_SESSION['manage_uid']; ?>"></input>
						<input type="hidden" name="olduser" value="<?php echo $row[2]; ?>"></input>
						<input type="submit" value="確定修改" name="mysql_update"></input>
						<input type="submit" value="確定刪除" name="mysql_delete"></input>
				</td>
			</tr>
		</table>
		</form>
		<br>
<?php
	}
?>
