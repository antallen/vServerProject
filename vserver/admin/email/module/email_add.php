<form action="./module/add_email_check.php" method="post"> 
<table class="inner_table">
	<tr>
		<td class="title" colspan=4>&nbsp;&nbsp;新增 <span style="font-weight: bold; color: #AD3333; ">E-mail</span> 信箱</td>
	</tr>
	<tr>
		<td class="inner_table_td">網域</td>
		<td colspan=3><input type="text" name="domain" size=60></input></td>
	</tr>
	<tr>
		<td class="inner_table_td">帳號名稱</td>
		<td><input type="text" name="name" size="40"></input></td>
		<td class="inner_table_td">密碼</td>
		<td><input type="text" name="passwd" size="25"></input></td>
	</tr>
	<tr>
		<td colspan=4>
				<input type="hidden" name="userID" value="<?php echo $_SESSION['uid']; ?>"></input>
				<input type="hidden" name="per_mail_space" value="<?php echo $per_mail_space; ?>"></input>
				<input type="submit" value="確定新增" name="add_email"></input>
		</td>
	</tr>
</table>
</form>