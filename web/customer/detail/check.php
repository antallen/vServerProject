<?php
session_start();
$root_path = $_SERVER['DOCUMENT_ROOT'];
require_once($root_path."/lib/filters.php");
require_once($root_path."/lib/conf.php");

var_dump($_POST);
//$_POST["value"];
$pk = $_POST["pk"];
$admin_id = $_SESSION['adminid'];

switch ($pk) {
  case 1:
    //update mem_name
    $sqlstring="UPDATE mem_detail SET mem_name ='".$_POST["value"]."' WHERE admin_id ='".$admin_id."';";
    $db_query = $db_connect->query($sqlstring);
    break;
  case 2:
    //update mem_id
    $sqlstring="UPDATE mem_detail SET mem_id ='".$_POST["value"]."' WHERE admin_id ='".$admin_id."';";
    $db_query = $db_connect->query($sqlstring);
    break;
  case 3:
    //update mem_id
    $sqlstring="UPDATE mem_detail SET mem_phone ='".$_POST["value"]."' WHERE admin_id ='".$admin_id."';";
    $db_query = $db_connect->query($sqlstring);
    break;
  case 4:
    //update mem_id
    $sqlstring="UPDATE mem_detail SET mem_email ='".$_POST["value"]."' WHERE admin_id ='".$admin_id."';";
    $db_query = $db_connect->query($sqlstring);
    break;
  default:
    # code...
    break;
}

?>
