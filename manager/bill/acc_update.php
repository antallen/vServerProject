<?php
//網頁基本防護
require_once '../lib/protected.php';

if (isset($_GET['ck'])){

  $idno=trim($_GET['ck']);
  $idno1=trim($_GET['ck1']);
  $content=trim($_POST['value']);

  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_account SET id_passwd ='".$content."' WHERE admin_id ='".$idno."' AND id_passwd = '".$idno1."';";
  $stmt=$db_connect1->query($sqlstring);

}

if (isset($_GET['lk'])){

  $idno=trim($_GET['lk']);
  $idno1=trim($_GET['lk1']);
  $content=trim($_POST['value']);
  //帶入資料庫連結
  require_once '../lib/conf1.php';
  $sqlstring="UPDATE mem_account SET login_id = '".$content."' WHERE admin_id ='".$idno."' AND login_id ='".$idno1."';";
  $stmt=$db_connect1->query($sqlstring);

}

$stmt=null;
?>
