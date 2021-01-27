<?php
session_start();
require_once("../../lib/recaptcha.php");
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

//echo "非機器人認證成功！";
  if (recaptchacheck()){
    //echo "非機器人認證成功！";

    //取得最後一筆資料的 id
    $sqlstring = "SELECT id FROM mem_admin ORDER BY id DESC limit 1;";

    $db_query = $db_connect->query($sqlstring);
    if ($db_query->rowCount() > 0){
      while ($row = $db_query->fetch()) {
        $idno = $row["id"];
      }

      //製造一個免費註冊著的管理者編號
      $idnumber = "admin".sprintf("%05d", ($idno + 1));
      $idcomments = "Free Register Member";
      $sql = "INSERT INTO mem_admin(admin_id,id_comments) VALUES(:admin_id,:id_comments);";
      //print_r($idnumber);
      $stmt = $db_connect->prepare($sql);
      $stmt->bindValue(':admin_id',$idnumber,PDO::PARAM_STR);
      $stmt->bindValue(':id_comments',$idcomments,PDO::PARAM_STR);

      if ($stmt->execute()) {
        //echo "帳號新增成功！";
        //寫入基本資料
        $sql = "INSERT INTO mem_detail(admin_id,mem_name,mem_id,mem_phone,mem_email) VALUES(:admin_id,:name,:cid,:phone,:email);";
        $stmt = $db_connect->prepare($sql);
        $stmt->bindValue(':admin_id',$idnumber,PDO::PARAM_STR);
        $stmt->bindValue(':name',$_SESSION['rname'],PDO::PARAM_STR);
        $stmt->bindValue(':cid',$_SESSION['rnumber'],PDO::PARAM_STR);
        $stmt->bindValue(':phone',$_SESSION['rphone'],PDO::PARAM_STR);
        $stmt->bindValue(':email',$_SESSION['email_id'],PDO::PARAM_STR);

        if ($stmt->execute()) {
            //echo "寫入基本資料成功！";

              //寫入管理用帳密
              $sql = "INSERT INTO mem_account(login_id,id_passwd,admin_id) VALUES(:email,:password,:admin_id);";
              $stmt = $db_connect->prepare($sql);
              $stmt->bindValue(':email',$_SESSION['email_id'],PDO::PARAM_STR);
              $stmt->bindValue(':password',$_SESSION['password1'],PDO::PARAM_STR);
              $stmt->bindValue(':admin_id',$idnumber,PDO::PARAM_STR);
              $stmt->execute();
              //echo "寫入管理用帳密成功！";

              session_destroy();

              //告知成功，可登入系統
              ?>
                     <script type="text/javascript">
                         <!--
                            function Redirect() {
                               window.location="http://test.vserver.tw/home.php";
                            }

                            document.write("帳號註冊成功！可登入系統！10秒後，將自動跳轉");
                            setTimeout('Redirect()', 1000);
                         -->
                      </script>
                <?php

        } else {
          ?>
                 <script type="text/javascript">
                     <!--
                        function Redirect() {
                           window.location="http://test.vserver.tw/customer/cus_register.php";
                        }

                        document.write("帳號註冊失敗！請重新輸入");
                        setTimeout('Redirect()', 5000);
                     -->
                  </script>
            <?php
        }

      } else {

        ?>
               <script type="text/javascript">
                   <!--
                      function Redirect() {
                         window.location="http://test.vserver.tw/customer/cus_register.php";
                      }

                      document.write("帳號註冊失敗！請重新輸入");
                      setTimeout('Redirect()', 5000);
                   -->
                </script>
          <?php
      }

    } else {
      echo "SQL Server 查詢錯誤！";
    }

  } else {
    ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://test.vserver.tw/customer/cus_register.php";
                  }

                  document.write("非機器人認證失敗！請重新輸入");
                  setTimeout('Redirect()', 5000);
               -->
            </script>
      <?php
  }
?>

<?php
}
?>
