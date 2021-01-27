<?php
//保護機制
$root_path = $_SERVER['DOCUMENT_ROOT'];
include ($root_path."/lib/protected.php");

$admin_id = trim($_SESSION['adminid']);
//print_r($admin_id);

$sqlstring = "SELECT * FROM mem_detail WHERE admin_id = '".$admin_id."';";

$db_query = $db_connect->query($sqlstring);
//var_dump($db_query);
if ($db_query->rowCount() > 0){
  while ($row = $db_query->fetch()) {
    //echo "有找到資料！";
    //var_dump($row);
    $mem_name = $row["mem_name"];
    $mem_id = $row["mem_id"];
    $mem_phone = $row["mem_phone"];
    $mem_email = $row["mem_email"];
  }
} else {
  //echo "無符合的帳密資料！";
  $mem_name = "";
  $mem_id = "";
  $mem_phone = "";
  $mem_email = "";
}
?>
<!-- 基本資維護-->
<div class="basedata">

     <form class="form-horizontal" action="" method="post">
       <h4>基本連絡資訊</h4>
       <hr>
       <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-name">會員名稱</label>
         <div class="col-sm-9">
           <a href="#" id="username" data-type="text" data-placement="right" data-pk="1"
              data-url="detail/check.php" data-title="請輸入名稱"><?php print_r($mem_name); ?></a>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-password">ID No.</label>
         <div class="col-sm-9">
           <a href="#" id="memid" data-type="text" data-placement="right" data-pk="2"
              data-url="detail/check.php" data-title="請輸入統編或身份證字號"><?php print_r($mem_id); ?></a>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-password">Tel. No.</label>
         <div class="col-sm-9">
           <a href="#" id="memtel" data-type="text" data-placement="right" data-pk="3"
              data-url="detail/check.php" data-title="請輸入連絡用電話"><?php print_r($mem_phone); ?></a>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-password">E-mail</label>
         <div class="col-sm-9">
           <a href="#" id="mememail" data-type="text" data-placement="right" data-pk="4"
              data-url="detail/check.php" data-title="請輸入連絡用電話"><?php print_r($mem_email); ?></a>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-2 control-label" for="signin-password"></label>
         <div class="col-sm-9">
             <button type="submit" class="btn btn-primary" name="login">確定修改</button>
         </div>
       </div>

     </form>
</div>
