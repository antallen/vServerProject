<?php
session_start();
//網頁基本防護
require_once '../lib/protected.php';
//帶入資料庫連結
require_once '../lib/conf1.php';

$idno=trim($_POST['forezen']);
echo $idno;
$sqlstring="SELECT * FROM mem_admin WHERE admin_id ='".$idno."';";
$stmt=$db_connect1->query($sqlstring);

while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  $content=$row[3];
}

if ($content){
  $content = "FALSE";
} else {
  $content = "TRUE";
}

//echo $idno;
$sqlstring="UPDATE mem_admin SET actives = ".$content." WHERE admin_id ='".$idno."';";
$stmt=$db_connect1->query($sqlstring);
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://manager.vserver.tw/bill/index.php#news";
              }

              document.write("客戶狀態改變成功！網頁自動跳轉");
              setTimeout('Redirect()', 1);
           -->
        </script>
  <?php

?>
