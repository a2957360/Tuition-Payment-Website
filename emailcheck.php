<?php
include("static/include/sql.php");
$errormessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $logname = $_POST["email"];
  $checkno = $_POST['checkno'];
  $stmt = $pdo->prepare("SELECT * From `user_table` where `Email` = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO?????
      if(empty($row)){
        echo "<script> location.href='login.php'; </script>";
      }else{
      if($checkno === $row['CheckNo']){
          $stmt = $pdo->prepare("UPDATE `user_table` SET `Checked`='1',`CheckNo`='' WHERE `Email` = '$logname';");
          $stmt->execute();
          if($stmt != null){
              $_SESSION["UserName"] = $logname;
              $id = $row['Id'];
              $_SESSION["UserId"] = $id;
              echo "<script> location.href='index.php'; </script>";
          }
      }else{
          $errormessage = "验证码错误";
      }
      }
  }
}else{
  if(!isset($_SESSION["UserName"])){
  echo "<script> location.href='outoftime.html'; </script>";
  }
  $logname = $_SESSION["UserName"];
  session_destroy();
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
    <title>Silver Pacific Gyre Email Check</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row fullhight">

            <div class="col-6">
              
            </div>
            <div class="col-6 col-lg-4 m-auto">
              <div class="row text-left">
                <div class="col-12 text-center">
                  <h1 class="m-auto">LOGO</h1>
                </div>
                  <p class="m-auto colorred"><?=$errormessage;?></p>
                <form class="col-12 ud20 text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-12">
                        <h3>验证码</h3>
                        <p class="grey">请输入你从邮箱获得的验证码(6位数字)</p>
                      </div>
                      <div class="col-12">
                        <input type="hidden" name="email" value="<?= $logname?>">
                      <input type="password" pattern="\d{6}$" name="checkno" required autofocus>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud10p text-center">
                  <input class="btn btn-primary btn-lg btncolor   btnsize" type="submit" name="" value="验证">
                </div>
                </form>
              </div>
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