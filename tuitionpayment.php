<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }

    $modify = "";
    if(isset($_POST['modify'])){
        $modify = 1;
    }

    unset($_SESSION["Method"]);

  if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['modify'])) {

    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作
    $price=$_POST['price'];
    $exceptdate=$_POST['exceptdate'];
    $referenceno=$_POST['referenceno'];
    $paymentId = $_SESSION['PaymentId'];
    $date = date('YmdHis');
    $front = strtoupper(substr($firstname,-2));
    $orderid = $front.$date.$paymentId.substr($phone, -1);
    $message = "";
    if($referenceno === "WECHATPAY"||$referenceno === "UNIONPAY"||$referenceno === "ALIPAY"){
      $referenceno = "";
    }
    $stmt = $pdo->prepare("SELECT * FROM `chargefee_table` WHERE `Name` = '$referenceno';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $Percantage=(float)$row['Percentage'];
      }
    } 
      
    if(isset($Percantage)){
        $stmt = $pdo->prepare("SELECT * FROM `chargefee_table` WHERE `Name` Like (SELECT `Method` FROM `student_table` WHERE  `Id`='$paymentId');");
        $stmt->execute();
        if($stmt != null){
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $standardfee=$row['Percentage'];
          }
        } 
        $referenceno = $referenceno.'(-'.$Percantage.'%)';
        $Percantage = $standardfee - $Percantage;
        $stmt = $pdo->prepare("UPDATE `student_table` SET `Price`='$price',`ExceptDate`='$exceptdate',
        `Reference`='$referenceno',`OrderNo`='$orderid',
        `ChargeFee`= '$Percantage' WHERE `Id`='$paymentId';");
        $stmt->execute();
          if($stmt != null){
            if($_POST['modifyvalue'] == '1'){
                    echo "<script> location.href='tuitionconfirm.php'; </script>";
              }
              echo "<script> location.href='tuitionperson.php'; </script>";

          }else{
            die('Error: ' . mysql_error());
        }

    }else if($referenceno == ""){
        $stmt = $pdo->prepare("UPDATE `student_table` SET  `Price`='$price',`ExceptDate`='$exceptdate',`OrderNo`='$orderid' WHERE `Id`='$paymentId';");
        $stmt->execute();
          if($stmt != null){
            if($_POST['modifyvalue'] == '1'){
                    echo "<script> location.href='tuitionconfirm.php'; </script>";
              }
              echo "<script> location.href='tuitionperson.php'; </script>";

          }else{
            die('Error: ' . mysql_error());
        }

    }else{
        $message = "不存在该参考码";
    }

  }
//  $logname = $_SESSION["UserName"];
//  $stmt = $pdo->prepare("SELECT * From `user_table` where Email = '$logname' ;");
//  $stmt->execute();
//  if($stmt != null){
//    $row=$stmt->fetch(PDO::FETCH_ASSOC);//PDO处理结果集
//      $FirstName = $row['FirstName'];
//      $LastName = $row['LastName'];
//      $Phone = $row['Phone'];
//      $Email = $row['Email'];
//  }
    $mindate = date('Y-m-d');
    for($i = 0;$i < 5;$i++){
        $mindate = date("Y-m-d",strtotime("1 day",strtotime($mindate)));
        if(date("w",strtotime($mindate)) === '6' || date("w",strtotime($mindate)) === '0'){
            $i--;
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
    <title>Silver Pacific Gyre Payment</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center">
<!--          <img class="img-fluid bannerlogo" alt="Responsive image" src="static/img/Logo.png">-->
          <p  class="ud20 colorblack">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-5 m-auto text-center">
          <img class=" ud10p maxWidth" src="static/img/midrow1.png">
        </div>
        <div class="col"></div>
        <div class="col-12 col-lg-5 m-auto text-center">
        <div class="row">
        <div class="col-1 col-lg-1 text-center ud20 paddingLeft20">
          <div class="row text-center" >
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>
          <div class="row">
          <img src="static/img/arrow4.png">
          <p style="">第二步</p>
          </div>          
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div> 
        <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>   
        </div>
         
        <div class="col-10 col-lg-11 m-auto">
            <div class="col-12 col-lg-12 m-auto">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data' class="row text-left">
                <div class="col-12 ud10p">
                  <h4>支付信息</h4>
                </div>

                <div class="col-5 nopadding">
                  <p><span class="colorred">*</span>支付金额:</p>
                  <input class="wide-80" type="text" pattern="[0-9.]{0,15}" name="price" required>
                  
                </div> 
                  <p class="grey smCaption">温馨提示: 支付宝/微信支付单笔交易限额可能在$5000至$50,000不等，取决于您绑定的银行卡限额。如果单张银行卡限额，可以先提前把钱转到支付宝余额/微信钱包里哦</p>
<!--
                <div class="col-3 ">
                  <p><span class="colorred">*</span>服务手续费:</p>
                  <input class="wide-80"  type="text" name="" placeholder="5" disabled="">
                  <input  type="hidden" name="charge" value="5">
                  <p  class="grey smfont">此手续费为"学费宝"收取的唯一费用</p>
                </div> 
-->

                <div class="col-12 ud10p ">
                </div> 
                <div class="col-7 nopadding ">
                  <p><span class="colorred">*</span>选择到帐时间:</p>
                  <input class="wide-80" min="<?=$mindate?>" value="<?=$mindate?>" type="date" name="exceptdate" required>
                  <p class="grey smCaption">温馨提示: 需要至少五个工作日到账</p>
                </div> 
                <div class="col-5 ">
                  <p>参考码</p> 
                  <input class="wide-80" type="text" name="referenceno">
                    <p class="colorred"><?=$message?></p>
                </div> 
                <div class="col-12 btnspace">
                <input type="hidden" name="modifyvalue" value="<?=$modify?>">
                  <input class="btn btn-primary btn-lg btn-block btncolor" type="submit" name="submit" value="下一步">
                </div> 
              </form>
            </div>

        </div>
        </div>
        </div>
          <div class="col-1 col-lg-1 text-center ud20"></div>
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