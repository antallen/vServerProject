<?php
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/system.php");

if (!isset($_SESSION['username'])){
  header("HTTP/1.1 301 Moved Permanently");
  header("Location:$site_url");
}
?>
