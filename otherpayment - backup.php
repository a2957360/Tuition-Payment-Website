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
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $paymentId = $_SESSION['PaymentId'];
    $date = date('YmdHis');
    $front = strtoupper(substr($firstname,-2));
    $orderid = $front.$date.$paymentId.substr($phone, -1);

    $stmt = $pdo->prepare("UPDATE `other_table` SET `FirstName`='$firstname',`LastName`='$lastname',`Phone`='$phone',`Email`='$email',`OrderNo`='$orderid' WHERE `Id`='$paymentId';");
    $stmt->execute();
      if($stmt != null){
          echo "<script> location.href='otherconfirm.php'; </script>";

      }else{
        die('Error: ' . mysql_error());
    }

    $pdo = null;
  }
    $logname = $_SESSION["UserName"];
  $stmt = $pdo->prepare("SELECT * From `user_table` where Email = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO处理结果集
      $FirstName = $row['FirstName'];
      $LastName = $row['LastName'];
      $Phone = $row['Phone'];
      $Email = $row['Email'];
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
        </div>
        <div class="col-1 col-lg-1 text-center ud20">
          <div class="row text-center" >
          <img src="static/img/arrow1.png">
          </div>
          <div class="row">
          <img src="static/img/arrow4.png">
          <p style="writing-mode: vertical-rl;">第二步</p>
          </div>          
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
        </div>
        <div class="col-8 col-lg-4 m-auto">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data' class="row">
            <div class="col-12 ud20">
              <h3>付款人信息</h3>
            </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"  onclick="defaultinfo()" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">使用默认信息</label>
              </div>
            <div class="col-12">
              <p><span class="colorred">*</span>名（拼音）:</p>
              <input class="wide-80" id="firstname" value="<?=$FirstName?>" pattern="[a-zA-Z]{0,20}" type="text" name="firstname" required autofocus="">
            </div>

            <div class="col-12">
              <p><span  class="colorred">*</span>姓（拼音）:</p>
              <input class="wide-80" id="lastname" value="<?=$LastName?>" pattern="[a-zA-Z]{0,10}" type="text" name="lastname"required>
            </div>
            <div class="col-12">
              <p><span  class="colorred">*</span>电话号码:</p>
              <input  class="wide-80" id="phone" value="<?=$Phone?>" type="text" pattern="(^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8})|(\d{10})" name="phone" required>
            </div>
            <div class="col-12">
              <p><span  class="colorred">*</span>电子邮箱:</p>
              <input  class="wide-80" id="email" value="<?=$Email?>" type="email" name="email" required>
              <p class="lightbluebg border smspacce rounded">电子收据会发送至此邮箱</p>
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
        <script type="text/javascript">
      function defaultinfo(){
        if($("#customCheck1").prop('checked')){
          $("#firstname").val("<?=$FirstName?>");
          $("#lastname").val("<?=$LastName?>") ;
          $("#phone").val("<?=$Phone?>");
          $("#email").val("<?=$Email?>");
          $("#firstname").attr('disabled','disabled');
          $("#lastname").attr('disabled','disabled');
          $("#phone").attr('disabled','disabled');
          $("#email").attr('disabled','disabled');
        }else{
          $("#firstname").removeAttr('disabled');
          $("#lastname").removeAttr('disabled');
          $("#phone").removeAttr('disabled');
          $("#email").removeAttr('disabled');
        }
      }
    </script>
  </body>
</html>