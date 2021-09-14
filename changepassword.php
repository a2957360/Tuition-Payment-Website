<?php
include("static/include/sql.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$errormessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $logname = $_SESSION["UserName"];
  $opassword = $_POST['opassword'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  $stmt = $pdo->prepare("SELECT * From `user_table` where `Email` = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO?????
      if(empty($row)){
          $errormessage = "邮箱不存在";
      }else{
          if(password_verify($opassword,$row['Password'])){
            if($password === $repassword){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE `user_table` SET `Password`='$password' WHERE `Email` = '$logname';");
            $stmt->execute();
            if($stmt != null){
              echo "<script> location.href='passwordsuccess.html'; </script>";
            }
          }
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
    <title>Silver Pacific Gyre Change Password</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row fullhight">

            <div class="col-1 col-lg-6">
              
            </div>
            <div class="col-10 col-lg-4 m-auto">
              <div class="row text-left">
                <div class="col-12 text-center">
                  <img style="width:20%" class="text-center" src="static/img/icon.png">
                </div>
                  <p class="m-auto colorred"><?=$errormessage;?></p>
                <form class="col-12 ud20" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4">
                        旧密码：
                      </div>
                      <div class="col-8">
                      <input type="password" name="opassword" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4">
                        新密码：
                      </div>
                      <div class="col-8">
                      <input type="password" pattern="\w{5,17}$" name="password" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4  noPaddingRight">
                        重复新密码：
                      </div>
                      <div class="col-8">
                      <input type="password" pattern="\w{5,17}$" name="repassword" required autofocus>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud10p text-center">
                    <div class="row">
                    <div class="col-12 col-lg-6 ud10p text-center">
                        <a href="index.php" class="btn btn-outline-primary cpbtn">返回首页</a>
                    </div>
                   <div class="col-12  col-lg-6 ud10p text-center">
                        <input class="btn btn-outline-primary cpbtn" type="submit" name="" value="修改密码">
                    </div>
                    </div>
                </div>
                </form>
              </div>
            </div>
            <div class="col-1">
              
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
  </body>
</html>