<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring1="SELECT count(*) FROM orders WHERE pays is false;";
$stmt1=$db_connect1->query($sqlstring1);
//var_dump($stmt1);
while ($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  if ($row[0]!==0){
?>
<div class="adcount">
   <h3>訂單通知</h3>
   <hr style="margin-top: 5px; margin-bottom:5px;">
   <div class="alert alert-danger">
     <strong>客戶己經採購!</strong> 請前往「帳務管理」－》<a href="https://manager.vserver.tw/bill/index.php?item=orders" class="alert-link">「新進訂單審查」</a>　進行處理！
  </div>
</div>
<?php
  }
}
 ?>
