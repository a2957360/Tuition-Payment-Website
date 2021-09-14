<?php
include("static/include/sql.php");
$errormessage = "";
$logname = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $logname = $_POST['username'];
  $logpassword = $_POST['password'];
  $stmt = $pdo->prepare("SELECT * From `user_table` where Email = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO处理结果集
      if(empty($row)){
        $errormessage = "抱歉！该邮箱还没有注册，请先去注册。";
      }else{
      if(password_verify($logpassword,$row['Password'])){
          $_SESSION["UserName"] = $logname;
          $id = $row['Id'];
          $_SESSION["UserId"] = $id;
          $Admin = $row['Admin'];
//          if($row['Checked'] === '0'){
//            echo "<script> location.href='emailcheck.php'; </script>";
//          }
          echo "<script> location.href='index.php'; </script>";
            exit;
      }else{
          $errormessage = "密码错误！请重试";
      }
      }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="static/css/style.css"/>
    <title>Silver Pacific Gyre Login</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row fullhight">

            <div class="col-lg-6 col-1">
              
            </div>
         
            <div class="col-10 col-lg-5 m-auto">
              <div class="row text-left lagrefont">
                <div class="col-12 text-center">
                      <img style="width:20%" class="text-center" src="static/img/icon.png">
                  </div>
                <div class="col-12 text-center">
                  </div>
                  <p class="m-auto colorred"><?=$errormessage;?></p>
                <form class="col-12 ud20" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-5 text-right email">
                         邮箱: 
                      </div>
                      <div class="col-8 col-lg-6">
                      <input type="email" name="username" value="<?=$logname?>" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-5 text-right email">
                        密码: 
                      </div>
                      <div class="col-8 col-lg-6">
                      <input type="password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" type="password" title="密码必须包含大写、小写字母和数字，最少八位。" name="password" required autofocus>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud20 text-center">
                    <div class="row">
                    <div class=" col-12 col-lg-12 ud10p text-center">
                        <input class="btn btn-outline-primary   " type="submit" name="" value="登陆">
                          <a href="register.php" class="btn btn-outline-primary  ">注册</a>
                    </div>
<!--
                    <div class=" col-6 col-lg-6 ud10p text-center">
                       <a href="register.php" class="btn btn-primary btn-lg btncolor  ">注册</a>
                    </div>
-->
                    </div>
                </div>
                <div class="col-12 ud10p text-center">
                  <p>忘记密码？<a style="color:#00a1e1" href="forgetpassword.php">找回密码</a></p>
                </div>
                </form>
              </div>
            </div>
            <div class="col-lg-1 col-1">
              
            </div>
  <!--         </div>
        </div> -->
      </div>

      <?php include("footer.php")?>
      <div class="row footer text-center ">
        <div class="col-12 m-auto ">
          <p>@ 2019 Silver Pacific Gyre Inc. All rights reserved. Powered By Finestudio.</p>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <script>
        //页面加载完成后默认执行的代码.
        $(function(){
            var fullhieght = document.body.clientHeight - $(".menubar").height() - $(".blueback").height()
            $(".fullhight").height(fullhieght);
        });
         window.οnresize=function(){  
             $(".fullhight").height(window.screen.availHeight);
            //HollyProxy.HomePage.prototype.search('${ctx}');//每变一次都会加载该事件
        };

    </script>
  </body>
</html>