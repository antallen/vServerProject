<?php
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';
require_once '../lib/filters.php';

//取得輸入資料
$proname = trim($_POST['proname']);
$proid = trim($_POST['proid']);
$comm = trim($_POST['comm']);
$spaces = intval(trim($_POST['spaces']));
$prize = intval(trim($_POST['prize']));
//過濾資料

$proname = escape_specialcharator($proname);
$proid = escape_specialcharator($proid);
//$comm = escape_specialcharator($comm);
$spaces = $spaces*1024*1024*1024;
//$prize = preg_match("/^\+?[1-9][0-9]*$/",$prize);

echo $comm."<br>";
echo $spaces."<br>";
echo $prize."<br>";

//設定資料庫
$sqlstring="INSERT INTO items(func_name,func_id,comments,spaces,prize) VALUES(:proname,:proid,:comm,:spaces,:prize);";
$stmt = $db_connect->prepare($sqlstring);
$stmt->bindValue(':proname',trim($proname),PDO::PARAM_STR);
$stmt->bindValue(':proid',trim($proid),PDO::PARAM_STR);
$stmt->bindValue(':comm',trim($comm),PDO::PARAM_STR);
$stmt->bindValue(':spaces',trim($spaces),PDO::PARAM_INT);
$stmt->bindValue(':prize',trim($prize),PDO::PARAM_INT);

if ($stmt->execute()) {
    //echo "寫入基本資料成功！";

    $stmt = null;
    //告知成功
    ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
                  }

                  document.write("單項商品新增成功！10秒後，將自動跳轉");
                  setTimeout('Redirect()', 1);
               -->
            </script>
      <?php
    } else {
      ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
                    }

                    document.write("單項商品新增失敗！10秒後，將自動跳轉");
                    setTimeout('Redirect()', 1);
                 -->
              </script>
        <?php
    }

?>
