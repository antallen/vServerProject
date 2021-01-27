<!-- 功能等級管理列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';
if (intval($men_level) >= intval(trim($funcs["SYSlevels01"]))){

  $sqlstring="SELECT * FROM levels ORDER BY level DESC LIMIT :max OFFSET :min";
  $stmt=$db_connect->prepare($sqlstring);
  if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
    $min=trim($_SESSION['page'])*5-1;
  } else {
    $min=0;
  }
  $max=$min+5;

  $stmt->bindValue(':min',$min,PDO::PARAM_INT);
  $stmt->bindValue(':max',$max,PDO::PARAM_INT);
?>
<h4>管理人員權限等級表</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<div class="table-responsive">
  <form action="./levels_del.php" method="post">
  <table class="table">
    <thead>
      <tr class="success">
        <th>#</th>
        <th>等級號碼</th>
        <th>等級名稱</th>
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
      <td><a href="#" id="prod<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./levels_update.php?gk=<?php print_r(trim($row[0])); ?>" data-title="等級號碼修改" data-value="<?php print_r(trim($row[1])); ?>"><?php print_r(trim($row[1])); ?></a>
      </td>
      <td><a href="#" id="proc<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./levels_update.php?pk=<?php print_r(trim($row[0])); ?>" data-title="等級名稱修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
      </td>
      <td><a href="#" id="proo<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./levels_update.php?ck=<?php print_r(trim($row[0])); ?>" data-title="註解說明修改" data-value="<?php print_r(trim($row[3])); ?>"><?php print_r(trim($row[3])); ?></a>
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
<form class="form-horizontal" action="levels_create.php" method="post">
<h4>新增管理權限值</h4>
 <div class="form-group">
    <label class="col-sm-2 control-label" for="funcs-level">設定等級號碼</label>
    <div class="col-sm-9">
      <input class="form-control" type="text" id="funcs-level" placeholder="請輸入0～250等級編號" name="level" required>
    </div>
  </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="funs-name">設定等級名稱</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="funs-name" placeholder="請輸入等級名稱" name="name" required>
     </div>
   </div>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="funcs-comments">使用人員說明</label>
     <div class="col-sm-9">
       <input class="form-control" type="textarea" id="funs-comments" placeholder="請輸入權限用途、使用對象等說明" name="comm" required>
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
