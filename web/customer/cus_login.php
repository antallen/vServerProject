<?php
session_start();

if (isset($_SESSION['username'])){
  exit(header("Location:cus_admin.php"));
}
?>
<!DOCTYPE html>
<html>
<?php
  include ("template/head.php");
?>
  <body>
    <!-- 網頁最上一行 -->
    <?php
      include ("../template/header.php");
    ?>
    <!-- 會員登入表單 -->
    <br>
     <section id="contact" class="container">
       <div class="row">
         <div class="col-sm-offset-2 col-sm-8">
            <form class="form-horizontal" action="login.php" method="post">
              <h4>會員登入</h4>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="signin-name">會員帳號</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" id="signin-name" placeholder="請輸入會員帳號專用 E-mail" name="idname">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="signin-password">會員密碼</label>
                <div class="col-sm-10">
                  <input class="form-control" type="password" id="signin-password" placeholder="請輸入會員專用密碼" name="passwd">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="reCaptcha">非機器人辯視</label>
                <div class="col-sm-10 g-recaptcha" data-sitekey="6LdRmysUAAAAAJqclaPkJJ-D9HTGAjU3EaQylkZ7"></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="signin-password"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="login">登入</button>
                </div>
              </div>

            </form>
         </div>
       </div>
     </section>
     <?php
        include ("template/scripts.php");
      ?>
  </body>
</html>
