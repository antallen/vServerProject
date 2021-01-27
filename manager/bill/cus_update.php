<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['pk'])){

  $idno=trim($_GET['pk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_detail SET mem_name ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect1->query($sqlstring);

}
if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $content=trim($_POST['value']);
  
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_detail SET mem_phone ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect1->query($sqlstring);

}
if (isset($_GET['gk'])){

  $idno=trim($_GET['gk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_detail SET mem_email ='".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect1->query($sqlstring);

}
if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_detail SET mem_id = '".$content."' WHERE id ='".$idno."';";
  $stmt=$db_connect1->query($sqlstring);

}

$stmt=null;
?>
