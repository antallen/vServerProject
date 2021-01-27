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
           window.location="http://test.vserver.tw/customer/cus_purch.php";
        }
        document.write("頁面即將轉換！");
        setTimeout('Redirect()', 1);
     -->
</script>
<?php
}

if (isset($_POST['up'])&&(trim($_POST['step'])=="step2")){
  //echo "上一步";
  $_SESSION['step']="step1";
  program_jump();
} else {

    if (isset($_POST['down'])&&(trim($_POST['step'])=="step2")){
        //echo "結帳頁面";
        $_SESSION['payname']=trim($_POST['payname']);
        $_SESSION['taxes']=trim($_POST['taxes']);
        //var_dump($_SESSION['payname']);
        //var_dump($_SESSION['bill']);
        //var_dump($_SESSION['total_pay']);
        //var_dump($_SESSION['total_spaces']);
        order_sql();
        $_SESSION['step']="step3";
        program_jump();

    } else {

      if (trim($_SESSION['step']=="step3")||(trim($_POST['step'])=="step3")){
        $_SESSION['step']="step1";
      }
      unset($_SESSION['bill']);
      unset($_SESSION['total_pay']);
      unset($_SESSION['order']);
      unset($_SESSION['productions']);
      unset($_SESSION['total_spaces']);
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

}
function order_sql(){
  //$_SESSION['payname'],$_SESSION['bill'],$_SESSION['total_pay'],$_SESSION['total_spaces']
  $root_path = $_SERVER['DOCUMENT_ROOT'];
  include ($root_path."/lib/conf.php");
  $sql_order_string="INSERT INTO orders(order_id,admin_id,prizes,spaces,payname,ticket_type,expire_date) VALUES(:order_id,:admin_id,:prizes,:spaces,:payname,:ticket,:expire);";
  //echo $_SESSION['adminid'];
  $stmt=$db_connect->prepare($sql_order_string);
  $order_id=trim($_SESSION['adminid'])."n".date("YmdHis");
  $expire_date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+366,date("Y")));
  //echo $order_id;
  $stmt->bindValue(':order_id',trim($order_id),PDO::PARAM_STR);
  $stmt->bindValue(':admin_id',trim($_SESSION['adminid']),PDO::PARAM_STR);
  $stmt->bindValue(':prizes',trim($_SESSION['total_pay']),PDO::PARAM_INT);
  $stmt->bindValue(':spaces',trim($_SESSION['total_spaces']),PDO::PARAM_INT);
  $stmt->bindValue(':payname',trim($_SESSION['payname']),PDO::PARAM_STR);
  $stmt->bindValue(':ticket',trim($_SESSION['taxes']),PDO::PARAM_STR);
  $stmt->bindValue(':expire',trim($expire_date),PDO::PARAM_STR);
  //print_r(trim($order_id));
  //print_r($_SESSION['adminid']);
  //print_r($_SESSION['total_pay']);
  //print_r($_SESSION['total_spaces']);
  //print_r($_SESSION['payname']);
  $stmt->execute();
  $sql_detail_string="INSERT INTO order_detail(order_id,detail_id,prod_id,prizes,spaces,nums) VALUES(:order_id,:detail_id,:prod_id,:prizes,:spaces,:nums);";
  $stmt=$db_connect->prepare($sql_detail_string);
  for ($oid=0;$oid < count($_SESSION['bill']);$oid++){
    $stmt->bindValue(':order_id',trim($order_id),PDO::PARAM_STR);
    $order_detail_id=trim($order_id)."m".$oid;
    $stmt->bindValue(':detail_id',trim($order_detail_id),PDO::PARAM_STR);
    $stmt->bindValue(':prod_id',trim($_SESSION['bill'][$oid][2]),PDO::PARAM_STR);
    $stmt->bindValue(':prizes',intval(trim($_SESSION['bill'][$oid][5])),PDO::PARAM_INT);
    $stmt->bindValue(':spaces',intval(trim($_SESSION['bill'][$oid][4])),PDO::PARAM_INT);
    $stmt->bindValue(':nums',intval(trim($_SESSION['bill'][$oid][3])),PDO::PARAM_INT);
    $stmt->execute();
  }
}
?>
