<?php
//時區設定
  date_default_timezone_set('Asia/Taipei');

//編寫常用的設定檔
  $dbserver = "";
  $dbport = "";
  $dbname = "manager";
  $dbuser = "manager";
  $dbpasswd = "";

//連結資料庫
  try {
    $db_connect = new PDO("pgsql:dbname=$dbname;host=$dbserver;port=$dbport;user=$dbuser;password=$dbpasswd");
  } catch (Exception $e) {
    print "Database do not connect !! " . $e->getMessage();
  }

?>
