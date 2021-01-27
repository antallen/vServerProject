<?php
//保護機制
require_once '../lib/protected.php';
?>
<!-- 資料維護左方選單 -->
<div class="vertical-menu">
   <h4 class="title">訊息管理</h4>
   <a href="admin_index.php"
   <?php
      if (!isset($_GET['fn'])){
        print_r('class="active"');
      }
      ?>
        >待處理事件通知</a>
   <a href="admin_index.php?fn=news"
   <?php
      if (isset($_GET['fn']) && ($_GET['fn'])=='news'){
        print_r('class="active"');
      }
      ?>
        >最新消息管理</a>
   <a href="admin_index.php?fn=sys"
   <?php
        if (isset($_GET['fn']) && ($_GET['fn'])=='sys'){
          print_r('class="active"');
        }
    ?>
        >項目一</a>
   <a href="admin_index.php?fn=bill"
   <?php
        if (isset($_GET['fn']) && ($_GET['fn'])=='account'){
          print_r('class="active"');
        }
    ?>
   >項目二</a>
   <a href="#">意見反應</a>
   <a class="footer disabled" href="https://www.w3schools.com/howto/howto_css_vertical_menu.asp">成為代理商</a>
</div>
