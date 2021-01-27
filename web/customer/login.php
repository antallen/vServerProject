<?php
session_start();
if (!isset($_POST['idname'])){
  exit(header("Location:cus_login.php"));
}
require_once("../lib/recaptcha.php");
require_once("../lib/filters.php");
require_once("../lib/conf.php");
//echo $_POST['passwd'];
//$sqlstring="SELECT * FROM news WHERE";

if (recaptchacheck()){
  //echo "非機器人認證成功！";
  $femail = escape_specialcharator(filter_var($_POST['idname'], FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL));

  if ($femail){
    //echo $femail;
    $sqlstring="SELECT id_passwd,admin_id FROM mem_account NATURAL INNER JOIN mem_admin WHERE login_id = '".$femail."' and mem_account.actives is true and mem_admin.actives is true;";
    $db_query = $db_connect->query($sqlstring);

    //var_dump($db_query);
    if ($db_query->rowCount() > 0){
      while ($row = $db_query->fetch()) {
        $data_pw = $row["id_passwd"];
        $admin_id = $row["admin_id"];
      }
      $orign_pw = escape_specialcharator($_POST['passwd']);
      if ( $data_pw == $orign_pw ){
        $_SESSION['username'] = $femail;
        $_SESSION['adminid'] = $admin_id;
        exit(header("Location:cus_admin.php"));
      } else {
        echo "無符合的帳密資料！";
        session_destroy();
        ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://test.vserver.tw/customer/cus_login.php";
                    }

                    document.write("頁面即將轉換！");
                    setTimeout('Redirect()', 2000);
                 -->
              </script>

        <?php
      }

    } else {
      echo "無符合的帳密資料！";
      session_destroy();
      ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://test.vserver.tw/customer/cus_login.php";
                  }

                  document.write("頁面即將轉換！");
                  setTimeout('Redirect()', 2000);
               -->
            </script>

      <?php
    }

  } else {
    echo "email 有問題！！";
    session_destroy();
    ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://test.vserver.tw/customer/cus_login.php";
                  }

                  document.write("頁面即將轉換！");
                  setTimeout('Redirect()', 2000);
               -->
            </script>

      <?php
  }
} else {
  echo "非機器人認證失敗！";
  session_destroy();
  ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://test.vserver.tw/customer/cus_login.php";
                  }

                  document.write("頁面即將轉換！");
                  setTimeout('Redirect()', 2000);
               -->
            </script>

      <?php
}

?>
