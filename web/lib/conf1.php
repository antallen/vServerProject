<?php
//時區設定
  date_default_timezone_set('Asia/Taipei');

//編寫常用的設定檔
  $dbserver1 = "";
  $dbport1 = "";
  $dbname1 = "manager";
  $dbuser1 = "manager";
  $dbpasswd1 = "";

//連結資料庫
  try {
    $db_connect1 = new PDO("pgsql:dbname=$dbname1;host=$dbserver1;port=$dbport1;user=$dbuser1;password=$dbpasswd1");
  } catch (Exception $e1) {
    print "Database do not connect !! " . $e1->getMessage();
  }

?>
