<!--         <nav class="row navbar navbar-dark bg-dark">
          <span class="navbar-text topbar">
            <img class="img-fluid icon" alt="Responsive image" src="static/img/email.png"> name@email.com | <img class="img-fluid icon" alt="Responsive image" src="static/img/phone.png">+1 123 456 7890
          </span>
        </nav> -->
<!--
        <head>
            <link rel="stylesheet" href="../../fontawesome-free-5.11.2-web/css/all.css" >
             <script defer src="../../fontawesome-free-5.11.2-web/js/all.js"></script>
          
        </head>
-->
        <nav class="row navbar navbar-light menubar">
            <a class="nav-brand" href="index.php"><img class=" menulogo" alt="Responsive image" src="static/img/Logo.png"></a>
        <ul class="navbar-toggle nav justify-content-center lmenu">
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><strong>首页</strong></a>
          </li>
<!--
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php"><strong>关于我们</strong></a>
          </li>
-->
          <li class="nav-item">
            <a class="nav-link" href="helpcenter.php"><strong>帮助中心</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contractus.php"><strong>联系我们</strong></a>
          </li>
        <?php if(!isset($_SESSION["UserName"])){
        	?>
            <li class="nav-item">
                <a class="nav-link" href="login.php"><strong>登陆/注册</strong></a>
            </li>
        <?php
            }
            ?>
        </ul>

        <?php
            if(isset($_SESSION["UserName"])){
            ?>
            <div class="row mobilenoshow">
                <span class="m-auto text-overflow">你好 : <a class="" href="personalcenter.php"><?= $_SESSION["UserName"]?></a>, &nbsp; &nbsp;</span> 
              <div class="dropdown">
                <button style="color: white" type="button" class="btn btncolor dropdown-toggle" data-toggle="dropdown">
                  管理
                </button>
                <div class="dropdown-menu ">
                    <a class="dropdown-item" href="tradecenter.php">订单中心</a>
                  <a class="dropdown-item" href="personalcenter.php">个人中心</a>
                  <a class="dropdown-item" href="changepassword.php">修改密码</a>
                  <a class="dropdown-item colorred" href="logout.php">退出</a>
                </div>
              </div>
            </div>

        <?php }?>
<!--
        <div   style="width:10%" class="navbar-header smenu">
          <div class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="menuline">——</span>
            <img style="width:100%" src="static/img/menu.png">
          </div>
        </div>
-->
        <?php if(!isset($_SESSION["UserName"])){
        	?>
                <a class="mobilshow mlog" href="login.php">登陆/注册</a>
        <?php
                }
            ?>
        <div style="width:10%" class="navbar-header smenu">


            <?php
            if(isset($_SESSION["UserName"])){
            ?>
              <div class="dropdown">
                  <div class="navbar-toggle" data-toggle="collapse" data-target="#dropmenu">
                    <img style="width:100%" src="static/img/menu.png">
                  </div>
                <div class="dropdown-menu lefshow" id="dropmenu">
                    <a class="dropdown-item" href="tradecenter.php">订单中心</a>
                  <a class="dropdown-item" href="personalcenter.php">个人中心</a>
                  <a class="dropdown-item" href="changepassword.php">修改密码</a>
                  <a class="dropdown-item colorred" href="logout.php">退出</a>
                </div>
              </div>
            <?php }?>
        </div>
        </nav>

    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-toggle nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">首页</a>
          </li>
<!--
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">关于我们</a>
          </li>
-->
          <li class="nav-item">
            <a class="nav-link" href="helpcenter.php">帮助中心</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contractus.php">联系我们</a>
          </li>
                    <?php if(!isset($_SESSION["UserName"])){
        	?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">登陆/注册</a>
        </li>
        <?php
            }
            ?>
        </ul>
      </div>

<nav class="navbar fixed-bottom navbar-light floatmenu mobilshow">
  <li class="nav-bot">
    <a class="nav-link active" href="index.php">
<!--        <embed src="../../static/img/storage.svg" type="image/svg+xml" />-->
        <img src="static/img/storage.svg" width="30px" height="auto"><br>
        首页
      </a>
  </li>
  <li class="nav-bot">
      
    <a class="nav-link" href="aboutus.php">
                 <img src="static/img/about.svg" width="30px" height="auto"><br>关于我们</a>
  </li>
  <li class="nav-bot">
    <a class="nav-link" href="helpcenter.php"> <img src="static/img/help.svg" width="30px" height="auto"><br>帮助中心</a>
  </li>
  <li class="nav-bot">
    <a class="nav-link" href="contractus.php"> <img src="static/img/customerService.svg" width="30px" height="auto"><br>联系我们</a>
  </li>
</nav>
