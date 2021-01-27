<?php
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

 ?>
<!-- 資籿維護左方選單 -->
<div class="vertical-menu">
   <h4 class="title">資料維護</h4>
   <a href="cus_detail.php"
   <?php
      if (!isset($_GET['detail'])){
        print_r('class="active"');
        $su_item = 1;
      }
      ?>
        >基本連絡資訊</a>
   <a href="cus_detail.php?detail=sa"
   <?php
        if (isset($_GET['detail']) && ($_GET['detail'])=='sa'){
          print_r('class="active"');
          $su_item = 2;
        }
    ?>
        >系統管理帳密</a>
   <a href="cus_detail.php?detail=bill"
   <?php
        if (isset($_GET['detail']) && ($_GET['detail'])=='bill'){
          print_r('class="active"');
          $su_item = 3;
        }
    ?>
   >購買記錄</a>
   <a href="#">意見反應</a>
   <a class="footer disabled" href="https://www.w3schools.com/howto/howto_css_vertical_menu.asp">成為代理商</a>
</div>
