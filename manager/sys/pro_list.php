<!-- 商品功能列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring="SELECT * FROM productions LIMIT :max OFFSET :min";
//print_r($sqlstring);
$stmt=$db_connect1->prepare($sqlstring);

if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
  $min=trim($_SESSION['page'])*50-1;
} else {
  $min=0;
}
$max=$min+50;

$stmt->bindValue(':min',$min,PDO::PARAM_INT);
$stmt->bindValue(':max',$max,PDO::PARAM_INT);

?>
<h4>單項商品列表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./pro_forz.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>商品名稱</th>
        <th>商品代號</th>
        <th>產品價格</th>
        <th>使用空間</th>
        <th>商品說明</th>
        <th>狀態</th>
        <th>Actives</th>
      </tr>
    </thead>
    <tbody>
   <?php
   try {

      $stmt->execute();
      $no = 0;
      while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $no = $no + 1;
   ?>
   <tr>
       <td><?php print_r($no); ?></td>
       <?php $oldid = trim($row[2]); ?>
       <td><a href="#" id="account<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_update.php?lk=<?php print_r(trim($row[0])); ?>&lk1=<?php print_r($oldid); ?>" data-title="單項名稱修改" data-value="<?php print_r(trim($row[1])); ?>"><?php print_r(trim($row[1])); ?></a></td>
       <td><a href="#" id="accpasswd<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_update.php?pk=<?php print_r(trim($row[0])); ?>&pk1=<?php print_r($oldid); ?>" data-title="單項代號修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a></td>
       <td><a href="#" id="prod<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_update.php?ck=<?php print_r(trim($row[0])); ?>&ck1=<?php print_r($oldid); ?>" data-title="商品價格修改－－只能填數字！" data-value="<?php print_r(trim($row[5])); ?>"><?php print_r(trim($row[5])); ?></a></td>
       <td><a href="#" id="proc<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_update.php?ak=<?php print_r(trim($row[0])); ?>&ak1=<?php print_r($oldid); ?>" data-title="使用空間修改－－只能填數字！單位：GB" data-value="<?php print_r(intval(trim($row[6]))/(1024*1024*1024)); ?>"><?php print_r(intval(trim($row[6]))/(1024*1024*1024)); ?></a> GB</td>
       <td><a href="#" id="proo<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./pro_update.php?bk=<?php print_r(trim($row[0])); ?>&bk1=<?php print_r($oldid); ?>" data-title="使用說明修改" data-value="<?php print_r(trim($row[7])); ?>"><?php print_r(substr(trim($row[7]),0,12)."..."); ?></a></td>
       <td><?php
            if ($row[8]){
              print_r("<font color=blue>上線中</font>");
            } else {
              print_r("<font color=red>下線中</font>");
            }
                ?>
       </td>
       <td>
         <?php
           if ($row[8]){
             ?>
             <button type="submit" name="forezen" class="btn btn-xs btn-danger active" value="<?php print_r(trim($row[0])); ?>">下線</button>
             <?php
           } else {
             ?>
             <button type="submit" name="forezen" class="btn btn-xs btn-primary active" value="<?php print_r(trim($row[0])); ?>">上線</button>
             <?php
           }
         ?>
       </td>
   </tr>
   <?php
      }
      $stmt = null;
    }
    catch (PDOException $e) {
        print $e->getMessage();
        echo "資料庫失效！";
    }
     ?>     　　　　　　
    </tbody>
  </table>
</form>
  </div>

<p>PS：下線前，請再次確認！下線後，前台將看不到此項商品！
  <?php

    //帶入另一個資料庫
    require_once '../lib/conf.php';
    $sqlstring1="SELECT * FROM items WHERE actives is TRUE";
    $stmt1= $db_connect->query($sqlstring1);
    $no1 = 0;
   ?>
  <hr>
  <form class="form-horizontal" action="./pro_create.php" method="post">
  <h4>新增單項產品</h4>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-name">新增商品名稱</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="signin-name" placeholder="請輸入單項商品名稱" name="proname" required>
    </div>
  </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">設定商品代號/數量</label>
     <div class="col-sm-9">
       <?php
        while ($row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
         $no1 = $no1 + 1;
        ?>
       <div class="form-check">
         <label class="form-check-label col-sm-4">
           <input class="form-check-input" type="checkbox" name="ck[]" id="inlineCheckbox<?php print_r($no1); ?>" value="<?php print_r(trim($row1['2'])); ?>">
            <?php
            print_r(trim($row1[1])." / 數量 \t");
            ?>
            <input class="form-control" type="text" width="5" id="signin-name" placeholder="請輸入需要的個數" name="<?php print_r(trim($row1['2'])); ?>">
         </label>
      </div>
      <?php
      }
       ?>
     </div>
   </div>
    <div class="form-group">
       <label class="col-sm-2 control-label" for="signin-name">商品說明</label>
       <div class="col-sm-9">
         <input class="form-control" type="textarea" id="signin-name" placeholder="請輸入商品用途...等說明" name="comm" required>
       </div>
     </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-password"></label>
    <div class="col-sm-9">
        <button type="submit" class="btn btn-primary" name="login">送出</button>
    </div>
  </div>

  </form>
