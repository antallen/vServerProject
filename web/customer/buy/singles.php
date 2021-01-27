<?php
function call_header(){
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
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

require_once ($root_path."/lib/conf1.php");
$sqlstring1="SELECT * FROM items";
$stmt1=$db_connect1->query($sqlstring1);

 ?>
<div class="adcount">
  <h3>單項商品採購</h3>
  <div id="wizard">
  <?php
    if (!isset($_SESSION['step'])||(trim($_SESSION['step'])=="step1")){
      //第一步驟
  ?>

      <a class="current"><span class="badge">1</span> 勾選商品</a>
      <a><span class="badge">2</span> 確認訂單</a>
      <a><span class="badge badge-inverse">3</span> 完成採購</a>

  </div>
        <br>
        <hr style="margin-top: 5px; margin-bottom:5px;">
        <div class="table-responsive">
          <h4>可新購/續約單項商品列表</h4>
          <form action="buy/process1.php" method="post">
          <table class="table">
            <thead>
              <tr class="success">
                <th>#</th>
                <th>商品名稱</th>
                <th>商品說明</th>
                <th>商品價格</th>
                <th>使用空間</th>
                <th>購買數量</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $noid = 0;
                while ($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

              ?>
              <tr>
              <td>
                    <input type="checkbox" id="blankCheckbox" value="<?php print_r(trim($row[2])."$".$noid."#".trim($row[6])); ?>" aria-label="" name="option[]">
              </td>
              <td><?php print_r(trim($row[1])); ?></td>
              <td><?php print_r(trim($row[3])); ?></td>
              <td><?php print_r("\$NT ".trim($row[6])." /每月"); ?></td>
              <td><?php print_r(intval(trim($row[5]))/(1024*1024*1024)." GB"); ?></td>
              <td><input type="number" min="0" max="100" value="1" name="num[]"></td>
            </tr>
              <?php
                  $noid = $noid + 1;
                  $proc_name[trim($row[2])]=array(trim($row[1]),trim($row[3]),trim($row[5]));
                }
                $_SESSION['productions']=$proc_name;
               ?>
            </tbody>
          </table>
          <hr style="margin-top: 5px; margin-bottom:5px;">
          <div class="form-group">
            <label class="col-sm-10 control-label" for="submit"></label>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-warning" name="step1">下一步</button>
                <input type="hidden" name="step" value="step1">
            </div>
          </div>
        </form>
      </div>

<?php
  } else {

      if (isset($_SESSION['step']) && (trim($_SESSION['step'])=="step2")){
        //第二步驟
?>
      <a><span class="badge">1</span> 勾選商品</a>
      <a class="current"><span class="badge">2</span> 確認訂單</a>
      <a><span class="badge badge-inverse">3</span> 完成採購</a>

    </div>
    <br>
    <hr style="margin-top: 5px; margin-bottom:5px;">
    <div class="table-responsive">
      <h4>您所勾選的商品列表</h4>
      <form action="buy/process2.php" method="post">
      <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">商品名稱</th>
              <th scope="col">商品說明</th>
              <th scope="col">商品代號</th>
              <th scope="col">數量</th>
              <th scope="col">空間/GB</th>
              <th scope="col">單價/每月</th>
              <th scope="col">總價/每年</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $noid = 0;
              $total_orders = 0;
              $order_numbers = count($_SESSION['order']);
              $proc_name=$_SESSION['productions'];
              $proc_order=$_SESSION['order'];
              $prod_space = 0;
              $prod_total_space = 0;
              //var_dump($proc_name);
              //print_r($_SESSION['order'][0][0]);
              //$proc_name[trim($_SESSION['order'][$noid][0])];
              for ($noid=0;$noid < $order_numbers;$noid++){
            ?>
            <tr>
              <th scope="row"><?php echo ($noid+1); ?></th>
              <td><?php print_r($proc_name[$proc_order[$noid][0]][0]); ?></td>
              <td><?php print_r($proc_name[$proc_order[$noid][0]][1]); ?></td>
              <td><?php print_r($proc_order[$noid][0]); ?></td>
              <td><?php print_r($proc_order[$noid][1]); ?></td>
              <td><?php
                    $prod_space=($proc_name[$proc_order[$noid][0]][2]);
                    print_r(intval($prod_space)/(1024*1024*1024));
                    $prod_total_space=$prod_total_space + $prod_space;
                  ?>
              </td>
              <td><?php print_r($proc_order[$noid][2]); ?></td>
              <td><font color="green"><?php print_r($proc_order[$noid][3]); ?> （優惠兩個月！）</font></td>
            </tr>
            <?php
            $total_orders = $total_orders+intval($proc_order[$noid][3]);
            $bill_array[$noid]=array($proc_name[$proc_order[$noid][0]][0],$proc_name[$proc_order[$noid][0]][1],$proc_order[$noid][0],$proc_order[$noid][1],$prod_space,$proc_order[$noid][2],$proc_order[$noid][3]);
            }
            if (!isset($bill_array)){
                $_SESSION['step']="step1";
                call_header();
            }else{
              $_SESSION['bill']=$bill_array;
              $_SESSION['total_pay']=$total_orders;
              $_SESSION['total_spaces']=$prod_total_space;
            }
             ?>
             <tr>
               <th scope="row" colspan=5>總計</th>
               <td><font color="blue"><?php print_r(intval($prod_total_space)/(1024*1024*1024)); ?></font></td>
               <td></td>
               <td><font color="red"><?php print_r($total_orders); ?></font></td>
             </tr>
          </tbody>
      </table>
      <div class="form-group">
        <h4>請選擇付款方式</h4>
        <hr style="margin-top: 5px; margin-bottom:5px;">
        <div class="radio">
          <label>
            <input type="radio" value="ATM" name="payname">
            ATM 轉帳付款！
          </label>
        </div>
        <div class="radio" disabled>
          <label>
            <input type="radio" value="Credit" name="payname" disabled="">
            線上信用卡！
          </label>
        </div>
      </div>
      <br>
      <div class="form-group">
        <h4>請選擇發票資訊</h4>
        <hr style="margin-top: 5px; margin-bottom:5px;">
        <div class="radio">
          <label>
            <input type="radio" value="2key" name="taxes">
            二聯式發票！
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" value="3key" name="taxes">
            三聯式發票！
          </label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-9 control-label" for="submit"></label>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" name="up">重新選購</button>
            <button type="submit" class="btn btn-warning" name="down">確定購買</button>
            <input type="hidden" name="step" value="step2">
        </div>
      </div>
    </form>
  </div>
<?php

  //第二步驟結束
    } else {
      if (isset($_SESSION['step']) && (trim($_SESSION['step'])=="step3")){
      //第三步驟
      ?>
            <a><span class="badge">1</span> 勾選商品</a>
            <a><span class="badge">2</span> 確認訂單</a>
            <a class="current"><span class="badge badge-inverse">3</span> 完成採購</a>

          </div>
          <br>
          <hr style="margin-top: 5px; margin-bottom:5px;">
          <div class="table-responsive">
            <h4>您本次所選購的產品</h4>
            <form action="buy/process3.php" method="post">
              <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">商品名稱</th>
                      <th scope="col">商品說明</th>
                      <th scope="col">商品代號</th>
                      <th scope="col">數量</th>
                      <th scope="col">空間/GB</th>
                      <th scope="col">單價/每月</th>
                      <th scope="col">總價/每年</th>
                    </tr>
                  </thead>
                <tbody>
                  <?php
                  $bill_content=$_SESSION['bill'];
                  for($idno = 0;$idno < count($bill_content);$idno++){
                    ?>
                    <tr>
                      <th scope="row"><?php echo ($idno+1); ?></th>
                      <td><?php print_r($bill_content[$idno][0]); ?></td>
                      <td><?php print_r($bill_content[$idno][1]); ?></td>
                      <td><?php print_r($bill_content[$idno][2]); ?></td>
                      <td><?php print_r($bill_content[$idno][3]); ?></td>
                      <td><?php print_r(intval($bill_content[$idno][4])/(1024*1024*1024)); ?></td>
                      <td><?php print_r($bill_content[$idno][5]); ?></td>
                      <td><font color="green"><?php print_r($bill_content[$idno][6]); ?> （優惠兩個月！）</font></td>
                    </tr>
                    <?php
                  }
                  ?>
                  <tr>
                    <th scope="row" colspan=5>總計</th>
                    <td><font color="blue"><?php print_r(intval($_SESSION['total_spaces'])/(1024*1024*1024)); ?></font></td>
                    <td></td>
                    <td><font color="red"><?php print_r($_SESSION['total_pay']); ?></font></td>
                  </tr>
                </tbody>
              </table>
              <?php
                if (isset($_SESSION['payname']) && (trim($_SESSION['payname'])=="ATM")){
              ?>
              <div class="form-group">
                <h4>ATM 匯款資訊</h4>
                <hr style="margin-top: 5px; margin-bottom:5px;">
                <ul>
                  <li>戶名：宜明資訊有限公司</li>
                  <li>帳號：707-10-509536（第一商業銀行）</li>
                </ul>
              </div>
              <?php
                }
               ?>
              <br>
              <div class="form-group">
                <label class="col-sm-9 control-label" for="submit"></label>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-success" name="goback">查看購買記錄</button>
                    <input type="hidden" name="step" value="step3">
                </div>
              </div>
            </form>
          </div>
      <?php
    } else {
      $_SESSION['step']="step1";

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
    unset($_SESSION['bill']);
    unset($_SESSION['total_pay']);
    unset($_SESSION['order']);
    unset($_SESSION['productions']);
    unset($_SESSION['total_spaces']);
    unset($_SESSION['payname']);
    unset($_SESSION['taxes']);
    $_SESSION['step']="step1";
  }
}
 ?>

</div>
