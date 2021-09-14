<?php
include("static/include/sql.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$errormessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $logname = $_POST["email"];
  $checkno = $_POST['checkno'];
  $checknumber = mt_rand(100000,999999);
  $destination_path = "http://".$_SERVER['HTTP_HOST']."/alicanada/resetpassword.php?n=".$logname;
  $stmt = $pdo->prepare("SELECT * From `user_table` where `Email` = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO?????
      if(empty($row)){
          $errormessage = "抱歉，该邮箱还没有注册";
      }else{
          $stmt = $pdo->prepare("DELETE FROM `forgetpassword_table` where `UserName` = '$logname' ;");
          $stmt->execute();
          $stmt = $pdo->prepare("INSERT INTO `forgetpassword_table`(`UserName`, `CheckNo`) VALUES ('$logname','$checknumber');");
          $stmt->execute();
          if($stmt != null){
              require 'PHPMailer/src/Exception.php';
              require 'PHPMailer/src/PHPMailer.php';
              require 'PHPMailer/src/SMTP.php';
              $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
              try {
                  //Server settings
                  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                   $mail->isSMTP();                                      // Set mailer to use SMTP
                  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                  $mail->SMTPAuth = true;                               // Enable SMTP authentication
                  $mail->Username = "a2957360@gmail.com";                 // SMTP username
                  $mail->Password = 'uclmjwfqwxrljuif';                           // SMTP password
                  $mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
                  $mail->Port = 587;                                    // TCP port to connect to
                  $mail->CharSet="UTF-8";
                  //Recipients
                  $mail->setFrom('a2957360@gmail.com', 'sender');
                  $mail->addAddress($logname, 'guest');     // Add a recipient
                  //Attachments
                  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                  //Content
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->AddEmbeddedImage('static/img/icon.png','logo');
                  $mail->Subject = 'Silver Pacific Gyre 邮箱找回密码';
                   $mail->Body    = "<img style='width:50%' src='cid:logo'><br>
                                    感谢您使用太平洋银流，请点击以下网址并使用验证码进行修改<br>
                                    网址：<a href='".$destination_path."'>".$destination_path."</a><br>
                                    验证码：".$checknumber."<br>";


                  if($mail->send()){
                    echo "<script> location.href='passwordsuccess.html'; </script>";
                  }
                  } catch (Exception $e) {
                      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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
    <title>Silver Pacific Gyre Foregt Password</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row fullhight">

            <div class="col-lg-6 col-1">
            </div>
            <div class="col-8 col-lg-4 m-auto">
              <div class="row text-left">
                <div class="col-12 text-center">
                  <img style="width:20%" class="text-center" src="static/img/icon.png">
                </div>
                  <p class="m-auto colorred"><?=$errormessage;?></p>
                <form class="col-12 ud20 text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <div class="col-12 ud10">
                    <div class="row">
                      <div class="col-12">
                        <h3>邮箱</h3>
                      </div>
                      <div class="col-12">
                      <input class="checkbtn" type="email" name="email" required autofocus>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud10 text-center">
                  <input class="btn btn-primary btn-lg btncolor checkbtn" type="submit" name="" value="发送验证码">
                </div>
                </form>
              </div>
            </div>
        <div class="col-1"></div>
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