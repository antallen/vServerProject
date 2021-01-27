<?php
	include_once("conf.php");

	$sql_lang = 'SELECT mailbox.username,mailbox.password,domain.domain,quota2.bytes,quota2.messages
				 FROM domain
				 LEFT JOIN mailbox
				 ON (domain.domain = mailbox.domain )
				 LEFT JOIN quota2
				 ON (mailbox.username = quota2.username)
				 WHERE domain.OwnerID = :user_ID';
				 
	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));

	while ($row = $stmt->fetch()){
?>
		<form action="./module/email_process.php" method="post"> 
		<table class="inner_table2">
			<tr>
				<td class="title" colspan=4>&nbsp;&nbsp;&nbsp;網域：&nbsp;&nbsp;<span style="font-weight: bold; color: #3366FF;"><?php echo $row[2]; ?></span></td>
			</tr>
			<tr>
				<td class="inner_table_td">帳號名稱</td>
				<td><input type="text" name="name" value="<?php echo $row[0]; ?>" size="40"></input></td>
				<td class="inner_table_td">密碼</td>
				<td><input type="text" name="passwd" value="<?php echo $row[1]; ?>" size="25"></input></td>
			</tr>
			<tr>
				<td class="inner_table_td">已使用空間</td>
				<td><?php echo $row[3]; ?> bytes</td>
				<td class="inner_table_td">郵件數量</td>
				<td><?php echo $row[4]; ?></td>
			</tr>
			<tr>
				<td colspan=4>
						<input type="hidden" name="olduser" value="<?php echo $row[0]; ?>"></input>
						<input type="hidden" name="userID" value="<?php echo $_SESSION['uid']; ?>"></input>
						<input type="hidden" name="domain" value="<?php echo $row[2]; ?>"></input>
						<input type="submit" value="確定修改" name="email_update"></input>
						<input type="submit" value="確定刪除" name="email_delete"></input>
				
				</td>
			</tr>
		</table>
		</form>
		<br>
<?php
	}
?>
