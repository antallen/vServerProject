<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php
 include ("template/head.php");
?>
<body>
  <!-- 網頁最上一行 -->
<?php
  include ("template/header.php");
?>
    <!-- 網頁上半部 -->
    <section id="input-group">
      <div class="container">
          <div class="jumbotron">
              <h1>vServer is Everything !!</h1>
              <p>Welcome to our small web hosting site !</p>
          </div>

            <ul id="home-tabs" class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#news" data-toggle="tab">最新消息(News)</a>
              </li>
              <li role="presentation"><a href="#web" data-toggle="tab">網站空間(Web Site)</a></li>
              <li role="presentation"><a href="#dns" data-toggle="tab">DNS 代管(DNS)</a></li>
              <li role="presentation"><a href="#email" data-toggle="tab">企業信箱(E-mail)</a></li>
              <li role="presentation"><a href="#files" data-toggle="tab">雲端空間(Files)</a></li>
              <li role="presentation"><a href="#VPN" data-toggle="tab">私人網路線路(VPN)</a></li>
            </ul>
            <!-- 頁櫼內容 -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="news">
                  <br/>
                  <?php
                    include("lib/news.php");
                  ?>
              </div>
              <div role="tabpanel" class="tab-pane" id="web">
                  二頁內容
              </div>
              <div role="tabpanel" class="tab-pane" id="dns">
                  三頁內容
              </div>
              <div role="tabpanel" class="tab-pane" id="email">
                  四頁內容
              </div>
              <div role="tabpanel" class="tab-pane" id="files">
                  五頁內容
              </div>
              <div role="tabpanel" class="tab-pane" id="VPN">
                  六頁內容
              </div>
            </div>
        </div>
    </section>
    <?php
      include ("template/scripts.php");
      include ("template/footer.php");
    ?>
</body>

</html>
