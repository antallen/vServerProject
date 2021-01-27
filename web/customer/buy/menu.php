<?php
include_once ("../lib/page_protected.php");
?>
<div class="vertical-menu">
   <h4 class="title">產品購買</h4>
   <a href="#">老客戶續約</a>
   <a href="cus_purch.php"
   <?php
      if (!isset($_GET['buy'])){
        print_r('class="active"');
        $su_item = 1;
      } else {
        $su_item = trim($_GET['buy']);
      }
      ?>
    >單項產品購買</a>
   <a href="#">套裝產品購買</a>
   <a href="#">VPN 帳號購買</a>
   <a href="#">網域名稱代購</a>
   <a class="footer disabled" href="https://test.vserver.tw/customer/cus_detail.php?detail=bill">購買記錄查詢</a>
</div>
