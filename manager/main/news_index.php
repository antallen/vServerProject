<!-- 最新消息清單列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring="SELECT * FROM news ORDER BY id DESC LIMIT :max OFFSET :min";
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
<div class="adcount">

   <h4>最新消息管理系統</h4>
   <hr style="margin-top: 5px; margin-bottom:5px;">
   <div class="table-responsive">
     <form action="./news_delete.php" method="post">
     <table class="table">
       <thead>
         <tr class="success">
           <th>#</th>
           <th>公告時間</th>
           <th>新聞標題</th>
           <th>內容</th>
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
          <td><a href="#" id="title<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./news_update.php?ck=<?php print_r(trim($row[4])); ?>" data-title="最新消息標頭修改" data-value="<?php print_r(trim($row[5])); ?>"><?php print_r(trim($row[5])); ?></a>
          </td>
          <td><a href="#" id="content<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./news_update.php?pk=<?php print_r(trim($row[4])); ?>" data-title="最新消息內容修改" data-value="<?php print_r(trim($row[1])); ?>"><?php print_r(substr(trim($row[1]),0,30)."..."); ?></a>
          </td>
          <td><button type="submit" name="newsdel" class="btn btn-danger btn-xs active" value="<?php print_r(trim($row[4])); ?>">刪除</button>
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
   <form class="form-horizontal" action="news_create.php" method="post">
   <h4>新增最新消息</h4>
       <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">最新消息標題</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="signin-name" placeholder="請輸入最新消息標頭" name="newstitle" required>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">最新消息內容</label>
     <div class="col-sm-9">
       <textarea class="form-control" rows="5" placeholder="請輸入最新消息內容" name="newscontent" required></textarea>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-password"></label>
     <div class="col-sm-9">
         <button type="submit" class="btn btn-primary" name="login">送出</button>
     </div>
   </div>

 </form>
</div>
</div>
