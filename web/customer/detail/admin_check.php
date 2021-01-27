<?php
session_start();
$root_path = $_SERVER['DOCUMENT_ROOT'];
require_once($root_path."/lib/filters.php");
require_once($root_path."/lib/conf.php");

$admin_id = trim($_SESSION['adminid']);

function success_return(){
  $_SESSION['msg1'] = "新增成功！";
  header("Location:https://test.vserver.tw/customer/cus_detail.php?detail=sa");
}

function error_return(){
  $_SESSION['msg1'] = "新增失敗！帳號有問題！";
  header("Location:https://test.vserver.tw/customer/cus_detail.php?detail=sa");
}

function success_delete(){
  $_SESSION['msg2'] = "刪除成功！";
  header("Location:https://test.vserver.tw/customer/cus_detail.php?detail=sa");
}

function error_delete(){
  $_SESSION['msg2'] = "刪除失敗！帳號有問題！";
  header("Location:https://test.vserver.tw/customer/cus_detail.php?detail=sa");
}

if (isset($_POST["delete"])){
  $delete = $_POST["delete"];
  //print_r($delete);
  $sqlstring="DELETE FROM mem_account WHERE admin_id = '".$admin_id."' AND login_id = '".$delete."';";
  $db_query = $db_connect->query($sqlstring);

  if ($db_query){
    success_delete();
  } else {
    error_delete();
  }
}

if (isset($_POST["idname"]) && isset($_POST["passwd"])){
  $idname = trim($_POST["idname"]);
  $passwd = $_POST["passwd"];
  //print_r($idname);

  $femail = escape_specialcharator(filter_var($idname, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL));
  if ($femail){
    $sqlstring="INSERT INTO mem_account(login_id,id_passwd,admin_id) VALUES('".$femail."','".$passwd."','".$admin_id."');";
    $db_query = $db_connect->query($sqlstring);

    if ($db_query){
      success_return();
    } else {
      error_return();
    }
  } else {
    error_return();
  }
}
header("Location:https://test.vserver.tw/customer/cus_detail.php?detail=sa");
?>
