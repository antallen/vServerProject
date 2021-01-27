<?php
//時區設定
  date_default_timezone_set('Asia/Taipei');

//編寫常用的設定檔
  $dbserver1 = "192.168.100.203";
  $dbport1 = "5432";
  $dbname1 = "vserver";
  $dbuser1 = "vserver";
  $dbpasswd1 = "vserver@2017!kh";

//連結資料庫
  try {
    $db_connect1 = new PDO("pgsql:dbname=$dbname1;host=$dbserver1;port=$dbport1;user=$dbuser1;password=$dbpasswd1");
  } catch (Exception $e1) {
    print "Database do not connect !! " . $e1->getMessage();
  }

?>
