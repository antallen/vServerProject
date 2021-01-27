<form action="./module/add_check.php" method="post">
<table class="inner_table">
	<tr>
		<td colspan=5 style="border-bottom:1px solid rgb(147,174,6); hight: 30px;">&nbsp;&nbsp;&nbsp;新增網站資料</td></tr>
	<tr>
		<td class="inner_table_td"> 網站名稱</td>
		<td colspan=2>
			<input type="text" name="vhost_name" size="40" value=例如：www.網域名稱"></input>
		</td>
		<td class="inner_table_td">網站別名</td>
		<td>
			<input type="text" name="vhost_alias" size="25" value="例如：網域名稱"></input>
		</td>
	</tr>
	<tr>
		<td class="inner_table_td">是否啟動</td>
		<td>
			<input type="text" name="ON_OFF" size=5 value="yes/no"></input>
		</td>
		<td class="inner_table_td">網站子目錄</td>
		<!-- echo $main_path; -->
		<td colspan=2><input type="text" name="path" size=30></input></td>
	</tr>
	<tr>
		<td class="inner_table_td">管理者Email</td>
		<td>
			<input type="text" name="email" size=25></input>
		</td>
		
		<td colspan=3>網站主目錄：<?php echo $main_path; ?>
			<input type="hidden" name="other" value="未知者"></input>
		</td>
		
	</tr>
	<tr>
		<td>
			<input type="hidden" value="<?php echo $main_path."/"; ?>" name="basePath"></input>
			<input type="hidden" value="<?php echo $_SESSION['uid']; ?>" name="userID"></input>
			<input type="submit" value="新增" name="add_vhosts"></input>
		</td>
		<td colspan=4></td>
	</tr>
</table>
</form>