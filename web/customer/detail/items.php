<?php
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");
//print_r($_SESSION['adminid']);
//var_dump($su_item);
  switch ($su_item) {
    case '1':
      include ("detail/basedata.php");
      break;
    case '2':
      include ("detail/adcount.php");
      break;
    case '3':
      include ("detail/bills.php");
      break;
    default:
      print_r("This is default item");
      break;
  }

 ?>
