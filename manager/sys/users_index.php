<!-- 管理人員清單列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf.php';

if (intval($men_level) > intval(trim($funcs["SYSlevels02"]))){
  $sqlstring="SELECT * FROM users ORDER BY id LIMIT :max OFFSET :min";
  $stmt=$db_connect->prepare($sqlstring);
  $non_write=0;
}else {
  $sqlstring="SELECT * FROM users WHERE login = :username ORDER BY id LIMIT :max OFFSET :min";
  $stmt=$db_connect->prepare($sqlstring);
  $stmt->bindParam(':username',trim($_SESSION['username']));
  $non_write=1;
}

if ((isset($_SESSION['page'])) && (trim($_SESSION['page']) > 0 )){
  $min=trim($_SESSION['page'])*5-1;
} else {
  $min=0;
}
$max=$min+5;

$stmt->bindValue(':min',$min,PDO::PARAM_INT);
$stmt->bindValue(':max',$max,PDO::PARAM_INT);

?>

   <h4>管理人員帳號密碼</h4>
   <hr style="margin-top: 5px; margin-bottom:5px;">
   <div class="table-responsive">
     <form action="./users_forz.php" method="post">
     <table class="table">
       <thead>
         <tr class="success">
           <th>#</th>
           <th>登入帳號</th>
           <th>登入密碼</th>
           <th>等級</th>
           <th>使用人員</th>
           <th>凍結</th>
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
          <td><a href="#" id="login<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./users_update.php?gk=<?php print_r(trim($row[0])); ?>" data-title="帳號修改" data-value="<?php print_r(trim($row[1])); ?>"><?php print_r(trim($row[1])); ?></a>
          </td>
          <td><a href="#" id="passwd<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./users_update.php?pk=<?php print_r(trim($row[0])); ?>" data-title="密碼修改" data-value="<?php print_r(trim($row[2])); ?>"><?php print_r(trim($row[2])); ?></a>
          </td>
          <td>
            <?php
              if ($non_write==0){
            ?>
            <a href="#" id="level<?php print_r($no); ?>" data-type="text" data-pk="<?php print_r($no); ?>" data-url="./users_update.php?lk=<?php print_r(trim($row[0])); ?>" data-title="等級修改" data-value="<?php print_r(trim($row[3])); ?>">
            <?php print_r(trim($row[3])); ?>
          </a>
          <?php
        } else{
          print_r(trim($row[3]));
        }
        ?>
          </td>
          <td><a href="#" id="com<?php print_r($no); ?>" data-type="textarea" data-pk="<?php print_r($no); ?>" data-url="./users_update.php?ck=<?php print_r(trim($row[0])); ?>" data-title="使用人員修改" data-value="<?php print_r(trim($row[4])); ?>"><?php print_r(trim($row[4])); ?></a>
          </td>
          <td>
            <?php
                if (trim($row[5])){
                  print_r("非凍結");
                } else {
                  print_r("凍結");
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
             btn-xs active" value="<?php print_r(trim($row[0])); ?>"
            <?php
                if (trim($_SESSION['username']) == trim($row[1])){
                  print_r(" disabled");
                }
            ?>
            >
            <?php
              if (trim($row[5])){
                print_r("凍結");
              } else {
                print_r("解凍");
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
     <?php
     if ($non_write==0){
      ?>
   <hr>
   <form class="form-horizontal" action="users_create.php" method="post">
   <h4>新增管理人員</h4>
  <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">設定登入帳號</label>
     <div class="col-sm-9">
       <input class="form-control" type="text" id="signin-name" placeholder="請輸入帳號名稱" name="loginname1" required>
     </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label" for="signin-passwd">設定登入密碼</label>
      <div class="col-sm-9">
        <input class="form-control" type="password" id="signin-passwd" placeholder="請輸入帳號密碼" name="passwd" required>
      </div>
    </div>
    <div class="form-group">
       <label class="col-sm-2 control-label" for="signin-level">設定等級號碼</label>
       <div class="col-sm-9">
         <input class="form-control" type="text" id="signin-level" placeholder="請輸入0～99等級編號" name="level" required>
       </div>
     </div>
     <div class="form-group">
        <label class="col-sm-2 control-label" for="signin-comments">使用人員說明</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="signin-comments" placeholder="請輸入使用者人名、職稱、用途等說明" name="comm" required>
        </div>
      </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-password"></label>
     <div class="col-sm-9">
         <button type="submit" class="btn btn-primary" name="login">送出</button>
     </div>
   </div>

 </form>
<?php
}
 ?>
