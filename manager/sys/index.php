<?php
//系統管理頁面
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//網頁開始
?>
<!DOCTYPE html>
<html>
<?php
require_once '../template/head.php';
if (isset($_GET['item'])){
  $fn = trim($_GET['item']);
} else {
  $fn = 'users';
}

?>
  <body>
    <!-- 網頁最上一行 -->
    <?php
      require_once '../template/header.php';

    ?>
  　<!-- 網頁中間部份 -->
    <br>
     <section id="contact" class="container">
       <div class="row">
         <!-- 左方選單 -->
         <div class="col-sm-3 col-md-3 sidebar">
             <?php
              require_once './menu.php';
              ?>
         </div>
         <!-- 右方顯示資料 -->
         <div class="col-sm-9 col-md-9 rightpart">
           <?php
             switch ($fn) {
               case 'users':
                   include ("admin_index.php");
                   break;
               case 'pro':
                   include ("pro_index.php");
                   break;
               case 'email':
                   include ("email_index.php");
                   break;
               case 'ftp':
                   include ("ftp_index.php");
                   break;
               default:

                     break;
             }

            ?>
         </div>
       </div>
     </section>
    <?php
       require_once '../template/scripts.php';
     ?>
  </body>
</html>
