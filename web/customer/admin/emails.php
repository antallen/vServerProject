<?php
include_once ("../lib/page_protected.php");

require_once("../lib/filters.php");
require_once("../lib/conf.php");

$admin_id = trim($_SESSION['adminid']);
$sqlstring="SELECT * FROM virtual_domains INNER JOIN virtual_users USING (domain_id) WHERE admin_id = :adminid;";
$stmt=$db_connect->prepare($sqlstring);
$stmt->bindValue(':adminid',$admin_id,PDO::PARAM_STR);
$stmt->execute();

?>
<div class="adcount">

    <h3>E-mail 信箱管理</h3>
    <p>E-mail 總數量：5 個 / 使用中數量：2 個 / 未使用數量：3 個</p>
    <hr style="margin-top: 5px; margin-bottom:5px;">
    <div class="table-responsive">
      <h4>己使用信箱組態列表</h4>
      <form action="admin/email_update.php" method="post">
      <table class="table">
        <thead>
          <tr class="success">
            <th>#</th>
            <th>帳號名稱</th>
            <th>密碼</th>
            <th>使用到期日</th>
            <th>信箱空間</th>
            <th>使用狀態</th>
            <th>Actives</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $no = 0;
                while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                  $no = $no + 1;
          ?>
              <tr>
              <td><?php print_r($no); ?></td>
              <td><?php print_r($row[6]); ?></td>

                <?php
                  $today_time=date("Y-m-d H:i:s");
                  $dead_time = date("Y-m-d H:i:s",strtotime(trim($row[11])));
                  if (trim($row[3])){
                    if ($today_time < $dead_time){
                      if (trim($row[10])){
                      ?>
                      <td><a href="#" id="password<?php print_r($no); ?>" data-type="text" data-placement="right" data-pk="1"
                         data-url="admin/quota_update.php" data-title="請輸入新的密碼！" data-value="">**********</a></td>
                      <td><?php print_r($dead_time); ?></td>
                      <td><a href="#" id="quota<?php print_r($no); ?>" data-type="text" data-placement="right" data-pk="2"
                         data-url="admin/quota_update.php" data-title="請輸入空間上限容量！單位：GB" data-value="<?php print_r(trim($row[7])); ?>"><?php print_r(trim($row[7])."G"); ?></a></td>
                      <td><font color="blue">使用中！</font></td>
                      <td><button type="submit" name="forezen" class="btn btn-xs btn-danger active" value="<?php print_r(trim($row[6])); ?>">停用</button></td>
                      <?php
                      } else {
                        ?>
                        <td>**********</td>
                        <td><?php print_r($dead_time); ?></td>
                        <td><?php print_r(trim($row[7])."G")?></td>
                        <td><font color="red">停用中！</font></td>
                        <td>
                          <button type="submit" name="forezen" class="btn btn-xs btn-primary active" value="<?php print_r(trim($row[6])); ?>">啟用</button> /
                          <button type="submit" name="forezen" class="btn btn-xs btn-danger active" value="<?php print_r(trim($row[6])); ?>">刪除</button>
                        </td>
                        <?php
                      }
                    } else {
                      ?>
                      <td>**********</td>
                      <td><?php print_r($dead_time); ?></td>
                      <td><?php print_r(trim($row[7])."G")?></td>
                      <td><font color="brown">己過期！</font></td>
                      <td>
                        <button type="submit" name="forezen" class="btn btn-xs btn-success active" value="<?php print_r(trim($row[6])); ?>">續約</button> /
                        <button type="submit" name="forezen" class="btn btn-xs btn-danger active" value="<?php print_r(trim($row[6])); ?>">刪除</button>
                      </td>
                      <?php
                    }
                  } else {
                ?>
                <td>**********</td>
                <td><?php print_r($dead_time); ?></td>
                  <td rowspan="2">網域停用中！</td>
                <?php
                  }
                 ?>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </form>
      </div>
    <hr>
    <form class="form-horizontal" action="detail/admin_check.php" method="post">
    <h4>新增管理員帳號</h4>
    <?php
    if (isset($_SESSION['msg1'])){
      ?>
      <p><font color="red"><?php print_r(trim($_SESSION['msg1'])); ?></font></p>
      <?php
      unset($_SESSION['msg1']);
    }
    ?>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="signin-name">管理員帳號</label>
      <div class="col-sm-9">
        <input class="form-control" type="text" id="signin-name" placeholder="請輸入會員帳號專用 E-mail" name="idname">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="signin-password">管理員密碼</label>
      <div class="col-sm-9">
        <input class="form-control" type="password" id="signin-password" placeholder="請輸入會員專用密碼" name="passwd">
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
