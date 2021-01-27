<?php
//等級新增頁面
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';

print_r($_POST['deletes']);

$sqlstring="DELETE FROM funs WHERE id = :ids;";
$stmt=$db_connect->prepare($sqlstring);
$stmt->bindValue(':ids',intval(trim($_POST['deletes'])),PDO::PARAM_INT);

$stmt->execute();
?>
<script type="text/javascript">
    <!--
       function Redirect() {
          window.location="http://manager.vserver.tw/sys/index.php?item=users#administrator";
       }

       document.write("等級刪除成功！1秒後，將自動跳轉");
       setTimeout('Redirect()', 1);
    -->
 </script>
