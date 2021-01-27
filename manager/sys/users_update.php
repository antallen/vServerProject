<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['pk'])){

  $idno=trim($_GET['pk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE users SET passwd ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}
if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE users SET comments ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}
if (isset($_GET['gk'])){

  $idno=trim($_GET['gk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE users SET login ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}
if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE users SET level = ".$content." WHERE id ='".$idno."';";
  $stmt=$db_connect->query($sqlstring);

}

$stmt=null;
?>
