<?php
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

require_once ($root_path."/lib/conf.php");
$sqlstring="SELECT * FROM orders order by build_date DESC;";
$stmt=$db_connect->query($sqlstring);
$sql_detail="SELECT * FROM order_detail WHERE order_id = :order_id;";
$stmt1=$db_connect->prepare($sql_detail);
proc_name();
 ?>
<div class="adcount">
  <ul id="home-tabs" class="nav nav-tabs">
    <li role="presentation"  class="active"><a href="#new" data-toggle="tab">有效訂單列表</a></li>
    <li role="presentation"><a href="#expired" data-toggle="tab">己過期訂單列表</a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="new">
      <?php
          $proc_name1 = $_SESSION['productions'];
          $now = date("Y-m-d H:i:s");
          while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $order_id = trim($row[1]);

            if ($row[12]>=$now){
       ?>
                <br>
                <div class="panel panel-default col-sm-12">
                    <div class="panel-body">
                      <div class="table-responsive">
                        <div class="col-sm-8">購買日期：<?php print_r(date("Y\/m\/d H:i:s",strtotime($row[3]))); ?></div>
                        <div class="col-sm-4">訂單狀態：<?php
                          if ($row[8]){
                            print_r("<font color=green>己完成交易</font>");
                          } else {
                            print_r("<font color=red>資料審查中</font>");
                          }
                         ?>
                        </div>
                        <table class="table">
                          <thead>
                            <tr class="success">
                              <th>#</th>
                              <th>商品名稱</th>
                              <th>商品說明</th>
                              <th>單價/每月</th>
                              <th>每個空間/GB</th>
                              <th>購買數量</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $stmt1->bindValue(':order_id',$order_id,PDO::PARAM_STR);
                            $stmt1->execute();
                            $noid = 0;
                            while ($row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                              $noid++;
                           ?>
                            <tr>
                              <td><?php print_r($noid); ?></td>
                              <td><?php print_r($proc_name1[trim($row1[3])][0]); ?></td>
                              <td><?php print_r($proc_name1[trim($row1[3])][1]); ?></td>
                              <td><?php print_r("NT$ ".$row1[4]." 元"); ?></td>
                              <td><?php print_r(intval($row1[5])/(1024*1024*1024)." GB"); ?></td>
                              <td><?php print_r($row1[8]." 個"); ?></td>
                            </tr>

                          <?php
                            }
                          ?>
                          <tr>
                            <th scope="row" colspan=3>總計</th>
                            <td><font color="red"><?php print_r("NT$ ".intval($row[4])." 元"); ?></font></td>
                            <td><font color="blue"><?php print_r(intval($row[5])/(1024*1024*1024)." GB"); ?></font></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row" colspan=6>發票號碼：
                            <?php

                            if ($row[11]==""){
                              print_r("<font color=red>尚未開立</font>\t");
                            } else {
                              print_r($row[11]."\t");
                            }
                            print_r("\t"."\t");
                            if (trim($row[10])=="2key"){
                              print("二聯式發票\t");
                            } else {
                               print("三聯式發票\t");
                            }
                             ?>
                            </th>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
      <?php
            }
        }
       ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="expired">
      <br>
      施工中，請稍候...
    </div>
  </div>

  <br>

</div>
<?php
function proc_name(){
  $root_path = $_SERVER['DOCUMENT_ROOT'];
  require_once ($root_path."/lib/conf1.php");
  $sqlstring2="SELECT * FROM items";
  $stmt2=$db_connect1->query($sqlstring2);
  $noid = 0;
  while ($row = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
    $noid = $noid + 1;
    $proc_name[trim($row[2])]=array(trim($row[1]),trim($row[3]),trim($row[5]));
  }
  $_SESSION['productions']=$proc_name;
}
?>
