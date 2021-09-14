<?php
    include("static/include/sql.php");
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    if(isset($_POST['paymentid'])){
      $paymentId = $_POST['paymentid'];
    }else{
      $paymentId = $_SESSION['PaymentId'];
    }
    $stmt = $pdo->prepare("SELECT * FROM `life_table` WHERE `Id` = '$paymentId';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $method=$row['Method'];
        $companyname=$row['CompanyName'];
        $companyabb=$row['CompanyAbb'];
        $address=$row['CompanyAddress'];
        $accountno=$row['AccountNo'];
        $memo=$row['Memo'];
        $price=$row['Price'];
        $charge=$row['ChargeFee'];
        $referenceno=$row['Reference'];
        $firstname=$row['FirstName'];
        $lastname=$row['LastName'];
        $phone=$row['Phone'];
        $email=$row['Email'];
        $orderid=$row['OrderNo'];

      }
    }
    if(isset($_POST['check']) && !isset($_POST['noemail'])){
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    $logname = $_SESSION["UserName"];
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        // $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "a2957360@gmail.com";                 // SMTP username
        $mail->Password = 'a4343975';                           // SMTP password
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
        $mail->Subject = '您的汇款已成功';
        $mail->Body    = "订单号：".$orderid.
                         "支付金额（加币）: CAD $".$price.
                         "公司名字（全称）：".$companyname.
                         "公司名字（简称）：".$companyabb.
                         "公司地址".$address.
                         "Account number： ".$accountno.
                         "付款人名字：".$lastname." ".$firstname.
                         "Email：".$email.
                         "电话：".$phone;

        if($mail->send()){
          echo "<script> location.href='login.php'; </script>";
        }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    $date = date('YmdHis');
    $front = strtoupper(substr($firstname,-2));
    $orderid = $front.$date.$paymentId.substr($phone, -1);
    $stmt = $pdo->prepare("UPDATE `life_table` SET `OrderNo`='$orderid' WHERE `Id`='$paymentId';");

    $trans_amount = $price + $charge;
    $payment_method = $method;
    $out_order_no = $orderid;
    $date = date('Y-m-d H:i:s');
    $timestamp = $date;
    $notify_url = 'http://'.$_SERVER['SERVER_NAME'].'/static/include/snappay/notifyurl.php?PayFor=tuition&PaymentId='.$paymentId;
    $description = 'living cost for '.$companyname;

    $return_url = 'http://'.$_SERVER['SERVER_NAME'].'/static/include/snappay/returnurl.php?PayFor=tuition&PaymentId='.$paymentId;
    $_SESSION['Payfor'] = "life";

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
    <title>AliCanada Payment</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <img class="img-fluid bannerlogo" alt="Responsive image" src="static/img/Logo.png">
          <p  class="ud20">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>

      <div class="row">
                        <div class="col-12 col-lg-6 text-center">
            <div class="col-12 u40">
              <h2>付款人信息</h2>
              <br>
              <div class="row grey">
                <div class="col-6">
                  <p>名(拼音) </p>
                </div>
                <div class="col-6 text-left">
                  <p><?= $firstname ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>姓(拼音) </p>
                </div>
                <div class="col-6 text-left">
                  <p><?= $lastname ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>电话号码  </p>
                </div>
                <div class="col-6 text-left">
                  <p><?= $phone ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>电子邮箱  </p>
                </div>
                <div class="col-6 text-left">
                  <p><?= $email ?></p>
                </div>
              </div>
            </div>
        </div>
                <div class="col-1 col-lg-1 text-center ud20">
          <div class="row text-center" >
          <img src="static/img/arrow1.png">
          </div>
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
          <div class="row">
          <img  src="static/img/arrow4.png">
          <p style="writing-mode: vertical-rl;">第三步</p>
          </div>          
        </div>
        <div class="col-8 col-lg-4 m-auto">
          <div class="row">
            <div class="col-12 ud20">
              <h3>信息核对</h3>
            </div>

            <div class="col-12 ">
              <div class="row grey">
                <div class="col-6">
                  <p>公司名字（全称）</p>
                </div>
                <div class="col-6">
                  <p><?= $companyname ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>公司名字（简称）</p>
                </div>
                <div class="col-6">
                  <p><?= $companyabb ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>公司地址</p>
                </div>
                <div class="col-6">
                  <p><?= $address ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>Account number </p>
                </div>
                <div class="col-6">
                  <p><?= $accountno ?></p>
                </div>
              </div>
              <div class="row grey">
                <div class="col-6">
                  <p>Memo</p>
                </div>
                <div class="col-6">
                  <p><?= $memo ?></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>支付金额</p>
                </div>
                <div class="col-6">
                  <p><strong>CAD$ <?= $price ?></strong></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>服务手续费</p>
                </div>
                <div class="col-6">
                  <p><strong>CAD$ <?= $charge ?></strong></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>参考码</p>
                </div>
                <div class="col-6">
                  <p><?= $referenceno ?></p>
                </div>
              </div>
            </div>
            <?php 
                if(!isset($_POST['check'])){
            ?>
            <div class="col-12 lightbluebg border rounded ud20">
              <p class="msfont">*温馨提示，请您点击支付之前务必阅读*<br>
                  学费单笔支付金额较大，各位家长和同学可能会因为不同银行卡在支付宝微信平台上的单笔限额<br>
                  不一，而无法一笔完成支付，如遇到此问题，请查看支付宝/微信单笔限额及提高限额解决方案。</p>
            </div> 

            <form class="col-12 btnspace"  class="row" action="static/include/snappay/payapi.php" method="POST">
              <input type="hidden" name="trans_amount" value="<?= $trans_amount?>">
              <input type="hidden" name="payment_method" value="<?= $payment_method?>">
              <input type="hidden" name="out_order_no" value="<?= $out_order_no?>">
              <input type="hidden" name="timestamp" value="<?= $timestamp?>">
              <input type="hidden" name="notify_url" value="<?= $notify_url?>">
              <input type="hidden" name="description" value="<?= $description?>">
              <input type="hidden" name="return_url" value="<?= $return_url?>">
              <input class="btn btn-primary btn-lg btn-block btncolor" type="submit" name="submit" value="前往付款">
            </form>
            <?php
              }else{

            ?>
            <div class="col-12 btnspace"  class="row">
              <a class="btn btn-primary btn-lg btn-block btncolor" href="personalcenter.php" >返回</a>
            </div>
            <?php
              }
            ?>

          </div>
        </div>
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