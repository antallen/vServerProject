<?php
session_start();

//防止不正常連線
if (!isset($_POST['idname'])){
  exit(header("Location:index.php"));
}

require_once("lib/recaptcha.php");
require_once("lib/filters.php");
require_once("lib/conf.php");
//echo $_POST['passwd'];
//$sqlstring="SELECT * FROM news WHERE";

if (recaptchacheck()){
  //echo "非機器人認證成功！";
  $femail = escape_specialcharator(filter_var($_POST['idname'], FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL));

  if ($femail){
    //echo $femail;
    $sqlstring="SELECT passwd,level FROM users WHERE login = '".$femail."' and actives is true;";
    $db_query = $db_connect->query($sqlstring);

    //var_dump($db_query);
    if ($db_query->rowCount() > 0){
      while ($row = $db_query->fetch()) {
        $data_pw = $row["passwd"];
        $level = $row["level"];
      }
      $orign_pw = escape_specialcharator($_POST['passwd']);
      if ( trim($data_pw) == trim($orign_pw) ){
        $_SESSION['username'] = $femail;
        $_SESSION['level'] = $level;
        exit(header("Location:main/admin_index.php"));
      } else {
        echo "帳密資料有誤！";
        session_destroy();
        ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://manager.vserver.tw/index.php";
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
                     window.location="http://manager.vserver.tw/index.php";
                  }

                  document.write("頁面即將轉換！");
                  setTimeout('Redirect()', 2000);
               -->
            </script>

      <?php

    }



  } else {
    echo "帳號有問題！！";
    session_destroy();
    ?>
         <script type="text/javascript">
             <!--
                function Redirect() {
                   window.location="http://manager.vserver.tw/index.php";
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
                 window.location="http://manager.vserver.tw/index.php";
              }

              document.write("頁面即將轉換！");
              setTimeout('Redirect()', 2000);
           -->
        </script>

  <?php
}

?>
