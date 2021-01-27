<?php
session_start();
require_once("../../lib/filters.php");
require_once("../../lib/conf.php");
//判斷是否有註冊值，如果沒有，表示沒依正常網頁操作方式進入網頁！
if (!isset($_SESSION['register'])){
?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://test.vserver.tw/home.php";
              }

              document.write("You will be redirected to main page in 10 sec.");
              setTimeout('Redirect()', 100);
           -->
        </script>
<?php
} else {
  //接收傳送值
  $rname = $_POST["rname"];
  $rnumber = $_POST["rnumber"];
  $rphone = $_POST["rphone"];

  //除去特殊字元
  $rname = preg_replace('/([^A-Za-z0-9\p{Han}])/ui', '',urldecode($rname));
  $rnumber = escape_specialcharator(trim($rnumber));
  $rphone = escape_specialcharator(trim($rphone));

  //將訊息寫入 session
  $_SESSION['register'] = "step3";
  $_SESSION['rname'] = $rname;
  $_SESSION['rnumber'] = $rnumber;
  $_SESSION['rphone'] = $rphone;

  //轉至第三頁
  ?>
  <script type="text/javascript">
      <!--
         function Redirect() {
            window.location="https://test.vserver.tw/customer/cus_register.php";
         }

         document.write("You will be redirected to main page in 0.1 sec.");
         setTimeout('Redirect()', 1);
      -->
   </script>
  <?php
}
?>
