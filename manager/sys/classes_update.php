<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['pk'])){

  $idno=trim($_GET['pk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE menus SET name ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}

if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE menus SET comments = '".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}

if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE menus SET level = '".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}

$stmt=null;
?>
