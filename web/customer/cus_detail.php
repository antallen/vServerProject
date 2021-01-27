<?php
session_start();

if (!isset($_SESSION['username'])){
  exit(header("Location:cus_login.php"));
}

require_once("../lib/filters.php");
require_once("../lib/conf.php");

?>
<!DOCTYPE html>
<html>
<?php
  include ("template/head.php");
?>
  <body>
    <!-- 網頁最上一行 -->
    <?php
      include ("template/header.php");
    ?>
    <!-- 會員資料維護表單 -->
    <br>
     <section id="contact" class="container">
       <div class="row">
         <!-- 左方選單 -->
         <div class="col-sm-3 col-md-3 sidebar">
             <?php
                include ("detail/menu.php");
              ?>
         </div>
         <!-- 右方顯示資料 -->
         <div class="col-sm-9 col-md-9 rightpart">
           <?php
              //print_r($_SESSION['username']);
              include ("detail/items.php");
            ?>
         </div>
       </div>
     </section>
     <?php
        include ("template/scripts.php");
      ?>
  </body>
</html>
