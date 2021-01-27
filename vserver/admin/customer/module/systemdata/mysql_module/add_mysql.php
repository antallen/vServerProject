<form action="./mysql_module/mysql_add_check.php" method="post"> 
	<table class="inner_table">
		<tr>
			<td colspan=6 class="title">&nbsp;資料庫新增</td>
		</tr>
		<tr>
			<td class="inner_table_td">資料庫名稱</td>
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
					<input type="hidden" name="mysqlID" value="<?php echo $mysqlID; ?>"></input>
					<input type="hidden" name="userID" value="<?php echo $_SESSION['manage_uid']; ?>"></input>
					<input type="submit" value="確定新增" name="add_mysql"></input>
			</td>
		</tr>
	</table>
</form>