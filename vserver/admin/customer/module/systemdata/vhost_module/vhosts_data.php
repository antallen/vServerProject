<?php
	include_once("conf.php");

	$sql_lang = 'SELECT * FROM vhosts WHERE userID = :user_ID';

	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['manage_uid']));
	
	while ($row = $stmt->fetch()){
?>

<tr>
<form action="./vhost_module/vhost_process.php" method="post">
<table class="inner_table">
	<tr>
		<td colspan=4 style="border-bottom:1px solid rgb(147,174,6); hight: 30px;">&nbsp;&nbsp;&nbsp;虚擬網站資料</td></tr>
	<tr>
		<td class="inner_table_td"> 網站名稱</td>
		<td>
			<input type="text" name="vhost_name" size=30 value="<?php echo $row['vhost'];?>"></input>
		</td>
		<td class="inner_table_td">網站別名</td>
		<td>
			<input type="text" name="vhost_alias" size=30 value="<?php echo $row['valias'];?>"></input>
		</td>
	</tr>
	<tr>
		<td class="inner_table_td">是否啟動</td>
		<td>
			<input type="text" name="ON_OFF" size=5 value="<?php echo $row['enabled'];?>"></input>
		</td>
		<td class="inner_table_td">網站子目錄</td>
		<td><input type="text" name="path" size=30 value="<?php 
			$path=explode(($main_path."/"),$row['rootdir']);
			if (empty($path[1])){
				echo "/";
			} else { echo $path[1]; }
		?>"></input></td>
	</tr>
	<tr>
		<td class="inner_table_td">管理者Email</td>
		<td>
			<input type="text" name="email" size=25 value="<?php echo $row['admin'];?>"></input>
		</td>

		<td colspan=2></td>
	</tr>
	<tr>
		<td colspan=4>
			<input type="hidden" value="<?php echo $main_path; ?>" name="main_path"></input>
			<input type="hidden" value="<?php echo $row[7]; ?>" name="vt_id"></input>
			<input type="hidden" value="<?php echo $row['userID'];?>" name="userID"></input>
			<input type="submit" value="確定修改" name="vhost_update"></input>
			<input type="submit" value="確定刪除" name="vhost_del"></input>
		</td>
	</tr>
</table>
</form>
</tr>
<tr>
	<td colspan=4><br></td>
</tr>
<?php	

	}
	
	$db_conn = NULL ;
?>