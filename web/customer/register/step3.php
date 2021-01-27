<?php
 if (!isset($_SESSION['register'])){
//   ob_start();
//    header("Location:cus_register.php");
//   ob_end_flush();

?>
     <script type="text/javascript">
         <!--
            function Redirect() {
               window.location="http://test.vserver.tw/customer/cus_register.php";
            }

            document.write("You will be redirected to main page in 0.1 sec.");
            setTimeout('Redirect()', 1);
         -->
      </script>

<?php
  } else {
    $_SESSION['lock'] = "on";
  // var_dump($_SESSION['register']);
 ?>
 <form class="form-horizontal" action="register/checksubmit.php" method="post">
   <h4>免費註冊成為會員</h4>
   <div id="wizard">
       <a><span class="badge">1</span> 建立帳號</a>
       <a><span class="badge">2</span> 填入基本資料</a>
       <a class="current"><span class="badge badge-inverse">3</span> 確認送出</a>
   </div>
   <hr>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">會員帳號</label>
     <div class="col-sm-10"><p style="padding-top:5px;">
       <?php
            print_r($_SESSION['email_id']);
        ?>
      </p>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-name">會員名稱</label>
     <div class="col-sm-10"><p style="padding-top:5px;">
       <?php
            print_r($_SESSION['rname']);
        ?>
      </p>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="signin-password">證件號碼</label>
     <div class="col-sm-10"><p style="padding-top:5px;">
       <?php
            print_r($_SESSION['rnumber']);
        ?>
      </p>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="repassword">連絡電話</label>
     <div class="col-sm-10"><p style="padding-top:5px;">
       <?php
            print_r($_SESSION['rphone']);
        ?>
      </p>
     </div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="reCaptcha"></label>
     <div class="col-sm-10 g-recaptcha" data-sitekey="6LdRmysUAAAAAJqclaPkJJ-D9HTGAjU3EaQylkZ7"></div>
   </div>
   <div class="form-group">
     <label class="col-sm-2 control-label" for="submit"></label>
     <div class="col-sm-10">
         <input type ="button" class="btn btn-success" onclick="history.go(-2)" value="上一步"></input>
         <button type="submit" class="btn btn-warning" name="register">確認送出</button>
         <input type="hidden" name="step" value="step3">
     </div>
   </div>
 </form>
 <?php
 }
  ?>
