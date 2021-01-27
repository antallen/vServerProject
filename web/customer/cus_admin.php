<?php
session_start();

if (!isset($_SESSION['username'])){
  exit(header("Location:cus_login.php"));
}
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
    <!-- 會員登入表單 -->
    <br>
     <section id="contact" class="container">
       <div class="row">
         <div class="col-sm-3 col-md-3 sidebar">
             <?php
                include ("admin/menu.php");
              ?>
         </div>
         <div class="col-sm-9 col-md-9 rightpart">
           <?php
              include ("admin/items.php");
            ?>
         </div>
       </div>
     </section>
     <?php
        include ("template/scripts.php");
     ?>
  </body>
</html>
