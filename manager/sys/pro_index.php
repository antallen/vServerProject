<!-- 商品功能列表 -->
<?php
//網頁基本防護
require_once '../lib/protected.php';
?>
<div class="adcount">
  <ul id="home-tabs" class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#productions" data-toggle="tab">商品清單列表</a></li>
                <li role="presentation"><a href="#single" data-toggle="tab">單項商品列表</a></li>

  </ul>
  <div class="tab-content">
    <!--第一個標籤內容 -->
        <div role="tabpanel" class="tab-pane active" id="productions">
            <br/>
            <?php include ("./pro_list.php"); ?>
        </div>
        <!--第二個標籤內容 -->

        <div role="tabpanel" class="tab-pane" id="single">
          <br/>
          <?php include ("./pro_single_list.php"); ?>
        </div>
    </div>

</div>
