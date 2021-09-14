        <nav class="row navbar navbar-dark bg-dark">
          <span class="navbar-text topbar">
            <img class="img-fluid icon" alt="Responsive image" src="static/img/email.png"> name@email.com | <img class="img-fluid icon" alt="Responsive image" src="static/img/phone.png">+1 123 456 7890
          </span>
        </nav>
        <nav class="row navbar navbar-light menubar">
            <a class="nav-brand" href="#">Logo</a>
        <ul class="nav justify-content-center">
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
        </ul>
        <?php if(!isset($_SESSION["UserName"])){
        	?>
            <a class="nav-link" href="login.php">登陆/注册</a>
        <?php }else{?>
            你好<?= $_SESSION["UserName"]?><a class="nav-link" href="logout.php">退出</a>
        <?php }?>

        </nav>