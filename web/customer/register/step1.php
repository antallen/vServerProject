<?php
//判斷是否有註冊值，如果沒有，表示沒依正常網頁操作方式進入網頁！
  if (!isset($_SESSION['register'])){
?>
     <script type="text/javascript">
         <!--
            function Redirect() {
               window.location="http://test.vserver.tw/home.php";
            }

            document.write("You will be redirected to main page in 10 sec.");
            setTimeout('Redirect()', 100);
         -->
      </script>

<?php
  } else {
?>
<form class="form-horizontal" action="register/checkmail.php" method="post" role="form"  data-toggle="validator">
  <h4>免費註冊成為會員</h4>
  <div id="wizard">
      <a class="current"><span class="badge">1</span> 建立帳號</a>
      <a><span class="badge">2</span> 填入基本資料</a>
      <a><span class="badge badge-inverse">3</span> 確認送出</a>
  </div>
  <hr>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-name">註冊帳號</label>
    <div class="col-sm-10">
      <input class="form-control" type="email" id="signin-name" placeholder="請輸入想要註冊的 E-mail" name="regemail" data-error="郵件信箱格式錯誤！" required>
      <?php
           if (isset($_SESSION['email_id']) && (!isset($_SESSION['lock']))){
             $emailid = $_SESSION['email_id'];
      ?>
      <div class="help-block with-errors"><font color="red"><?php echo $emailid." 該帳號不可註冊！"; ?></font></div>
      <?php
         } else {
      ?>
      <div class="help-block with-errors"></div>
      <?php
         }
      ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="signin-password">設定密碼</label>
    <div class="col-sm-10">
      <input class="form-control" type="password" id="signin-password" data-maxlength="25" data-minlength="3" placeholder="請設定密碼，字數3~25個，必須含英文字母、數字！" name="passwd1" required>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="repassword">確認密碼</label>
    <div class="col-sm-10">
      <input class="form-control" type="password" id="repassword" data-match="#inputPassword"
               data-match-error="兩次輸入的密碼不同！" placeholder="確認密碼是否相同！"  name="passwd2" required>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="submit"></label>
    <div class="col-sm-10">
        <button type="submit" class="btn btn-warning" name="step1" disabled>下一步</button>
        <input type="hidden" name="step" value="step1">
    </div>
  </div>
</form>
<?php
}
?>
