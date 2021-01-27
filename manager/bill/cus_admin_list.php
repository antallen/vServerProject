<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring="SELECT * FROM mem_admin LEFT JOIN mem_detail USING (admin_id) LEFT JOIN mem_account USING (admin_id) ORDER BY mem_admin".'.'."id LIMIT :max OFFSET :min";
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
<h4>管理號碼列表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./cus_admin_delete.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>管理ID</th>
        <th>客戶名稱</th>
        <th>客戶管理帳號</th>
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
       <td><?php print_r(trim($row[0])); ?></td>
       <td><?php print_r(trim($row[5])); ?></td>
       <td><?php print_r(trim($row[10])); ?></td>
       <td><?php
            if ($row[3]){
              print_r("<font color=blue>使用中</font>");
            } else {
              print_r("<font color=red>非用中</font>");
            }
                ?>
       </td>
       <td>
         <?php
           if ((trim($row[5]) == "") and (trim($row[10]) == "")){
             ?>
             <button type="submit" name="forezen" class="btn btn-xs btn-danger active" value="<?php print_r(trim($row[0])); ?>">刪除客戶</button>
             <?php
           } else {
             print_r("保留客戶");
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
<hr>
<p>PS：刪除前，請再次確認！
