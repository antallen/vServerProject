<?php
	include_once("conf.php");

	$sql_lang = 'SELECT Distinct adminuser.userID,customerData.cusname,customerData.company
				 FROM customerData
				 LEFT JOIN adminuser
				 ON customerData.userID = adminuser.userID
				 WHERE adminuser.level < 90
				';

	$stmt = $db_conn->prepare($sql_lang);
	
	$stmt->execute(array("user_ID" => $_SESSION['uid']));
	
	while ($row = $stmt->fetch()){
		echo "<tr>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>
				<input type=\"button\" value=\"基本資料\" onClick=\"post_to_url('module/base_data.php',{'q':'".$row['userID']."'})\"></input>
				<input type=\"button\" value=\"租用資料\" onClick=\"post_to_url('module/rent_list.php',{'q':'".$row['userID']."'})\"''></input>
				<input type=\"button\" value=\"系統設定資料\" onClick=\"post_to_url('module/systemdata/system_list.php',{'q':'".$row['userID']."'})\"''></input>
				</td>";
		echo "<tr>";
	}
?>

</script>