<?php
session_start();
//網頁基本防護
require_once '../lib/protected.php';
//帶入資料庫連結
require_once '../lib/conf.php';

$idno=trim($_POST['forezen']);
echo $idno;
$sqlstring="SELECT * FROM items WHERE id ='".$idno."';";
$stmt=$db_connect->query($sqlstring);

while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  $content=$row[4];
}

if ($content){
  $content = "FALSE";
} else {
  $content = "TRUE";
}

//echo $idno;
$sqlstring="UPDATE items SET actives = ".$content." WHERE id ='".$idno."';";
$stmt=$db_connect->query($sqlstring);
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
              }

              document.write("管理人員帳號狀態改變成功！網頁自動跳轉");
              setTimeout('Redirect()', 1);
           -->
        </script>
  <?php

?>
