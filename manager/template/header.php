<header>
  <div class="container navbar-fixed-top">
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="/index.php">vServer Web Manager Web Site</a>
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
            include ($root_path."/lib/system.php");
            if (isset($_SESSION['username'])){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php print_r($site_url); ?>/main/admin_index.php">
              <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> 訊息管理
            </a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php print_r($site_url); ?>/sys/index.php">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span> 系統管理
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php print_r($site_url); ?>/bill/index.php">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span> 帳務管理
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php print_r($site_url); ?>/logout.php">
                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 系統登出
              </a>
            </li>
            <?php
              } else {

              }
            ?>
        </ul>
      </div>
    </nav>
  </div>
</header>
