<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    date_default_timezone_set('America/Toronto');
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    $modify = "";
    if(isset($_POST['modify'])){
        $modify = 1;
    }
    if($_POST['modifyvalue'] == '1'){
        $paymentId = $_SESSION['PaymentId'];
        $method=$_SESSION["Method"];
        $Id = $_SESSION['UserId'];
        $infoid = $_POST['paytableid'];
        $todaydate = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("UPDATE `student_table` 
                                JOIN (select * FROM `payschool_table` WHERE `Id` = '$infoid') `school` 
                                SET `student_table`.`USDorCAD` = `school`.`USDorCAD`,
                                `student_table`.`SchoolName` = `school`.`SchoolName`, 
                                `student_table`.`SchoolAddress` = `school`.`SchoolAddress`, 
                                `student_table`.`StudentNo` = `school`.`StudentNo`, 
                                `student_table`.`StudentFirstName` = `school`.`StudentFirstName`, 
                                `student_table`.`StudentLastName` = `school`.`StudentLastName`, 
                                `student_table`.`Birthday` = `school`.`Birthday` WHERE `student_table`.`Id` = '$paymentId'");
        $stmt->execute();
          if($stmt != null){
            echo "<script> location.href='tuitionconfirm.php'; </script>";
          }else{
            die('Error: ' . mysql_error());
        }
    }
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['modify']) && $_POST['modifyvalue'] != '1') {

    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作
    $method=$_SESSION["Method"];
    $Id = $_SESSION['UserId'];
    $infoid = $_POST['paytableid'];
    $todaydate = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("SELECT * FROM `chargefee_table` WHERE `Name` Like '$method';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $Percentage=$row['Percentage'];
      }
    } 

    $stmt = $pdo->prepare("INSERT INTO `student_table`(`Method`,`USDorCAD`, `SchoolName`, `SchoolAddress`, `StudentNo`, `StudentFirstName`, `StudentLastName`, `Birthday`, `UserId`, `Status`, `Date`, `ChargeFee`)
    SELECT '$method',`USDorCAD`,`SchoolName`, `SchoolAddress`, `StudentNo`, `StudentFirstName`, `StudentLastName`, `Birthday`,'$Id','0','$todaydate','$Percentage' FROM `payschool_table` WHERE `Id` = '$infoid';");

    $stmt->execute();
      if($stmt != null){
        $stmt = $pdo->prepare("SELECT LAST_INSERT_ID();");
        $stmt->execute();
        if($stmt != null){
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['PaymentId'] = $row['LAST_INSERT_ID()'];
            echo "<script> location.href='tuitionpayment.php'; </script>";
          }
        }
      }else{
        die('Error: ' . mysql_error());
    }

    $pdo = null;
  }
  $Id = $_SESSION['UserId'];
  $resultlist = array();
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
          <p class="ud20  colorblack">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-5 m-auto text-center">
          <img class="maxWidth ud10p" src="static/img/midrow1.png">
        </div>
        <div class="col"></div>
        <div class="col-12 col-lg-5 m-auto text-center">
        <div class="row">
        <div class="col-2 col-lg-1 text-center ">
          <div class="row text-center" >
          <img src="static/img/arrow4.png">
          <p class="steps">第一步</p>
          </div>
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>          
          <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>    
         <div class="row">
          <img src="static/img/arrow2.png" style="opacity: 0.6">
          </div>
        </div>
        <div class="col-10 col-lg-11 m-auto nopadding">
            <div class="row">
<!--            <div class="col-1"></div>-->
<!--
            <div class="col-lg-5 col-10 text-right ud20 pr10">
                <section class="model-1 row">
                <p class="float-right">加币CAD</p>&nbsp;
                  <div class="checkbox float-right">
                    <input class="" type="  id="currencycheck"/>
                    <label></label>
                  </div>
                &nbsp;<p class="float-right">美元USD</p>
                </section>   
            </div>
