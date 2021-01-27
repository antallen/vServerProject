<?php
session_start();
include_once ("../../lib/page_protected.php");
require_once("../../lib/conf.php");

//信箱停用
if (isset($_POST['forezen'])){
  $email = trim($_POST['forezen']);
  $sqlstring="SELECT * FROM virtual_users WHERE email ='".$email."';";
  $stmt=$db_connect->query($sqlstring);

  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){
    $content=($row[7]);

  }

  if ($content){
    $content = "FALSE";
  } else {
    $content = "TRUE";
  }
  $sqlstring="UPDATE virtual_users SET actives = ".$content." WHERE email ='".$email."';";
  $stmt=$db_connect->query($sqlstring);

}

if ($stmt) {
$stmt=null;

?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://test.vserver.tw/customer/cus_admin.php?admin=3";
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
                   window.location="http://test.vserver.tw/customer/cus_admin.php?admin=3";
                }

                document.write("商品狀態改變失敗！網頁自動跳轉");
                setTimeout('Redirect()', 1);
             -->
          </script>
    <?php
}
?>
