<?php
//保護機制
require_once '../lib/protected.php';
?>
<!-- 資料維護左方選單 -->
<div class="vertical-menu">
   <h4 class="title">系統管理</h4>
   <a href="index.php"
   <?php
      if (!isset($_GET['item'])){
        print_r('class="active"');
      }
      ?>
        >系統管理設定</a>
   <a href="index.php?item=pro"
   <?php
        if (isset($_GET['item']) && ($_GET['item'])=='pro'){
          print_r('class="active"');
        }
    ?>
        >商品功能設定</a>
   <a href="index.php?item=email"
   <?php
        if (isset($_GET['item']) && ($_GET['item'])=='email'){
          print_r('class="active"');
        }
    ?>
   >E-mail 服務設定</a>
   <a href="index.php?item=ftp"
   <?php
        if (isset($_GET['item']) && ($_GET['item'])=='ftp'){
          print_r('class="active"');
        }
    ?>
   >FTP 服務設定</a>
   <a class="footer disabled" href="https://www.w3schools.com/howto/howto_css_vertical_menu.asp">成為代理商</a>
</div>