-->
            <div class="col-lg-5 col-10 text-right ud20 pr10">
                <div class="row ">
                    <div class="col-1"></div>
                    <div class="col-5 noPaddingLeft text-center">
                       <label class="chooseCurrency">CAD
                          <input id="cadbtn" type="radio" checked="checked" name="currency" value="CAD" onclcik="">
                          <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-5 noPaddingLeft text-center">
                         <label class="chooseCurrency">USD
                          <input id="usdbtn" type="radio" name="currency" value="USD" onclcik="">
                          <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 text-right ud20 pr10">
                <a class="btn btn-primary btncolor m-auto " href="personalcenter.php">+添加收款方</a>
            </div>
            </div>
        <?php
            $stmt = $pdo->prepare("SELECT * FROM `payschool_table` WHERE `UserId` = '$Id';");
            $stmt->execute();
            if($stmt != null){
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($resultlist,$row);
              }
            }
        ?>
        <div class="col-lg-12 col-12 pre-scrollable fullhight" id="CAD">
            <?php
                $cadno = 0;
                foreach ($resultlist as $key => $value) {
                    switch($value["USDorCAD"]){
                        case 'USD':
                            $value["USDorCAD"]="美元 USD";
                            continue 2;
                            break;
                        case 'CAD':
                            $value["USDorCAD"]="加元 CAD";
                            $cadno++;
                            break;
                    }
            ?>

            <form class="row mgl1 ud10 shadow-sm rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="col-10 col-lg-10 text-left  ">
                    <div class="row nomargin">
<!--
                        <div class="col-12 col-lg-12">
                            <h3 style="display:inline-block"><?=$value['SchoolName']?><?=$value['CompanyName']?></h3>
                            <p class="grey" style="display:inline-block"><?=$value['CompanyAbb']?></p>
                        </div> 
                         <div class="col-6 col-lg-6">
                            <p>姓名：<?=$value['StudentFirstName']?> <?=$value['StudentLastName']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p>地址 ： <?=$value['SchoolAddress']?><?=$value['CompanyAddress']?></p>
                        </div>    
                         <div class="col-6 col-lg-6">
                            <p>Student No： <?=$value['StudentNo']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p>生日： <?=$value['Birthday']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p><?=$value['USDorCAD']?></p>
                        </div>
-->
                        <div class="col-12 col-lg-12">
                            <h4 class="nomargin" style="display:inline-block"><?=$value['SchoolName']?> 
                                <h5 style="display:inline-block">( <?=$value['StudentFirstName']?> <?=$value['StudentLastName']?> )</h5></h4>
                        </div> 
                    </div>
                </div>
                  <div class="col-lg-2 col-3">
                <input type="hidden" name="paytableid" value="<?=$value['Id']?>">
                <input type="hidden" name="modifyvalue" value="<?=$modify?>">
                <input class="btn btn-primary btn-lg btncolor float-left chooseInfo btnpadding" type="submit" name="submit" value="选择" >
                </div> 
              </form>

            <?php
                } 
                if($cadno == 0){
                    echo '<p class="colorgrey text-left">快去添加您的第一个收款方吧~</p>';
                }
            ?>
        </div>
            
          <div class="col-lg-12 col-12 pre-scrollable dishid fullhight" id="USD">

            <?php

                $usdno = 0;
                foreach ($resultlist as $key => $value) {
                    switch($value["USDorCAD"]){
                        case 'USD':
                            $usdno++;
                            $value["USDorCAD"]="美元 USD";
                            break;
                        case 'CAD':
                            $value["USDorCAD"]="加元 CAD";
                            continue 2;
                            break;
                    }
            ?>

            <form class="row mgl1 ud10 shadow-sm rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="col-10 col-lg-10 text-left  ">
                    <div class="row nomargin">
<!--
                        <div class="col-12 col-lg-12">
                            <h3 style="display:inline-block"><?=$value['SchoolName']?><?=$value['CompanyName']?></h3>
                            <p class="grey" style="display:inline-block"><?=$value['CompanyAbb']?></p>
                        </div> 
                         <div class="col-6 col-lg-6">
                            <p>姓名：<?=$value['StudentFirstName']?> <?=$value['StudentLastName']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p>地址 ： <?=$value['SchoolAddress']?><?=$value['CompanyAddress']?></p>
                        </div>    
                         <div class="col-6 col-lg-6">
                            <p>Student No： <?=$value['StudentNo']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p>生日： <?=$value['Birthday']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p><?=$value['USDorCAD']?></p>
                        </div>
-->
                        <div class="col-12 col-lg-12">
                            <h4 class="nomargin" style="display:inline-block"><?=$value['SchoolName']?> 
                                <h5 style="display:inline-block">( <?=$value['StudentFirstName']?> <?=$value['StudentLastName']?> )</h5></h4>
                        </div>
                    </div>
                </div>
                  <div class="col-lg-2 col-3">
                <input type="hidden" name="paytableid" value="<?=$value['Id']?>">
                <input type="hidden" name="modifyvalue" value="<?=$modify?>">
                <input class="btn btn-primary btn-lg btncolor float-left chooseInfo btnpadding" type="submit" name="submit" value="选择" >
                </div> 
              </form>

            <?php
                } 
                if($usdno == 0){
                    echo '<p class="colorgrey text-left">快去添加您的第一个收款方吧~</p>';
                }
            ?>
 
            </div>
          
        </div>
        </div> 
<!--
        <div class="row">
              <div class="col-1">
              </div>
                <div class="col-10 shadow-lg p-3 mb-5 bg-white rounded">
              <p class="msfont ">由于中国和加拿大的时区原因，校方会在3-4个工作日内收到款项。我们会邮件通知您。<br><br>
                了解更多信息，请拨打学费宝客服专线：<br>
                免费咨询电话: +1 613 879 7783<br>
                电子邮件:silverpacificgyre@gmail.com</p>
            </div> 
        </div>
-->
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
      <script>
          $('#cadbtn').click(function() {
                $("#CAD").toggle(this.checked);
                $("#USD").hide();
            });
        $('#usdbtn').click(function() {
                $("#USD").toggle(this.checked);
                $("#CAD").hide();
            });
      </script>
  </body>
</html>