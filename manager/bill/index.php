<?php
//帳務管理頁面
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
  $fn = 'customers';
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
               case 'customers':
                   include ("cus_index.php");
                   break;
               case 'orders':
                   include ("orders_index.php");
                   break;
               case 'rent':
                   include ("rent_index.php");
                   break;
               case 'email':
                   include ("index.php");
                   break;
               case 'ftp':
                   include ("index.php");
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
