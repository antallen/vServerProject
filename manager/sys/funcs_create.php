<?php
//等級新增頁面
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';

print_r($_POST['funs_id']);
print_r($_POST['funs_name']);
print_r($_POST['class_id']);
print_r($_POST['funs_level']);
print_r($_POST['comms']);

$sqlstring="INSERT INTO funs(funs_id,name,menu_id,level,comments) VALUES(:funid,:name,:menuid,:level,:comm)";
$stmt=$db_connect->prepare($sqlstring);
$stmt->bindParam(':funid',trim($_POST['funs_id']),PDO::PARAM_STR);
$stmt->bindParam(':name',trim($_POST['funs_name']),PDO::PARAM_STR);
$stmt->bindParam(':menuid',trim($_POST['class_id']),PDO::PARAM_STR);
$stmt->bindParam(':level',trim($_POST['funs_level']),PDO::PARAM_STR);
$stmt->bindParam(':comm',trim($_POST['comms']),PDO::PARAM_STR);

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
