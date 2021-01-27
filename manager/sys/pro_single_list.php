<!-- 單項商品功能列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';
$sqlstring="SELECT * FROM items LIMIT :max OFFSET :min";
//print_r($sqlstring);
$stmt=$db_connect->prepare($sqlstring);

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
  <form action="./pro_single_forz.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>商品名稱</th>
        <th>商品代號</th>
        <th>商品說明</th>
        <th>使用空間</th>
        <th>商品價格</th>
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
       <td><a href="#" id="passwd<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_single_update.php?lk=<?php print_r(trim($row[0])); ?>&lk1=<?php print_r($oldid); ?>" data-title="單項名稱修改" data-value="<?php print_r(trim($row[1])); ?>"><?php print_r(trim($row[1])); ?></a></td>
       <td><a href="#" id="level<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_single_update.php?pk=<?php print_r(trim($row[0])); ?>&pk1=<?php print_r($oldid); ?>" data-title="單項代號修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a></td>
       <td><a href="#" id="login<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./pro_single_update.php?ck=<?php print_r(trim($row[0])); ?>&ck1=<?php print_r($oldid); ?>" data-title="使用說明修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a></td>
       <td><a href="#" id="com<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_single_update.php?gk=<?php print_r(trim($row[0])); ?>&gk1=<?php print_r($oldid); ?>" data-title="使用空間修改－單位：GB" data-value="<?php print_r(trim($row[5])/(1024*1024*1024)); ?>"><?php print_r(trim($row[5])/(1024*1024*1024)."G"); ?></a></td>
       <td><a href="#" id="email<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./pro_single_update.php?fk=<?php print_r(trim($row[0])); ?>&fk1=<?php print_r($oldid); ?>" data-title="商品價格修改" data-value="<?php print_r(trim($row[6])); ?>"><?php print_r(trim($row[6])); ?></a> /每月</td>

       <td><?php
            if ($row[4]){
              print_r("<font color=blue>上線中</font>");
            } else {
              print_r("<font color=red>下線中</font>");
            }
                ?>
       </td>
       <td>
         <?php
           if ($row[4]){
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

<p>PS：下線前，請再次確認！
  <hr>
  <form class="form-horizontal" action="pro_single_create.php" method="post">
  <h4>新增單項產品</h4>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-name">新增商品名稱</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="signin-name" placeholder="請輸入單項商品名稱" name="proname" required>
    </div>
  </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">新增商品代號</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="signin-name" placeholder="請輸入單項商品代號" name="proid" required>
     </div>
   </div>
    <div class="form-group">
       <label class="col-sm-2 control-label" for="signin-name">商品說明</label>
       <div class="col-sm-9">
         <input class="form-control" type="textarea" id="signin-name" placeholder="請輸入商品用途...等說明" name="comm" required>
       </div>
     </div>
     <div class="form-group">
        <label class="col-sm-2 control-label" for="signin-name">使用空間</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="signin-name" placeholder="請輸入商品使用空間，只要輸入數字即可！單位為：GB" name="spaces" required>
        </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-name">基本價格</label>
         <div class="col-sm-9">
           <input class="form-control" type="text" id="signin-name" placeholder="請輸入商品基本價格，只要輸入數字即可！單位為：新台幣/每個月" name="prize" required>
         </div>
       </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-password"></label>
    <div class="col-sm-9">
        <button type="submit" class="btn btn-primary" name="login">送出</button>
    </div>
  </div>

  </form>
