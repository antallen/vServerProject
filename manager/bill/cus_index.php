<!-- 客戶清單列表 -->
<div class="adcount">
  <ul id="home-tabs" class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#news" data-toggle="tab">客戶清單列表</a></li>
                <li role="presentation"><a href="#cus" data-toggle="tab">客戶管理帳號列表</a></li>
                <li role="presentation"><a href="#web" data-toggle="tab">管理號碼列表</a></li>

  </ul>
  <div class="tab-content">
    <!--第一個標籤內容 -->
        <div role="tabpanel" class="tab-pane active" id="news">
            <br/>
            <?php include ("./cus_list.php"); ?>
        </div>
        <!--第二個標籤內容 -->

        <div role="tabpanel" class="tab-pane" id="cus">
          <br/>
          <?php include ("./cus_acc_list.php"); ?>
        </div>
        <!--第三個標籤內容 -->
        <div role="tabpanel" class="tab-pane" id="web">
          <br/>
          <?php include ("./cus_admin_list.php"); ?>
        </div>
    </div>

</div>
</div>
