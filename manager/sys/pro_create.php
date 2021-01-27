<!-- 商品新增 -->
<?php
//網頁基本防護
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/system.php");

if (!isset($_POST['proname'])){
  ?>
  <script type="text/javascript">
      <!--
         function Redirect() {
            window.location="http://manager.vserver.tw/index.php";
         }

         document.write("非法連結！自動跳轉網頁！");
         setTimeout('Redirect()', 1);
      -->
   </script>
  <?php
} else {

//帶入資料庫連結
  require_once '../lib/conf.php';
  $sqlstring="SELECT * FROM items WHERE actives is true";
  //print_r($sqlstring);
  $stmt=$db_connect->query($sqlstring);

  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
    $prolist[trim($row[2])]=array(trim($row[5]),trim($row[6]));
  }
  //var_dump($prolist);

//取得商品稱
  $proname=trim($_POST['proname']);
//  echo $proname;

//接受 checkbox 內容
  $checkbox=$_POST['ck'];
//  var_dump($checkbox);

//由 checkbox 取得該項商品數量
  $pro_id = "";
  $pro_space = 0;
  $pro_prize = 0;

  foreach($checkbox as $proname1){
    $proname1=trim($proname1);
    //print_r($proname1);
    //echo $_POST[$proname1];
    $pro_id = $pro_id.$proname1."n".trim($_POST[$proname1]);
    $pro_space = $pro_space + intval(trim($prolist[$proname1][0]))*intval(trim($_POST[$proname1]));
    $pro_prize = $pro_prize + intval(trim($prolist[$proname1][1]))*intval(trim($_POST[$proname1]));
  }
//  echo "$pro_id";
//  echo "$pro_space";
//  echo "$pro_prize";

  //接收產品說明
  $comm = trim($_POST['comm']);

  //準備連結產品資料表
  require_once '../lib/conf1.php';
  $sqlstring1="INSERT INTO productions(prod_name,prod_id,prizes,spaces,comments) VALUES(:proname,:proid,:prize,:spaces,:comm);";
  $stmt1 = $db_connect1->prepare($sqlstring1);
  $stmt1->bindValue(':proname',trim($proname),PDO::PARAM_STR);
  $stmt1->bindValue(':proid',trim($pro_id),PDO::PARAM_STR);
  $stmt1->bindValue(':comm',trim($comm),PDO::PARAM_STR);
  $stmt1->bindValue(':spaces',trim($pro_space),PDO::PARAM_INT);
  $stmt1->bindValue(':prize',trim($pro_prize),PDO::PARAM_INT);

  if ($stmt1->execute()) {
      //echo "寫入基本資料成功！";

      $stmt1 = null;
      //告知成功
      ?>
             <script type="text/javascript">
                 <!--
                    function Redirect() {
                       window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
                    }

                    document.write("商品新增成功！10秒後，將自動跳轉");
                    setTimeout('Redirect()', 1);
                 -->
              </script>
        <?php
      } else {
        $stmt1 = null;
        ?>
               <script type="text/javascript">
                   <!--
                      function Redirect() {
                         window.location="http://manager.vserver.tw/sys/index.php?item=pro#single";
                      }

                      document.write("商品新增失敗！10秒後，將自動跳轉");
                      setTimeout('Redirect()', 1);
                   -->
                </script>
          <?php
      }
}
?>
