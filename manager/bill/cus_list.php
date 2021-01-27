<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring="SELECT * FROM mem_detail NATURAL INNER JOIN mem_admin ORDER BY id LIMIT :max OFFSET :min";
$stmt=$db_connect1->prepare($sqlstring);

if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
  $min=trim($_SESSION['page'])*5-1;
} else {
  $min=0;
}
$max=$min+5;

$stmt->bindValue(':min',$min,PDO::PARAM_INT);
$stmt->bindValue(':max',$max,PDO::PARAM_INT);

?>
<h4>客戶清單列表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./cus_forz.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>管理ID</th>
        <th>客戶名稱</th>
        <th>客戶ID/統編</th>
        <th>客戶電話</th>
        <th>客戶E-mail</th>
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
       <td><?php print_r(trim($row[1])); ?></td>
       <td><a href="#" id="passwd<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./cus_update.php?pk=<?php print_r(trim($row[0])); ?>" data-title="客戶名稱修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
       </td>
       <td><a href="#" id="level<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./cus_update.php?lk=<?php print_r(trim($row[0])); ?>" data-title="客戶ID/統編修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a>
       </td>
       <td><a href="#" id="com<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./cus_update.php?ck=<?php print_r(trim($row[0])); ?>" data-title="客戶電話修改" data-value="<?php print_r(" ".trim($row[4])); ?>"><?php print_r(trim($row[4])); ?></a>
       </td>
       <td><a href="#" id="email<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./cus_update.php?gk=<?php print_r(trim($row[0])); ?>" data-title="客戶Email修改" data-value="<?php print_r(trim($row[5])); ?>"><?php print_r(trim($row[5])); ?></a>
       </td>
       <td><button type="submit" name="forezen" class="btn
         <?php
           if (trim($row[7])){
             print_r("btn-danger");
           } else {
             print_r("btn-primary");
           }
         ?>
          btn-xs active" value="<?php print_r(trim($row[1])); ?>">
         <?php
           if (trim($row[7])){
             print_r("停用");
           } else {
             print_r("啟用");
           }
         ?>
       </button>
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
<hr>
<p>PS：新增客戶，請由前台操作「會員註冊」功能！
