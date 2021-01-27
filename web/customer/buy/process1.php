<?php
session_start();
function call_header(){
  header("Location:http://test.vserver.tw/customer/cus_purch.php");
}
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

function program_jump(){
?>
 <script type="text/javascript">
     <!--
        function Redirect() {
           window.location="http://test.vserver.tw/customer/cus_purch.php";
        }
        document.write("頁面即將轉換！");
        setTimeout('Redirect()', 1);
     -->
</script>
<?php
}
//echo $_SESSION['username'];
  if (!isset($_POST['step'])){
    $_SESSION['step'] = "step1";
  } else {

    if ((trim($_POST['step']) == "step1") && (isset($_POST['option']))){

    //var_dump($_POST['option']);
    //var_dump($_POST['num']);

        for ($no = 0 ; $no < count($_POST['option']); $no++){

          $order_name=substr(trim($_POST['option'][$no]),0,intval(strpos(trim($_POST['option'][$no]),"$")));
          $i=intval(strpos(trim($_POST['option'][$no]),"$"));
          $j=intval(strpos(trim($_POST['option'][$no]),"#" ));
          $k=intval(strlen(trim($_POST['option'][$no])));
          $order_order = substr(trim($_POST['option'][$no]),$i+1,$j-$i-1);
          $order_prize = substr(trim($_POST['option'][$no]),$j+1,$k-$j-1);
          $order_num = $_POST['num'][$order_order];

          //只計算10個月
          $order_prize_total = intval($order_prize)*intval($order_num)*10;

          if (($order_prize_total <= 0) || ($order_prize_total == NULL)){
            $_SESSION['step'] = "step1";
            call_header();
            break;
          }

          $order_all[$no] = array($order_name,$order_num,$order_prize,$order_prize_total);
        }
    //var_dump($order_all);
        $_SESSION['order'] = $order_all;
        $_SESSION['step'] = "step2";
    //var_dump($_SESSION['order']);
    } else {
      $_SESSION['step'] = "step1";
    }
  }
program_jump();

?>
