<?php
session_start();
require_once ("../lib/system.php");

//檢查是否己有 username 了！有，表示己經登入，不給再註冊，輸至登入頁！
if (isset($_SESSION['username'])){
  exit(header("Location:cus_admin.php"));
  //header("HTTP/1.1 301 Moved Permanently");
  //header("Location:$site_url/customer/cus_admin.php");
}

//檢查是否己有註冊步驟！如果有，設定步驟值，如果沒有，給定步驟1的值！
if (isset($_SESSION['register'])){
  $step = $_SESSION['register'];
} else {
  $_SESSION['register'] = "step1";
  $step = $_SESSION['register'];
}

//開啟錯誤訊息功能，正式上線時，須註解！
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<?php
      require_once ("template/head.php");
?>
  <body>
    <!-- 網頁最上一行 -->
    <?php
      require_once ("../template/header.php");
    ?>
    <!-- 免費註冊表單 -->
    <br>
     <section id="contact" class="container">
       <div class="row">
         <div class="col-sm-offset-2 col-sm-8">
	    　　　　 <?php
               //導入步驟值，進入正確的步驟頁面！
                switch ($step) {
                  case 'step1':
                        include ("register/step1.php");
                    break;
                    case 'step2':
                          $_SESSION['register'] = "step1";
                          include ("register/step2.php");
                    break;
                    case 'step3':
                          $_SESSION['register'] = "step2";
                          include ("register/step3.php");
                    break;
                }
             ?>
         </div>
       </div>
     </section>
     <?php
        include ("template/scripts.php");
      ?>
  </body>
</html>
