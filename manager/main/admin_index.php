<?php
session_start();

//網頁基本防護
require_once '../lib/protected.php';

//網頁開始
?>
<!DOCTYPE html>
<html>
<?php
require_once '../template/head.php';
if (isset($_GET['fn'])){
  $fn = trim($_GET['fn']);
} else {
  $fn = 'notify';
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
                require_once '../template/menu.php';
              ?>
         </div>
         <!-- 右方顯示資料 -->
         <div class="col-sm-9 col-md-9 rightpart">
           <?php
             switch ($fn) {
               case 'notify':
                   include ("notify_index.php");
                   break;
               case 'news':
                   include ("news_index.php");
                   break;
               case 'sys':
                   break;
               case 'account':
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
