<form action="./ftp_module/add_check.php" method="post">
	<table class="inner_table">
		<tr>
			<td colspan="6" style="border-bottom: 1px solid rgb(147,174,6); hight: 30px;">&nbsp;&nbsp;&nbsp;FTP 帳號新增</td>
		</tr>
		<tr>
			<td class="inner_table_td">帳號名稱</td>
			<td><input type="text" name="loginname" size="25"></input></td>
			<td class="inner_table_td">密碼</td>
			<td><input type="text" name="passwd" size="20"></input></td>
		</tr>
		<tr>
			<td class="inner_table_td">指定空間</td>
			<td colspan="5"><input type="text" name="space" size="20"></input>MB</td>
		</tr>
		<tr>
			<td class="inner_table_td">指定子目錄</td>
			<td colspan="5"><?php echo $dataPath."/"; ?><input type="text" size="50" name="subPath"></input></td>
		</tr>
		<tr>
			<td>
				<input type="hidden" value="<?php echo $reminder; ?>" name="reminder"></input>
				<input type="hidden" value="<?php echo $reminder_user; ?>" name="reminder_user"></input>
				<input type="hidden" value="<?php echo $_SESSION['manage_uid']; ?>" name="user_ID1"></input>
				<input type="hidden" value="<?php echo $dataPath."/"; ?>" name="dataPath"></input>
				<input type="submit" value="新增" name="add_ftp"></input>
			</td>
		</tr>
	</table>
</form>