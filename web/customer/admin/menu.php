<?php
include_once ("../lib/page_protected.php");
?>
<div class="vertical-menu">
   <h4 class="title">系統組態管理</h4>
   <a href="cus_admin.php"
   <?php
      if (!isset($_GET['admin'])){
        print_r('class="active"');
        $su_item = 1;
      } else {
        $su_item = trim($_GET['admin']);
      }
      ?>
    >檔案目錄管理</a>
   <a href="#">Web 站台設定</a>
   <a href="#">FTP 設定</a>
   <a href="cus_admin.php?admin=3"
     <?php
        if (isset($_GET['admin']) && trim($_GET['admin']) == '3'){
          print_r('class="active"');
        }
      ?>
   >E-mail 設定</a>
   <a href="#">SQL 設定</a>
   <a class="footer disabled" href="https://www.w3schools.com/howto/howto_css_vertical_menu.asp">DNS 設定</a>
</div>
