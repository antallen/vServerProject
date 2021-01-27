<?php
include_once ("../lib/page_protected.php");

  switch ($su_item) {
    case '1':
      include ("admin/files.php");
      break;
    case '2':
      include ("admin/books.php");
      break;
    case '3':
      include ("admin/emails.php");
      break;
    default:
      print_r("This is default item");
      break;
  }

 ?>
