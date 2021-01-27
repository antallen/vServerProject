<?php
session_start();
//網頁基本防護
require_once '../lib/protected.php';
//帶入資料庫連結
require_once '../lib/conf1.php';

$idno=trim($_POST['forezen']);
echo $idno;
$sqlstring="SELECT * FROM productions WHERE id ='".$idno."';";
$stmt=$db_connect1->query($sqlstring);

while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  $content=$row[8];
  $times=$row[4];
}

if ($content){
  $content = "FALSE";
  $times = date("Y-m-d h:i:s");
  echo $times;
  $keys = 0;
} else {
  $content = "TRUE";
  $times = "NULL";
  $keys = 1;
}

//echo $idno;
if ($keys == 0){
  $sqlstring="UPDATE productions SET actives = ".$content.", ex_date = '".$times."' WHERE id ='".$idno."';";
} else{
  $sqlstring="UPDATE productions SET actives = ".$content.", ex_date = ".$times." WHERE id ='".$idno."';";
}
$stmt=$db_connect1->query($sqlstring);


if ($stmt) {
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
              }

              document.write("商品狀態改變成功！網頁自動跳轉");
              setTimeout('Redirect()', 1);
           -->
        </script>
  <?php
} else {
  $stmt=null;

  ?>
         <script type="text/javascript">
             <!--
                function Redirect() {
                   window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
                }

                document.write("商品狀態改變失敗！網頁自動跳轉");
                setTimeout('Redirect()', 1);
             -->
          </script>
    <?php
}
?>
