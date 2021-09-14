<?php
include("static/include/sql.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$errormessage = "";
$logname = $_GET["n"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $logname = $_POST["email"];
  $checkno = $_POST['checkno'];
  $password = $_POST['password'];
  $stmt = $pdo->prepare("SELECT * From `forgetpassword_table` where `UserName` = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
              echo '1';
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO?????
    if($checkno === $row['CheckNo']){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE `user_table` SET `Password`='$password' WHERE `Email` = '$logname';");
        $stmt->execute();
        if($stmt != null){
          $stmt = $pdo->prepare("SELECT * From `user_table` where Email = '$logname' ;");
          $stmt->execute();
          if($stmt != null){
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
          $_SESSION["UserName"] = $logname;
          $id = $row['Id'];
          $_SESSION["UserId"] = $id;
          echo $logname;
          $stmt = $pdo->prepare("DELETE FROM `forgetpassword_table` where `UserName` = '$logname' ;");
          $stmt->execute();
          echo "<script> location.href='passwordchangesuccess.html'; </script>";
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
    <title>Silver Pacific Gyre Reset Password</title>
  </head>
<style>
.btnsize {
    width: 33%;
}    
.fullhight {
    height: 860px;
}
@media (max-width: 576px) {
.fullhight {
    height: 500px;
}
input[type="text"], input[type="password"], input[type="email"] {
    width: 90%;
    height: 30px;
}
}
</style>


  <body class="fullback">
    <div class="container-fluid">


      <div class="row fullhight">
            <div class="col-lg-4 d-sm-none d-lg-block">
            </div>
            <div class="col-12 col-lg-4 m-auto">
              <div class="row text-left">
                <div class="col-12 text-center">
                  <img style="width:20%" class="text-center" src="static/img/icon.png">
                </div>
                <form class="col-12 ud10p" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-12 col-lg-6 text-center">
                        密码：
                      </div>
                      <div class="col-12  col-lg-6 text-center">
                        <input type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" type="password" title="密码必须包含大写、小写字母和数字，最少八位。" oninput="checkPassword()" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-12 col-lg-6 text-center">
                        再输一次密码：
                      </div>
                    <div class="col-12  col-lg-6 text-center">
                      <input type="password" name="repassword" id="repassword"  oninput="checkPassword()" required>
                    </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-12 col-lg-6 text-center">
                        验证码：
                      </div>
                      <div class="col-12  col-lg-6 text-center">
                        <input type="text" pattern="\d{6}$" title="验证码为六位数字。" name="checkno" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p  text-center">
                    <input type="hidden" name="email" value="<?=$logname?>">
                    <input class="btn btn-primary btn-lg btncolor   checkbtn" type="submit" name="submit" value="密码修改">
                  </div>
                </form>
              </div>
            </div>
  <!--         </div>
        </div> -->
      </div>

      <div class="row footer text-center ">
        <div class="col-12 m-auto ">
          <p>@ 2019 Silver Pacific Gyre Inc. All rights reserved. Powered By Finestudio.</p>
        </div>
      </div>
    </div>

    <script>
    function checkPassword(){
        var password = document.getElementById("password");
        var re_password = document.getElementById("repassword");
        if(password.value === re_password.value){
            re_password.setCustomValidity('');
        }else{
            re_password.setCustomValidity('两次输入的密码不相同');
        }
    }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>