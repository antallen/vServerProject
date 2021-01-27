<?php
session_start();
//網頁基本防護
require_once '../lib/protected.php';
//帶入資料庫連結
require_once '../lib/conf1.php';

$idno=trim($_POST['newsdel']);
//echo $idno;
$sqlstring="DELETE FROM news WHERE id ='".$idno."';";
$stmt=$db_connect1->query($sqlstring);
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://manager.vserver.tw/main/admin_index.php?fn=news";
              }

              document.write("最新消息刪除！網頁自動跳轉");
              setTimeout('Redirect()', 1);
           -->
        </script>
  <?php

?>
