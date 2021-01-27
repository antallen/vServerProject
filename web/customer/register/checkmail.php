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
    $email = $_POST["regemail"];
    $password1 = $_POST["passwd1"];
    $password2 = escape_specialcharator(trim($password1));
    $chk_email = escape_specialcharator(trim($email));
    if (email_check($chk_email)){
      print_r("E-mail 格式正確！");

      //判斷是否己有帳號在裡面了
      $sqlstring = "SELECT COUNT(login_id) FROM mem_account WHERE login_id = '".$chk_email."';";
      $db_query = $db_connect->query($sqlstring);
      if ($db_query->rowCount() > 0){
        while ($row = $db_query->fetch()) {
          if ($row["count"] == 0){
             print_r("確認無該帳號！");
             $_SESSION['register'] = "step2";
             $_SESSION['email_id'] = $chk_email;
             $_SESSION['password1'] = $password2;
          } else {
             print_r("帳號重複！");
             $_SESSION['register'] = "step1";
             $_SESSION['email_id'] = $chk_email;
             unset($_SESSION['lock']);
          }
        }
      } else {
        echo "SQL Server 查詢錯誤！";
      }

    } else {
      print_r("E-mail 格式有問題！");
    }
    print_r($chk_email);
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
