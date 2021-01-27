<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['pk'])){

  $idno=trim($_GET['pk']);
  $idno1=trim($_GET['pk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE items SET func_id ='".$content."' WHERE id ='".$idno."' AND func_id = '".$idno1."';";
  $stmt=$db_connect->query($sqlstring);

}

if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $idno1=trim($_GET['lk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE items SET func_name = '".$content."' WHERE id ='".$idno."' AND func_id = '".$idno1."';";
  $stmt=$db_connect->query($sqlstring);

}

if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $idno1=trim($_GET['ck1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE items SET comments = '".$content."' WHERE id ='".$idno."' AND func_id = '".$idno1."';";
  $stmt=$db_connect->query($sqlstring);

}
if (isset($_GET['gk'])){

  $idno=trim($_GET['gk']);
  $idno1=trim($_GET['gk1']);
  $content=trim($_POST['value']);
  $content=$content*1024*1024*1024;
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE items SET spaces = ".$content." WHERE id ='".$idno."' AND func_id = '".$idno1."';";
  $stmt=$db_connect->query($sqlstring);

}
if (isset($_GET['fk'])){

  $idno=trim($_GET['fk']);
  $idno1=trim($_GET['fk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="UPDATE items SET prize = '".$content."' WHERE id ='".$idno."' AND func_id = '".$idno1."';";
  $stmt=$db_connect->query($sqlstring);

}
$stmt=null;
?>
