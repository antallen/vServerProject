<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring="SELECT * FROM mem_account LEFT JOIN mem_detail USING (admin_id) ORDER BY admin_id LIMIT :max OFFSET :min";
$stmt=$db_connect1->prepare($sqlstring);

if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
  $min=trim($_SESSION['page'])*10-1;
} else {
  $min=0;
}
$max=$min+10;

$stmt->bindValue(':min',$min,PDO::PARAM_INT);
$stmt->bindValue(':max',$max,PDO::PARAM_INT);

?>
<h4>客戶管理帳號列表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./acc_forz.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>管理ID</th>
        <th>客戶名稱</th>
        <th>客戶管理帳號</th>
        <th>客戶管理密碼</th>
        <th>帳號目前狀態</th>
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
       <td><?php print_r(trim($row[0])); ?></td>
       <td><?php print_r(trim($row[7])); ?></td>
       <?php
            $oldid = trim($row[2]);
            $oldpasswd = trim($row[3]);
       ?>
       <td><a href="#" id="account<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./acc_update.php?lk=<?php print_r(trim($row[0])); ?>&lk1=<?php print_r($oldid); ?>" data-title="客戶管理帳號修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
       </td>
       <td><a href="#" id="accpasswd<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./acc_update.php?ck=<?php print_r(trim($row[0])); ?>&ck1=<?php print_r($oldpasswd); ?>" data-title="客戶管理密碼修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a>
       </td>
       <td><?php
           if ($row[5]){
             print_r("啟用中");
           } else {
             print_r("停用中");
           }
            ?>
       </td>
       <td><button type="submit" name="forezen" class="btn
         <?php
           if (trim($row[5])){
             print_r("btn-danger");
           } else {
             print_r("btn-primary");
           }
         ?>
          btn-xs active" value="<?php print_r(trim($row[2])); ?>">
         <?php
           if (trim($row[5])){
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
<p>PS：新增管理帳號，請客戶自行由前台操作！
