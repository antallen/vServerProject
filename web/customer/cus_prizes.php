<?php
session_start();

//導入資料庫設定
require_once ("../lib/conf.php");
require_once ("../lib/conf1.php");
?>
<!DOCTYPE html>
<html>
  <?php
    include ("template/head.php");
  ?>
  <body>
    <!-- 網頁最上一行 -->
    <?php
      include ("../template/header.php");
    ?>
    <!-- 價格表單 -->
    <br>
    <div class="container">
 <div class="row">
   <h3 class="text-center">商品項目價格表</h3>
   <hr>
   <?php
   $sqlstring1="SELECT func_name,func_id, spaces FROM items;";
   $stmt1=$db_connect1->query($sqlstring1);
   $no1 = 0;
   while ($row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
     $single[$no1]=array(trim($row1['0']),trim($row1['1']),trim($row1['2']));
     $single2[trim($row1['1'])]=array(trim($row1['0']),trim($row1['2']));
     $no1 = $no1 + 1;
   }
   $sqlstring="SELECT * FROM productions WHERE actives is true ORDER BY prizes;";
   $stmt=$db_connect->query($sqlstring);
      while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){
    ?>
       <div class="col-sm-3">
         <div class="panel panel-default text-center">
           <div class="panel-heading">
             <h3><?php print_r(trim($row[1])); ?></h3>
           </div>
           <div class="panel-body">
             <h3 class="panel-title price">$<?php print_r(trim($row[5])); ?><span class="price-month">/每月</span></h3>
           </div>
           <ul class="list-group">
             <?php
              for ($i=0;$i<$no1;$i++){
                $pos[$i]=(strpos($row[2],$single[$i][1]));
                $pos[$i+1]=strlen($row[2]);
              }

              for ($i=0;$i<$no1;$i++){
                   $prod_single[$i]=(substr($row[2],intval($pos[$i]),(intval($pos[$i+1])-intval($pos[$i])))."\n");
              }

              for ($i=0;$i<$no1;$i++){

                if (empty(trim($prod_single[$i]))){
                    continue;
                  }else{
                   //var_dump($prod_single[$i]);
                   ?>
                   <li class="list-group-item">
                   <?php
                     $detail_pos=(strpos($prod_single[$i],"n"));
                     print_r(substr(($prod_single[$i]),intval($detail_pos)+1,strlen($prod_single[$i]))." 組　");
                     $prod_id1=trim(substr(($prod_single[$i]),0,intval($detail_pos)-0));
                     print_r($single2[$prod_id1][0]);
                }

                ?>
              </li>
                <?php
              }
              ?>
             <li class="list-group-item">支援 SSL 連線加密</li>
             <li class="list-group-item">支援 PHP、JavaScripts 語言</li>
             <li class="list-group-item">介面操作簡單</li>
             <li class="list-group-item"><font color="red">會員可享更優惠價格！</font></li>
             <li class="list-group-item"><a href="./cus_register.php" class="btn btn-warning">立即加入會員！</a></li>
           </ul>
         </div>
       </div>
   <?php
     }
    ?>
     </div>
 </div>
     <script src="../js/jquery-3.1.1.min.js"></script>
     <script src="../js/bootstrap.js"></script>
  </body>
</html>
