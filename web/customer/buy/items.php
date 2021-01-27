<?php
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");
//print_r($_SESSION['adminid']);
//var_dump($su_item);
  switch ($su_item) {
    case '1':
      include ("buy/singles.php");
      break;
    case '2':
      include ("buy/mix.php");
      break;
    case '3':
      include ("buy/vpn.php");
      break;
    default:
      print_r("This is default item");
      break;
  }

 ?>
