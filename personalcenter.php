<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    $resultlist = array();
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    if(isset($_POST['delsubmit'])){
      $id = $_POST['id'];
        if(isset($_POST['for']) && $_POST['for'] != ""){
            $stmt = $pdo->prepare("DELETE FROM `payschool_table` WHERE `Id`='$id';");
            $stmt->execute();
        }else{
            $stmt = $pdo->prepare("DELETE FROM `paymercant_table` WHERE `Id`='$id';");
            $stmt->execute();
        }

    }
    if(isset($_POST['personsubmit'])){
      $userid = $_SESSION['UserId'];
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $stmt = $pdo->prepare("UPDATE `user_table` SET `FirstName` = '$firstname', `LastName` ='$lastname', `Phone` = '$phone', `Email` = '$email' WHERE `Id`='$userid';");
      $stmt->execute();
        if($stmt != null){
        }else{
        }
    }
    if(isset($_POST['schoolsubmit'])){
      $userid = $_SESSION['UserId'];
      $schoolname = $_POST['schoolname'];
      $address = $_POST['address'];
      $studentno = $_POST['studentno'];
      $sfirstname = $_POST['sfirstname'];
      $slastname = $_POST['slastname'];
      $birthday = $_POST['birthday'];
      $currency = $_POST['currency'];

      $stmt = $pdo->prepare("INSERT INTO `payschool_table`(`USDorCAD`,`SchoolName`, `SchoolAddress`, `StudentNo`, `StudentFirstName`, `StudentLastName`, `Birthday`, `UserId`) VALUES ('$currency','$schoolname','$address','$studentno','$sfirstname','$slastname','$birthday','$userid');");
      $stmt->execute();
        if($stmt != null){
            if(isset($_POST['paypagesubmit'])){
                echo "<script> location.href='tutioninfo.php'; </script>";
            }
            echo "<script> location.href='personalcenter.php'; </script>";
        }else{

        }
    }
    if(isset($_POST['schoolpaypagesubmit'])){
      $userid = $_SESSION['UserId'];
      $schoolname = $_POST['schoolname'];
      $address = $_POST['address'];
      $studentno = $_POST['studentno'];
      $sfirstname = $_POST['sfirstname'];
      $slastname = $_POST['slastname'];
      $birthday = $_POST['birthday'];
      $currency = $_POST['currency'];

      $stmt = $pdo->prepare("INSERT INTO `payschool_table`(`USDorCAD`,`SchoolName`, `SchoolAddress`, `StudentNo`, `StudentFirstName`, `StudentLastName`, `Birthday`, `UserId`) VALUES ('$currency','$schoolname','$address','$studentno','$sfirstname','$slastname','$birthday','$userid');");
      $stmt->execute();
        if($stmt != null){
            echo "<script> location.href='tutioninfo.php'; </script>";
        }else{

        }
    }
    if(isset($_POST['mercantsubmit'])){
      $userid = $_SESSION['UserId'];
      $companyname = $_POST['companyname'];
      $address = $_POST['address'];
      $accountno = $_POST['accountno'];
      $memo = $_POST['memo'];
      $currency = $_POST['currency'];
        
      $stmt = $pdo->prepare("INSERT INTO `paymercant_table`(`USDorCAD`,`CompanyName`, `CompanyAddress`, `AccountNo`, `Memo`, `UserId`) VALUES ('$currency','$companyname','$address','$accountno','$memo','$userid');");
      $stmt->execute();
        if($stmt != null){
            echo "<script> location.href='personalcenter.php'; </script>";
        }else{

        }
    }
    if(isset($_POST['mercantpaypagesubmit'])){
      $userid = $_SESSION['UserId'];
      $companyname = $_POST['companyname'];
      $address = $_POST['address'];
      $accountno = $_POST['accountno'];
      $memo = $_POST['memo'];
      $currency = $_POST['currency'];
        
      $stmt = $pdo->prepare("INSERT INTO `paymercant_table`(`USDorCAD`,`CompanyName`, `CompanyAddress`, `AccountNo`, `Memo`, `UserId`) VALUES ('$currency','$companyname','$address','$accountno','$memo','$userid');");
      $stmt->execute();
        if($stmt != null){
            echo "<script> location.href='otherinfo.php'; </script>";
        }else{

        }
    }
    $userid = $_SESSION['UserId'];
    echo $_SESSION['UserId'];
    $stmt = $pdo->prepare("SELECT * FROM `user_table` WHERE `Id` = '$userid';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $firstname=$row['FirstName'];
        $lastname=$row['LastName'];
        $phone=$row['Phone'];
        $email=$row['Email'];
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
<!--      <link rel="stylesheet" type="text/css" href="static/layui/css/layui.mobile.css"/>-->
     <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all"> 
    <title>Silver Pacific Gyre PersonalCenter</title>
<script src="static/js/prefixfree.min.js"></script>
<script src="./static/layui/layui.all.js"></script>

  </head>



  <body >
    <!-- <canvas id="c"></canvas> -->
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center   colorblack">
          <h2 class="ud20">个人中心</h2>
          <p  class="aboutDesc">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>
      <div class="row ud20">
        <div class="col-1"></div>
        <div class="col-lg-3 col-10 text-left  personalinfo  ">
          <div class="row border pb10 shadow-lg rounded">
        <div class="col-12 ">
        <h4 class="ud10">您的信息</h4>
        </div>
        <div class="col-12">
<!--            <div class="custom-control custom-checkbox">-->
<!--            <input type="checkbox" class="custom-control-input"  onclick="defaultinfo()" id="customCheck1">-->
<!--            <label class="custom-control-label" for="customCheck1">修改个人信息</label>-->
<!--          </div>-->
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'  class="col-lg-12 col-12 ">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
                
            <span class="input-group-text"  id="basic-addon1">姓</span>
          </div>
          <input type="text" id="lastname" name="lastname" value="<?=$lastname?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" >
        </div>
     
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"  id="basic-addon1">名</span>
          </div>
          <input type="text" id="firstname" name="firstname" value="<?=$firstname?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" >
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"  id="basic-addon1">邮箱</span>
          </div>
          <input type="text" id="email" name="email" value="<?=$email?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" >
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"  id="basic-addon1">电话</span>
          </div>
          <input type="text" id="phone" name="phone" value="<?=$phone?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" >
        </div>
        <input class="btn btn-outline-primary float-right" id="changebtn"  type="submit" name="personsubmit" value="修改个人信息" >
        </form>

          <div class="col-12 ud10p"> </div>
          <form class="col-lg-12 col-12" action="changepassword.php" method="POST" enctype='multipart/form-data'>
            <input class="btn btn-outline-primary float-right" type="submit" name="" value="修改密码">
          </form>
          </div>

        </div>
<!--          <div class="col-1"></div>-->
        <div class="col-lg-8 col-12">
             <h4 class="centerTitle">收款方管理</h4>
            <p class="centerTitle">温馨提示，请核对好所有信息</p>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-lg-4 col-10 border rounded mgb20">
                    <form style="padding-left:10px;" class="row  ud10" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                        <div class="col-12  ud10p">
                          <h4>学校信息</h4>
                        </div>
                        <div class="col-12 noPaddingLeft ">
                            <div class="row">
                                <div class="col-6 ">
                                   <label class="chooseCurrency">CAD
                                      <input type="radio" checked="checked" name="currency" value="CAD">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 ">
                                     <label class="chooseCurrency">USD
                                      <input type="radio" name="currency" value="USD">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 noPaddingLeft ">
                          <p><span class="colorred">*</span>学校名称:</p>
                          <input class="wide-80 form-control" pattern="[a-zA-Z0-9 ]{0,50}" type="text" name="schoolname" required autofocus>
                        </div>
                        <div class="col-12 noPaddingLeft ">
                          <p><span class="colorred">*</span>学校地址:</p>
                          <input class="wide-80 form-control"  type="text" name="address" required>
                        </div>
                        <div class="col-12 noPaddingLeft">
                          <p><span class="colorred">*</span>学号/student number</p>
                          <input class="wide-80 form-control" maxlength="20" type="text" name="studentno" required>
                        </div> 
                        <div class="col-12 noPaddingLeft ud10p">
                          <h4>学生信息</h4>
                        </div>

                        <div class="col-12 noPaddingLeft">
                          <p><span class="colorred">*</span>名（拼音）:</p>
                          <input class="wide-80 form-control" pattern="[a-zA-Z]{0,20}" type="text" name="sfirstname" required autofocus="">
                        </div>

                        <div class="col-12 noPaddingLeft">
                          <p><span  class="colorred">*</span>姓（拼音）:</p>
                          <input class="wide-80 form-control" pattern="[a-zA-Z]{0,10}" type="text" name="slastname"required>
                        </div>
                        <div class="col-12 noPaddingLeft">
                          <p><span  class="colorred">*</span>出生日期:</p>
                          <input  class="wide-80 form-control" type="date" name="birthday" required>
                        </div>  
                        <div class="col-12 ud10"></div>
                        <div class="col-6 col-md-12 col-lg-6 ">
                            <?php
                            if(isset($_SESSION["Method"])){
                                echo '<input class="btn btn-outline-primary returnpaybtn" type="submit" name="schoolpaypagesubmit" value="去付款" >';
                            }
                            ?>
                        </div>  
                        <div class="col-12 col-md-12 col-lg-6 moboleu">
                        <input class="btn btn-outline-primary" type="submit" name="schoolsubmit" value="添加学校付款方" >
                        </div>  

                    </form>
                </div>
                <div class="col-1"></div>
                 <div class="space1"></div>
                <div class="col-lg-4 col-10 border  rounded mgb20">
                    <form  style="padding-left:10px;" class="row  ud10" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                        <div class="col-12  ud10p ">
                          <h4>企业信息</h4>
                        </div>
                        <div class="col-12 noPaddingLeft ">
                            <div class="row">
                                <div class="col-6 ">
<!--
                                    <div class="chooseCurrency"> 
                                      <input type="radio" name="currency" value="CAD" checked/> CAD
                                        <img id="rightimg" class="img-fluid" alt="Responsive image" src="static/img/CAD.png">
                                        
                                    </div> 
-->
                                    <label class="chooseCurrency">CAD
                                      <input type="radio" checked="checked" name="currency" value="CAD">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-6 ">
<!--
                                    <label class="radioimg">
                                      <input type="radio" name="currency" value="USD" />
                                        USD
                                        <img id="leftimg" class="img-fluid" alt="Responsive image" src="static/img/USD.png">
                                    </label>
-->
                                     <label class="chooseCurrency">USD
                                      <input type="radio" name="currency" value="USD">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 noPaddingLeft">
                          <p><span class="colorred">*</span>公司名字全称:</p>
                          <input class="wide-80 form-control" pattern="[a-zA-Z0-9 ]{0,50}" type="text" name="companyname" required autofocus>
                        </div>

                        <div class="col-12 noPaddingLeft">
                          <p>公司地址:</p>
                          <input class="wide-80 form-control"  type="text" name="address" >
                        </div>
                        <div class="col-12 noPaddingLeft">
                          <p>支付号/account number：</p>
                          <input class="wide-80 form-control" type="text" name="accountno">
                        </div>    
                        <div class="col-12 noPaddingLeft">
                          <p>备注/memo：</p>
                          <input class="wide-80 form-control" maxlength="20" type="text" name="memo">
                        </div>  
                        <div class="col-12 ud10"></div>
                        <div class="col-6 col-md-12 col-lg-6 ">
                        <?php
                            if(isset($_SESSION["Method"])){
                                echo '<input class="btn btn-outline-primary returnpaybtn" type="submit" name="mercantpaypagesubmit" value="去付款" >';
                            }
                        ?>
                        </div>  
                        <div class="col-12 col-md-12 col-lg-6 moboleu">
                        <input class="btn btn-outline-primary" type="submit" name="mercantsubmit" value="添加企业付款方" >
                        </div>  

                    </form>
                </div>
                        </div>

<!--
            <div class="row ud10p mgb20">
                <div class="col-10 m-auto noPaddingLeft">
                <a class="btn btn-outline-primary paybtn  " href="index.php">去付款</a>
                </div>
            </div>
-->
          <div class="row ">
            <div class="col-1 col-lg-1"></div>
          <div class="col-lg-9 col-10 pb10 scrollablehight">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `payschool_table` WHERE `UserId` = '$userid';");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      $row['tyep'] = 0;
                    array_push($resultlist,$row);
                  }
                }
                $stmt = $pdo->prepare("SELECT * FROM `paymercant_table` WHERE `UserId` = '$userid';");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $row['tyep'] = 1;
                    array_push($resultlist,$row);
                  }
                }
            ?>
            <?php
                foreach ($resultlist as $key => $value) {
                    switch($value["USDorCAD"]){
                        case 'USD':
                            $value["USDorCAD"]="美元 USD";
                            break;
                        case 'CAD':
                            $value["USDorCAD"]="加元 CAD";
                            break;
                    }
            ?>
            <form class="row  listborder ud10 border shadow-sm mgb10 rounded padding10" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="col-10 col-lg-10">
                    <div class="row nomargin">
                        <div class="col-12 col-lg-12">
                            <h4 style="display:inline-block"><?=$value['SchoolName']?><?=$value['CompanyName']?></h4>
<!--                            <p class="grey" style="display:inline-block"><?=$value['CompanyAbb']?></p>-->
                        </div> 
                        <div class="col-6 col-lg-6">
                            <p>地址 ： <?=$value['SchoolAddress']?><?=$value['CompanyAddress']?></p>
                        </div>    
                        <?php

                            if($value["AccountNo"] == ""){
                                $value["AccountNo"] = "无";
                            }
                            if($value['tyep'] === 0){
                                echo '<div class="col-6 col-lg-6">
                                        <p>Student No： '.$value["StudentNo"].'</p>
                                    </div>';
                            }else{
                                    echo '<div class="col-6 col-lg-6">
                                        <p>Account No： '.$value["AccountNo"].'</p>
                                    </div>';
                            }
                        ?>

<!--
                        <div class="col-6 col-lg-6">
                            <p>Account No： <?=$value['StudentNo']?><?=$value['AccountNo']?></p>
                        </div>
-->

                        <div class="col-6 col-lg-6">
                            <p><?=$value['StudentFirstName']?> <?=$value['StudentLastName']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p><?=$value['Birthday']?></p>
                        </div>
                        <div class="col-6 col-lg-6">
                            <p><?=$value['USDorCAD']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <input type="hidden" name="id" value="<?=$value['Id']?>">
                    <input type="hidden" name="for" value="<?=$value['Birthday']?>">
                <input class="btn btn-outline-primary float-right vmid" type="submit" name="delsubmit" value="删除" >
                </div>  
              </form>

            <?php
                } 
            ?>

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

<script src="static/js/index.js"></script>
    <script type="text/javascript">
      function defaultinfo(){
        if($("#customCheck1").prop('checked')){
          $("#firstname").removeAttr('disabled');
          $("#lastname").removeAttr('disabled');
          $("#phone").removeAttr('disabled');
          $("#email").removeAttr('disabled');
          $("#changebtn").removeAttr('disabled');
        }else{
          $("#firstname").val("<?=$firstname?>");
          $("#lastname").val("<?=$lastname?>") ;
          $("#phone").val("<?=$phone?>");
          $("#email").val("<?=$email?>");
          $("#firstname").attr('disabled','disabled');
          $("#lastname").attr('disabled','disabled');
          $("#phone").attr('disabled','disabled');
          $("#email").attr('disabled','disabled');
          $("#changebtn").attr('disabled','disabled');

        }
      }
    </script>
  </body>
</html>