<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作
    $method=$_POST['method'];
    $companyname=$_POST['companyname'];
    $compannyabb=$_POST['companyabb'];
    $address=$_POST['address'];
    $accountno=$_POST['accountno'];
    $memo = $_POST['memo'];
    $price = $_POST['price'];
    $charge = $_POST['charge'];
    $referenceno = $_POST['referenceno'];
    $Id = $_SESSION['UserId'];
    $todaydate = date('Y-m-d');


    $stmt = $pdo->prepare("INSERT INTO `life_table`(`Method`, `CompanyName`, `CompanyAbb`, `CompanyAddress`, `AccountNo`, `Memo`, `Price`, `ChargeFee`, `Reference`, `UserId`, `Status`, `Date`) VALUES ('$method','$companyname','$compannyabb','$address','$accountno','$memo','$price','$charge','$referenceno','$Id','0','$todaydate')");
    $stmt->execute();
      if($stmt != null){
        $stmt = $pdo->prepare("SELECT LAST_INSERT_ID();");
        $stmt->execute();
        if($stmt != null){
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['PaymentId'] = $row['LAST_INSERT_ID()'];
            echo "<script> location.href='lifefeepayment.php'; </script>";
          }
        }
      }else{
        die('Error: ' . mysql_error());
    }

    $pdo = null;
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
          <img class="img-fluid bannerlogo" alt="Responsive image" src="static/img/Logo.png">
          <p  class="ud20">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-6 m-auto text-center">
          <img class=" ud10p" src="static/img/midrow1.png">
            <div class="col-12 border rounded lightbluebg text-center">
              <p class="msfont">由于中国和加拿大的时区原因，校方会在3-4个工作日内收到款项。我们会邮件通知您费用已到账。<br><br>
                了解更多信息，请拨打学费宝客服专线：<br>
                免费咨询电话: +1 844 331 8988<br>
                电子邮件: info@alicampus.ca</p>
            </div> 
        </div>
        <div class="col-1 col-lg-1 text-center ud20">
          <div class="row text-center" >
          <img src="static/img/arrow4.png">
          <p style="writing-mode: vertical-rl;">第一步</p>
          </div>
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
        </div>
        <div class="col-8 col-lg-4 m-auto">
          <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>

            <div class="col-12  ud10p">
              <h3>生活费信息</h3>
            </div>
            
            <div class="col-12 ">
              <p><span class="colorred">*</span>公司名字全称（拼音）:</p>
              <input class="wide-80" pattern="[a-zA-Z0-9 ]{0,50}" type="text" name="companyname" required autofocus>
            </div>

            <div class="col-12 ">
              <p><span class="colorred">*</span>公司名字简称（拼音）:</p>
              <input class="wide-80" pattern="[a-zA-Z0-9 ]{0,20}" type="text" name="companyabb" required>
            </div>
            <div class="col-12 ">
              <p><span class="colorred">*</span>公司地址（拼音）:</p>
              <input class="wide-80"  type="text" name="address" required>
            </div>
            <div class="col-12 ">
              <p>Account number：</p>
              <input class="wide-80" pattern="[0-9-]{16,20}"  type="text" name="accountno">
            </div>    
            <div class="col-12 ">
              <p>Memo：</p>
              <input class="wide-80" type="text" name="memo">
            </div> 

            <div class="col-12 ud10p">
              <h3>支付信息</h3>
            </div>

            <div class="col-12 ">
              <p><span class="colorred">*</span>支付金额(加币):</p>
              <input class="wide-80" type="text" pattern="[0-9.]{0,15}" name="price" required>
              <p class="grey smfont">温馨提示: 支付宝/微信支付单笔交易限额可能在$5000至$50,000不等，取决于您绑定的银行卡限额。查看</p>
              <p class="smfont">支付宝/微信单笔限额及提高限额解决方案。</p>
            </div> 
            <div class="col-12 ">
              <p><span class="colorred">*</span>服务手续费:</p>
              <input class="wide-80"  type="text" name="" placeholder="5" disabled="">
              <input  type="hidden" name="charge" value="5">
              <p  class="grey smfont">此手续费为"学费宝"收取的唯一费用</p>
            </div> 
            <div class="col-12 ">
              <p>参考码</p>
              <input class="wide-80" type="text" name="referenceno">
            </div> 
            <div class="col-12 btnspace">
              <input class="btn btn-primary btn-lg btn-block btncolor" type="submit" name="submit" value="下一步">
            </div> 

          </form>
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