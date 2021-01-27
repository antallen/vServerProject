<?php
if (!isset($_SESSION['username'])){
  ?>
       <script type="text/javascript">
           <!--
              function Redirect() {
                 window.location="http://test.vserver.tw/customer/cus_login.php";
              }

              document.write("頁面即將轉換！");
              setTimeout('Redirect()', 1);
           -->
        </script>

  <?php
}
?>
