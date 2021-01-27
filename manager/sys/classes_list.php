<!-- 系統功能種類管理列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';

if (intval($men_level) >= intval(trim($funcs["SYSlevels04"]))){

  $sqlstring="SELECT * FROM menus ORDER BY level DESC LIMIT :max OFFSET :min";
  $stmt=$db_connect->prepare($sqlstring);
  if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
    $min=trim($_SESSION['page'])*5-1;
  } else {
    $min=0;
  }
  $max=$min+5;

  $stmt->bindValue(':min',$min,PDO::PARAM_INT);
  $stmt->bindValue(':max',$max,PDO::PARAM_INT);

  $sqlstring2="SELECT level FROM levels ORDER BY level;";
  $stmt2=$db_connect->query($sqlstring2);
?>
  <h4>系統類別等級表</h4>
  <hr style="margin-top: 5px; margin-bottom:5px;">
  <div class="table-responsive">
    <form action="./classes_del.php" method="post">
    <table class="table">
      <thead>
        <tr class="success">
          <th>#</th>
          <th>類別編號</th>
          <th>類別名稱</th>
          <th>類別等級</th>
          <th>註解說明</th>
          <th>Actives</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt->execute();
        $no = 0;
        while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
          $no = $no + 1;
        ?>
        <tr>
          <td><?php print_r($no); ?></td>
          <td><?php print_r(trim($row[1])); ?></td>
          <td><a href="#" id="classb<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./classes_update.php?pk=<?php print_r(trim($row[0])); ?>" data-title="類別名稱修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
          </td>
          <td><a href="#" id="classc<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./classes_update.php?ck=<?php print_r(trim($row[0])); ?>" data-title="類別等級修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a>
          </td>
          <td><a href="#" id="classd<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./classes_update.php?lk=<?php print_r(trim($row[0])); ?>" data-title="註解說明修改" data-value="<?php print_r(trim($row[4])); ?>"><?php print_r(trim($row[4])); ?></a>
          </td>
          <td>
          <button type="submit" name="deletes" class="btn btn-danger btn-xs active" value="<?php print_r(trim($row[0])); ?>"
            <?php
             if (intval(trim($row[3])) >= 250){
               print_r("disabled");
             }
            ?>
            >刪除</button></td>
        </tr>
        <?php
      }
       ?>
      </tbody>
    </table>
  </form>
</div>
<hr>
<div class="table-responsive col-sm-12">
<form class="form-horizontal" action="classes_create.php" method="post">
<h4>新增系統類別等級值</h4>
 <div class="form-group">
    <label class="col-sm-2 control-label" for="classes-id">設定類別編號</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="classes-id" placeholder="請輸入類別編號" name="id" required>
    </div>
  </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="classes-name">設定類別名稱</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="classes-name" placeholder="請輸入類別名稱" name="name" required>
     </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label" for="classes-level">設定類別等級</label>
      <div class="col-sm-3">
        <select class="form-control" id="classes-level" placeholder="請輸入等級" name="level" required>
          <?php
            while ($row2 = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
          ?>
          <option>
            <?php
               print_r(trim($row2[0]));
              ?>
          </option>
          <?php
            }
           ?>
        </select>
      </div>
    </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="classes-comments">使用說明</label>
     <div class="col-sm-9">
       <input class="form-control" type="textarea" id="classes-comments" placeholder="請輸入權限用途、使用對象等說明" name="comm" required>
     </div>
   </div>
<div class="form-group">
  <label class="col-sm-2 control-label" for="funcs"></label>
  <div class="col-sm-9">
      <button type="submit" class="btn btn-primary" name="login">送出</button>
  </div>
</div>

</form>

<?php
} else {

}
?>
