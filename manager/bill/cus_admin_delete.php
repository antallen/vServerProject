<?php
session_start();
//網頁基本防護
require_once '../lib/protected.php';
//帶入資料庫連結
require_once '../lib/conf1.php';

$idno=trim($_POST['forezen']);
echo $idno;

//echo $idno;
$sqlstring="DELETE FROM mem_admin WHERE admin_id ='".$idno."';";
$stmt=$db_connect1->query($sqlstring);
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://manager.vserver.tw/bill/index.php#web";
              }

              document.write("多餘管理號碼刪除成功！網頁自動跳轉");
              setTimeout('Redirect()', 1);
           -->
        </script>
  <?php

?>
