<?php

$root_path = $_SERVER['DOCUMENT_ROOT'];
require_once($root_path."/lib/filters.php");
require_once($root_path."/lib/conf.php");

//保護機制
include ($root_path."/lib/protected.php");
$admin_id = $_SESSION['adminid'];

$sqlstring="SELECT * FROM mem_account WHERE admin_id ='".trim($admin_id)."';";

$db_query = $db_connect->query($sqlstring);

 ?>
<div class="adcount">

    <h4>系統管理帳密</h4>
    <hr style="margin-top: 5px; margin-bottom:5px;">
    <div class="table-responsive">
      <form action="detail/admin_check.php" method="post">
      <table class="table">
        <thead>
          <tr class="success">
            <th>#</th>
            <th>LoginName</th>
            <th>Password</th>
            <th>CreateDate</th>
            <th>Actives</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $i = 1;

          if ($db_query->rowCount() > 0){
            while ($row = $db_query->fetch()) {
              ?>
              <tr>
              <td><?php print_r($i); ?></td>
              <td><?php print_r($row["login_id"]); ?></td>
              <td>**********</td>
              <td><?php print_r($row["build_date"]); ?></td>
              <td>
                <?php
                  if (trim($_SESSION['username']) == trim($row["login_id"])){
                    ?>
                   <button type="button" class="btn btn-danger btn-xs disabled">刪除</button>
                    <?php
                    //print_r("操作中，不可刪除！");
                  } else {
                ?>
                  <input type="submit" class="btn btn-danger btn-xs active" value="刪除"></input>
                  <input type="hidden" name="delete" value="<?php print_r(trim($row["login_id"])); ?>"></input>
                <?php
                    //print_r("可刪除");
                  }
                 ?>
              </td>
              </tr>
              <?php
              $i = $i + 1;
            }
          } else {
            //echo "無符合的帳密資料！";
            print_r("無任何資料");
          }

          if (isset($_SESSION['msg2'])){
            ?>
            <tr><td colspan="5"><font color="red"><?php print_r(trim($_SESSION['msg2'])); ?></font></tr>
            <?php
            unset($_SESSION['msg2']);
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
