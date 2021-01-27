<!-- 系統管理功能列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';

//系統功能代號
$sysclass='SYS';

//使用人員等級
$men_level=$_SESSION['level'];

//帶入資料庫連結
require_once '../lib/conf.php';

$sqlstring="SELECT funs_id,level FROM funs WHERE menu_id = :menuid ;";
$stmt=$db_connect->prepare($sqlstring);
$stmt->bindParam(':menuid',$sysclass,PDO::PARAM_STR);
$stmt->execute();
//var_dump($stmt);
//var_dump($_SESSION['level']);
while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
  $funcs[trim($row[0])]=trim($row[1]);
}
$_SESSION['funcs_level']=$funcs;
//var_dump($funcs);

?>
<div class="adcount">
  <ul id="home-tabs" class="nav nav-tabs">
      <?php
         if (intval(trim($funcs["SYSlevels02"])) <= intval($men_level)){
      ?>
         <li role="presentation" class="active"><a href="#administrator" data-toggle="tab">管理人員帳號</a></li>
      <?php
        }
         if (intval(trim($funcs["SYSlevels01"])) <= intval($men_level)){
      ?>
          <li role="presentation"><a href="#levels" data-toggle="tab">管理人員權限等級</a></li>

      <?php
        }
        if (intval(trim($funcs["SYSlevels03"])) <= intval($men_level)){
      ?>
      <li role="presentation"><a href="#funcs" data-toggle="tab">管理系統功能等級</a></li>
      <?php
        }
        if (intval(trim($funcs["SYSlevels04"])) <= intval($men_level)){
      ?>
        <li role="presentation"><a href="#classes" data-toggle="tab">管理系統類別等級</a></li>
      <?php
        }
      ?>
  </ul>
  <div class="tab-content">
    <!--第一個標籤內容 -->
        <div role="tabpanel" class="tab-pane active" id="administrator">
            <br/>
            <?php include ("./users_index.php"); ?>
        </div>
        <!--第二個標籤內容 -->

        <div role="tabpanel" class="tab-pane" id="levels">
          <br/>
          <?php include ("./levels_list.php"); ?>
        </div>
        <!--第三個標籤內容 -->

        <div role="tabpanel" class="tab-pane" id="funcs">
          <br/>
          <?php include ("./funcs_list.php"); ?>
        </div>
        <!--第四個標籤內容 -->

        <div role="tabpanel" class="tab-pane" id="classes">
          <br/>
          <?php include ("./classes_list.php"); ?>
        </div>
    </div>

</div>
