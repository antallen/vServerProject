<?php
//類別新增頁面
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';

print_r($_POST['id']);
print_r($_POST['name']);
print_r($_POST['level']);
print_r($_POST['comm']);

$sqlstring="INSERT INTO menus(menu_id,name,level,comments) VALUES(:id,:name,:level,:comm);";
$stmt=$db_connect->prepare($sqlstring);
$stmt->bindParam(':id',trim($_POST['id']),PDO::PARAM_STR);
$stmt->bindParam(':name',trim($_POST['name']),PDO::PARAM_STR);
$stmt->bindParam(':level',trim($_POST['level']),PDO::PARAM_STR);
$stmt->bindParam(':comm',trim($_POST['comm']),PDO::PARAM_STR);

$stmt->execute();
?>
<script type="text/javascript">
    <!--
       function Redirect() {
          window.location="http://manager.vserver.tw/sys/index.php?item=users#administrator";
       }

       document.write("等級新增成功！1秒後，將自動跳轉");
       setTimeout('Redirect()', 1);
    -->
 </script>
