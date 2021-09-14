<?php
    include("static/include/sql.php");
    $email = $_POST['email'];
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    header("Content-Type: text/html; charset=utf8");

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $stmt = $pdo->prepare("SELECT * FROM `user_table` WHERE `Email` = '$email';");
    $stmt->execute();
    if($stmt != null){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "have";
                exit;
            }
    }

    $checknumber = mt_rand(100000,999999);
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
      //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $email->SMTPDebug = true;
     $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "payment@slpcge.com";                 // SMTP username
    $mail->Password = "Slpcge123";                           // SMTP password
    $mail->SMTPSecure = 'TLS';                     // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->CharSet="UTF-8";
    //Recipients
        
      $mail->setFrom("payment@slpcge.com", 'Slpcge');
      $mail->addAddress($email, 'Customer');     // Add a recipient
      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
        $mail->AddEmbeddedImage('static/img/icon.png','logo');
      $mail->Subject = 'Silver Pacific Gyre 邮箱验证码';
      $mail->Body    = "<img style='width:50%' src='cid:logo'><br>
                        感谢您使用太平洋银流，以下是您的验证码<br>
                        验证码：".$checknumber;

      if($mail->send()){
          echo $checknumber;
      }
      } catch (Exception $e) {
        echo 'error';
//          echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
      }
?>
