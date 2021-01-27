<?php
session_start();
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

function program_jump(){
?>
 <script type="text/javascript">
     <!--
        function Redirect() {
           window.location="http://test.vserver.tw/customer/cus_detail.php?detail=bill";
        }
        document.write("頁面即將轉換！");
        setTimeout('Redirect()', 1);
     -->
</script>
<?php
}

if (isset($_POST['goback'])){
  //echo "查看購買記錄";
  unset($_SESSION['bill']);
  unset($_SESSION['total_pay']);
  unset($_SESSION['order']);
  unset($_SESSION['productions']);
  unset($_SESSION['step']);
  unset($_SESSION['total_spaces']);
  unset($_SESSION['payname']);
  unset($_SESSION['taxes']);
  program_jump();
} else {
  program_jump();
}
?>
