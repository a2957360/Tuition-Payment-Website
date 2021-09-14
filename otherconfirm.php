<?php
    include("static/include/sql.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    if(isset($_POST['paymentid'])){
      $paymentId = $_POST['paymentid'];
    }else{
      $paymentId = $_SESSION['PaymentId'];
    }
    $stmt = $pdo->prepare("SELECT * FROM `other_table` WHERE `Id` = '$paymentId';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $method=$row['Method'];
        $USDorCAD=$row['USDorCAD'];
        $companyname=$row['CompanyName'];
        $companyabb=$row['CompanyAbb'];
        $address=$row['CompanyAddress'];
        $accountno=$row['AccountNo'];
        $memo=$row['Memo'];
        $price=$row['Price'];
        $charge= (float)$price * (float)$row['ChargeFee'] / 100;
        $referenceno=$row['Reference'];
        $firstname=$row['FirstName'];
        $lastname=$row['LastName'];
        $phone=$row['Phone'];
        $email=$row['Email'];
        $orderid=$row['OrderNo'];
        switch($USDorCAD){
            case 'USD':
                $currency="美元 USD";
                break;
            case 'CAD':
                $currency="加元 CAD";
                break;
        }

      }
    }
    if(isset($_POST['check']) && !isset($_POST['noemail'])){
        $paysuccess = "你的付款已成功，以下是您的付款信息";
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        $logname = $_SESSION["UserName"];
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
             $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = "payment@slpcge.com";                 // SMTP username
            $mail->Password = 'Slpcge123';                           // SMTP password
            $mail->SMTPSecure = 'TLS';                     // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->CharSet="UTF-8";
            //Recipients
            $mail->setFrom('payment@slpcge.com', 'Slpcge');
            $mail->addAddress($email, $lastname." ".$firstname);     // Add a recipient
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->AddEmbeddedImage('static/img/icon.png','logo');
            $mail->Subject = 'Silver Pacific Gyre 您的汇款已成功';
            $mail->Body    = "<img style='width:50%' src='cid:logo'><br>
                              您好，感谢您使用太平洋银流，以下是您的支付信息，所支付款项会在5个工作日后到账。<br>
                              <h4>订单信息</h4>
                            订单号：".$orderid."<br>".
                            "支付币种:".$currency."<br>".
                             "支付金额: CAD $".$price."<br>".
                             "<h4>付款人信息</h4>".
                             "名：".$firstname."<br>".
                             "姓: ".$lastname."<br>".
                             "电话号码: ".$phone."<br>".
                             "电子邮箱: ".$email."<br>".
                             "<h4>收款方信息</h4>".
                             "公司名字（全称）：".$companyname."<br>".
                             "Account number：".$accountno."<br>".
                             "公司地址".$address."<br><br>".
                            "如有任何问题，请联系我们<br>
                                Email：support@slpcge.com<br>
                                电话：+1 613 879 7783<br>
                                ";

            if($mail->send()){
            }
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
    }else{
        $date = date('YmdHis');
        $front = strtoupper(substr($firstname,-2));
        $orderid = $front.$date.$paymentId.substr($phone, -1);
        $stmt = $pdo->prepare("UPDATE `other_table` SET `OrderNo`='$orderid' WHERE `Id`='$paymentId';");

        $trans_amount = $price + $charge;
        $payment_method = $method;
        $out_order_no = $orderid;
        $date = date('Y-m-d H:i:s');
        $timestamp = $date;
        $notify_url = 'https://'.$_SERVER['SERVER_NAME'].'/alicanada/static/include/snappay/notifyurl.php?PayFor=other&PaymentId='.$paymentId;
        $description = 'Payment to '.$companyname;

        $return_url = 'https://'.$_SERVER['SERVER_NAME'].'/alicanada/static/include/snappay/returnurl.php?PayFor=other&PaymentId='.$paymentId;
        $_SESSION['Payfor'] = "other";
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
    <title>AliCanada Payment</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center">
<!--          <img class="img-fluid bannerlogo" alt="Responsive image" src="static/img/Logo.png">-->
          <p  class="ud20">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>
        <div class="row text-center">
            <div class="col-12 ud10">
          <h5><?=$paysuccess?></h5>
            </div>
        </div>
      <div class="row">
        <div class="col-12 col-lg-6">
            <div class="col-12  text-left pl20">
            <div class="row">
            <div class="col-10 ud20">
              <h3>付款方信息</h3>
            </div>
              <?php
              if(isset($_SESSION['PaymentId'])){
                echo '<form class="col-2 ud20" action="otherperson.php" method="post">
                    <input type="hidden" name="modify" value="1">
                    <input class="btn btn-outline-primary" type="submit" name="submit" value="修改">
                </form>';
              }
            ?>
            </div>
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
        <div class="col-12 col-lg-5 m-auto text-center">
        <div class="row">
        <?php
        if(isset($_SESSION['PaymentId'])){
        ?>
        <div class="col-1 col-lg-1 text-center ud20 paddingLeft20">
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>   
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>   
          <div class="row">
          <img  src="static/img/arrow4.png">
          <p >第四步</p>
          </div>          
        </div>
        <?php
                }
        ?>
        <div class="col-10 col-lg-11 m-auto">
        <div class="col-12 col-lg-12 m-auto text-left">
                  <div class="row">
            <div class="col-10 ud20">
              <h3>信息核对</h3>
            </div>
              <?php
              if(isset($_SESSION['PaymentId'])){
                echo '<form class="col-2 ud20" action="otherinfo.php" method="post">
                     <input type="hidden" name="modify" value="1">
                    <input class="btn btn-outline-primary" type="submit" name="submit" value="修改">
                </form>';
              }
            ?>
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
            <div class="row">
            <div class="col-10 ud20">
              <h3>金额核对</h3>
            </div>
              <?php
              if(isset($_SESSION['PaymentId'])){
                echo '<form class="col-2 ud20" action="otherpayment.php" method="post">
                    <input type="hidden" name="modify" value="1">
                    <input class="btn btn-outline-primary" type="submit" name="submit" value="修改">
                </form>';
              }
            ?>
            </div>
            <div class="row ">
                <div class="col-6">
                  <p>订单号</p>
                </div>
                <div class="col-6">
                  <p><strong><?= $orderid ?></strong></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>支付币种</p>
                </div>
                <div class="col-6">
                  <p><strong><?=$currency?></strong></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>支付金额</p>
                </div>
                <div class="col-6">
                  <p><strong><?=$USDorCAD?>$ <?= $price ?></strong></p>
                </div>
              </div>
              <div class="row ">
                <div class="col-6">
                  <p>服务手续费</p>
                </div>
                <div class="col-6">
                  <p><strong><?=$USDorCAD?>$ <?= $charge ?></strong></p>
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
            <div class="col-12  text-center">
                <p>提交表示同意<a class="colorblue" href="paymentterm.php">《银流付协议》</a></p>
            </div>
                <div class="col-10 shadow-lg p-3 mb-5 bg-white rounded">
              <p class="msfont ">由于中国和加拿大的时区原因，校方会在3-4个工作日内收到款项。我们会邮件通知您。<br><br>
                了解更多信息，请拨打学费宝客服专线：<br>
                免费咨询电话: +1 613 879 7783<br>
                电子邮件:support@slpcge.com</p>
            </div>

            <form class="col-12 btnspace"  class="row" action="static/include/snappay/payapi.php" method="POST">
              <input type="hidden" name="trans_amount" value="<?= $trans_amount?>">
              <input type="hidden" name="currency" value="<?= $USDorCAD?>">
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
              <a class="btn btn-primary btn-lg btn-block btncolor" href="tradecenter.php" >返回</a>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        </div>
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