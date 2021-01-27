<?php
require_once("conf.php");
//printf("包進來了！");

//取得 7 天內 News 表格內容
//$nowtime=date('Y-m-d H:i:s',time()+(60*60*24*1));
$nowtime=date('Y-m-d H:i:s');
$lastweek=date('Y-m-d H:i:s',time()-(60*60*24*7));

//$sqlstring="SELECT * FROM news WHERE dateandtime BETWEEN '".$lastweek."+8"."' and '".$nowtime."+8"."';";
$sqlstring="SELECT * FROM news WHERE dateandtime BETWEEN '".$lastweek."' and '".$nowtime."' ORDER BY dateandtime DESC;";
//echo $sqlstring;
$db_query = $db_connect->query($sqlstring);
//print_r($db_qyery);
//print_r($db_query->rowCount());
if ($db_query->rowCount() > 0){

while ($row = $db_query->fetch()) {
?>
  <table class="table table-striped">
    <th>
      <td colspan="2">
        <?php
            print "$row[5]";
         ?>
      </td>
    </th>
    <tr>
      <td>
        <?php
            echo substr($row[0],0,10);
         ?>
      </td>
      <td>
        <?php
            echo $row[1];
         ?>
      </td>
    </tr>
  </table>
  <br />
<?php
}
}
else {
  print "No News is good news";
}
?>
