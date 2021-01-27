<?php
//保護機制
require_once '../lib/protected.php';
?>
<!-- 資料維護左方選單 -->
<div class="vertical-menu">
   <h4 class="title">帳務管理</h4>
   <a href="index.php"
   <?php
      if (!isset($_GET['item'])){
        print_r('class="active"');
      }
      ?>
        >客戶資料清單</a>
    <a href="index.php?item=orders"
    <?php
         if (isset($_GET['item']) && ($_GET['item'])=='orders'){
           print_r('class="active"');
         }
     ?>
         >新進訂單審查</a>
   <a href="index.php?item=rent"
   <?php
        if (isset($_GET['item']) && ($_GET['item'])=='rent'){
          print_r('class="active"');
        }
    ?>
        >租賃清單列表</a>
   <a href="index.php?fn=bill"
   <?php
        if (isset($_GET['item']) && ($_GET['item'])=='account'){
          print_r('class="active"');
        }
    ?>
   >項目二</a>
   <a href="#">意見反應</a>
   <a class="footer disabled" href="https://www.w3schools.com/howto/howto_css_vertical_menu.asp">成為代理商</a>
</div>
