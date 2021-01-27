<?php
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';
require_once '../lib/filters.php';

//取得輸入資料
$login = trim($_POST['loginname1']);
$passwd = trim($_POST['passwd']);
$level = trim($_POST['level']);
$comm = trim($_POST['comm']);

//過濾資料
$login = escape_specialcharator($login);
$passwd = escape_specialcharator($passwd);
$level = escape_specialcharator($level);
$comm = escape_specialcharator($comm);

//設定資料庫
$sqlstring="INSERT INTO users(login,passwd,level,comments) VALUES(:login,:passwd,:level,:comments);";
$stmt = $db_connect->prepare($sqlstring);
$stmt->bindValue(':login',$login,PDO::PARAM_STR);
$stmt->bindValue(':passwd',$passwd,PDO::PARAM_STR);
$stmt->bindValue(':level',$level,PDO::PARAM_INT);
$stmt->bindValue(':comments',$comm,PDO::PARAM_STR);


if ($stmt->execute()) {
    //echo "寫入基本資料成功！";

    $stmt = null;
    //告知成功
    ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://manager.vserver.tw/sys/index.php";
                  }

                  document.write("管理人員新增成功！10秒後，將自動跳轉");
                  setTimeout('Redirect()', 1000);
               -->
            </script>
      <?php
    } else {
      ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://manager.vserver.tw/sys/index.php";
                    }

                    document.write("管理人員新增失敗！10秒後，將自動跳轉");
                    setTimeout('Redirect()', 1000);
                 -->
              </script>
        <?php
    }

?>
