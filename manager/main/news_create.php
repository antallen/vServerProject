<?php
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';

//取得輸入資料
$title = trim($_POST['newstitle']);
$content = trim($_POST['newscontent']);
$adminid = "ADV0001";

//設定資料庫
$sqlstring="INSERT INTO news(content,admin_id,newstitle) VALUES(:content,:admin_id,:title);";
$stmt = $db_connect1->prepare($sqlstring);
$stmt->bindValue(':admin_id',$adminid,PDO::PARAM_STR);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':content',$content,PDO::PARAM_STR);
if ($stmt->execute()) {
    //echo "寫入基本資料成功！";

    $stmt = null;
    //告知成功
    ?>
           <script type="text/javascript">
               <!--
                  function Redirect() {
                     window.location="http://manager.vserver.tw/main/admin_index.php?fn=news";
                  }

                  document.write("最新消息新增成功！10秒後，將自動跳轉");
                  setTimeout('Redirect()', 1000);
               -->
            </script>
      <?php
    } else {
      ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://manager.vserver.tw/main/admin_index.php?fn=news";
                    }

                    document.write("最新消息新增失敗！10秒後，將自動跳轉");
                    setTimeout('Redirect()', 1000);
                 -->
              </script>
        <?php
    }
?>
