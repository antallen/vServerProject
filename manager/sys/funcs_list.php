<!-- 系統功能等級管理列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';
if (intval($men_level) >= intval(trim($funcs["SYSlevels03"]))){

  $sqlstring="SELECT * FROM funs ORDER BY level DESC LIMIT :max OFFSET :min";
  $stmt=$db_connect->prepare($sqlstring);
  if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
    $min=trim($_SESSION['page'])*5-1;
  } else {
    $min=0;
  }
  $max=$min+5;

  $stmt->bindValue(':min',$min,PDO::PARAM_INT);
  $stmt->bindValue(':max',$max,PDO::PARAM_INT);

  $sqlstring1="SELECT menu_id FROM menus ORDER BY level;";
  $stmt1=$db_connect->query($sqlstring1);

  $sqlstring2="SELECT level FROM levels ORDER BY level;";
  $stmt2=$db_connect->query($sqlstring2);
?>
<h4>系統功能等級表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./funcs_del.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>功能編號</th>
        <th>功能名稱</th>
        <th>功能類別</th>
        <th>功能等級</th>
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
      <td><a href="#" id="funcb<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./funcs_update.php?pk=<?php print_r(trim($row[0])); ?>" data-title="功能名稱修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
      </td>
      <td><a href="#" id="funcc<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./funcs_update.php?ck=<?php print_r(trim($row[0])); ?>" data-title="功能類別修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a>
      </td>
      <td><a href="#" id="account<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./funcs_update.php?lk=<?php print_r(trim($row[0])); ?>" data-title="功能等級修改" data-value="<?php print_r(trim($row[4])); ?>"><?php print_r(trim($row[4])); ?></a>
      </td>
      <td><a href="#" id="accpasswd<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./funcs_update.php?fk=<?php print_r(trim($row[0])); ?>" data-title="註解說明修改" data-value="<?php print_r(trim($row[5])); ?>"><?php print_r(trim($row[5])); ?></a>
      </td>
      <td>
        <button type="submit" name="deletes" class="btn btn-danger btn-xs active" value="<?php print_r(trim($row[0])); ?>"
          <?php
           if (intval(trim($row[1])) >= 250){
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
<form class="form-horizontal" action="funcs_create.php" method="post">
<h4>新增系統功能權限值</h4>
 <div class="form-group">
    <label class="col-sm-2 control-label" for="funs-id">設定系統功能編號</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="funs-id" placeholder="請輸入系統功能編號" name="funs_id" required>
    </div>
  </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="funs-name">設定系統功能名稱</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="funs-name" placeholder="請輸入等級名稱" name="funs_name" required>
     </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label" for="class-id">設定系統種類編號</label>
      <div class="col-sm-3">
        <select class="form-control" id="class-id" name="class_id" placeholder="請選擇系統編號" required>
          <?php
            while ($row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
          ?>
          <option>
            <?php
              print_r(trim($row1[0]));
           ?>
         </option>
          <?php
            }
           ?>
        </select>
      </div>
    </div>
    <div class="form-group">
       <label class="col-sm-2 control-label" for="funs-level">設定系統功能等級</label>
       <div class="col-sm-3">
         <select class="form-control" id="funs-level" placeholder="請選擇系統等級編號" name="funs_level" required>
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
     <label class="col-sm-2 control-label" for="funs-comments">系統功能使用說明</label>
     <div class="col-sm-9">
       <input class="form-control" type="textarea" id="funs-comments" placeholder="請輸入功能用途、權限種類以及等級等說明" name="comms" required>
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
  ?>
         <script type="text/javascript">
             <!--
                function Redirect() {
                   window.location="http://manager.vserver.tw/sys/index.php?item=users#administrator";
                }

                document.write("單項商品新增失敗！10秒後，將自動跳轉");
                setTimeout('Redirect()', 1);
             -->
          </script>
    <?php
}
?>
</div>
