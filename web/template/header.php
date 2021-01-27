<header>
  <div class="container navbar-fixed-top">
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="/home.php">vServer Cloud Service</a>
    <!-- Toggle Button -->
        <button class="navbar-toggle collapsed pull-right" type="button"
           data-toggle="collapse" data-target="#nav-content" aria-expanded="false">
          <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
          <span class="sr-only">切換導覽</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

    <!-- Nav Content -->
      <div class="collapse navbar-collapse pull-right" id="nav-content">
        <ul class="nav navbar-nav">
          <?php
          $root_path = $_SERVER['DOCUMENT_ROOT'];
          include ($root_path."/lib/system.php"); ?>
          <li class="nav-item">
            <?php
              if (isset($_SESSION['username'])){
            ?>
            <a class="nav-link" href="<?php print_r($site_url); ?>/customer/cus_admin.php">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 會員專區
            </a>
            <?php
              } else {
            ?>
                <a class="nav-link" href="<?php print_r($site_url); ?>/customer/cus_login.php">
                  <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 會員登入
                </a>
            <?php
              }
            ?>
          </li>
          <li class="nav-item"><a class="nav-link" href="<?php print_r($site_url); ?>/customer/cus_prizes.php"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> 價格查詢</a></li>
          <?php
            if (!isset($_SESSION['username'])){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php print_r($site_url); ?>/customer/cus_register.php">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 免費註冊
            </a>
          </li>
          <?php
            }
          ?>
          <li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 加入我們</a></li>
        </ul>
      </div>
    </nav>
  </div>
</header>
