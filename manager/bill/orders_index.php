<?php
//網頁基本防護
require_once '../lib/protected.php';

//帶入資料庫連結
require_once '../lib/conf1.php';
$sqlstring1="SELECT * FROM orders WHERE pays is false;";
$stmt1=$db_connect1->query($sqlstring1);
//var_dump($stmt1);

?>
<h4>尚未對帳訂單</h4>
<hr style="margin-top: 5px; margin-bottom:5px;">
<br>
<?php
while ($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
?>
<div class="container col-sm-12">
  <div class="well">客戶名稱的地方
  訂單日期的地方
    <div class="table-responsive">
      <form action="" method="post">
      <table class="table">
        <thead>
          <tr class="success">
            <th>#</th>
            <th>訂單ID</th>
            <th>客戶名稱</th>
            <th>訂購時間</th>
            <th>訂購金額</th>
            <th>狀態</th>
            <th>Actives</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </form>
    </div>
  </div>
</div>
<?php
}
 ?>
