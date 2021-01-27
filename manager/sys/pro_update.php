<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $idno1=trim($_GET['lk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE productions SET prod_name ='".$content."' WHERE id ='".$idno."' AND prod_id = '".$idno1."';";
  $stmt1=$db_connect1->query($sqlstring);

}

if (isset($_GET['pk'])){

  $idno=trim($_GET['pk']);
  $idno1=trim($_GET['pk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE productions SET prod_id ='".$content."' WHERE id ='".$idno."' AND prod_id = '".$idno1."';";
  $stmt1=$db_connect1->query($sqlstring);

}

if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $idno1=trim($_GET['ck1']);
  $content=intval(trim($_POST['value']));
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE productions SET prizes = ".$content." WHERE id ='".$idno."' AND prod_id = '".$idno1."';";
  $stmt1=$db_connect1->query($sqlstring);

}

if (isset($_GET['ak'])){

  $idno=trim($_GET['ak']);
  $idno1=trim($_GET['ak1']);
  $content=intval(trim($_POST['value']))*(1024*1024*1024);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE productions SET spaces = ".$content." WHERE id ='".$idno."' AND prod_id = '".$idno1."';";
  $stmt1=$db_connect1->query($sqlstring);

}

if (isset($_GET['bk'])){

  $idno=trim($_GET['bk']);
  $idno1=trim($_GET['bk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE productions SET comments = '".$content."' WHERE id ='".$idno."' AND prod_id = '".$idno1."';";
  $stmt1=$db_connect1->query($sqlstring);

}

$stmt1 = null

?>
