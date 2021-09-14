  <?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
    
    $name =$_POST['name'];
    $email=$_POST['email'];
    $tel =$_POST['telphone'];
    $message =$_POST['$message'];
//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
    
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
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

    $mail->setFrom("payment@slpcge.com", $name);
    $mail->addAddress("support@slpcge.com", 'contractus');     // Add a recipient
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message From Website';
    $mail->Body    = " The customer email is : " . $email . "<br>" .
                     "The customer name is : " . $name . "<br>" .
                     "The Telephone number is : " . $tel . "<br>" .
                     "The customer feedback: " . $message;

    if($mail->send()){
        echo "<script> location.href='emailsuccess.html'; </script>";
    }

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
 
?> 1