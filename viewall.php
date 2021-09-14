<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    if(isset($_POST['deltable'])){
      $detlable = $_POST['deltable'];
      $paymentid = $_POST['paymentid'];
      switch ($detlable) {
        case 'tuition':
            $stmt = $pdo->prepare("DELETE FROM `student_table` WHERE `Id`='$paymentid';");
            break;
        case 'life':
            $stmt = $pdo->prepare("DELETE FROM `life_table` WHERE  `Id`='$paymentid';");
            break;
        case 'house':
            $stmt = $pdo->prepare("DELETE FROM `house_table` WHERE `Id`='$paymentid';");
            break;
        case 'other':
            $stmt = $pdo->prepare("DELETE FROM `other_table` WHERE `Id`='$paymentid';");
            break;
      }
      $stmt->execute();
    }
    $userid = $_SESSION['UserId'];
    $stmt = $pdo->prepare("SELECT * FROM `user_table` WHERE `Id` = '$userid';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $username=$row['UserName'];
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
    <title>AliCanada PoweredByFineStufio</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <h1 class="ud20">个人中心</h1>
          <p  class="ud20">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>
      <div class="row ud20">
        <div class="col"></div>
        <div class="col-lg-3 col-12 text-left greybg border personalinfo">
          <div class="row">
         <div class="col-lg-12 col-6 ">
            <h5>邮箱：<br> <?= $email ?></h5>
          </div>
          <div class="col-lg-12 col-5 ">
            <h5>电话：<br> <?= $phone ?></h5>
          </div>
          <div class="col ud10p"></div>
          <form class="col-lg-12 col-2" action="changepassword.php" method="POST" enctype='multipart/form-data'>
            <input class="btn btn-primary btn-lg btncolor " type="submit" name="" value="修改密码">
          </form>
          </div>
        </div>
        <div class="col-lg-8 col-12">
          <div class="row">
            <div class="col-lg-12 col-2">
            <div class="row">
              <button type="button" class="col-lg-2 col-12 btnswitch btn btn-primary btncolor" data-toggle="collapse " 
                  data-target="#list1" onclick="hidea1()">
                  房租汇款
              </button>  
              <button type="button" class="col-lg-2 col-12 btnswitch btn btn-primary btncolor" data-toggle="collapse" 
                  data-target="#list2" onclick="hideall(2)">
                  学费汇款
              </button>  
              <button type="button" class="col-lg-2 col-12 btnswitch btn btn-primary btncolor" data-toggle="collapse" 
                  data-target="#list3" onclick="hideall(3)">
                  生活费汇款
              </button>  
              <button type="button" class="col-lg-2 col-12 btnswitch btn btn-primary btncolor" data-toggle="collapse" 
                  data-target="#list4" onclick="hideall(4)">
                  其他汇款
              </button>  
            </div>
            </div>
            <div class="col-1 col-lg-12"></div>
          <div class="col-lg-12 col-9">
          <div class="row collapse pre-scrollable" id="list1">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `house_table` ORDER BY `Date` AND `Status`;");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $method=$row['Method'];
                    $companyname=$row['CompanyName'];
                    $price=$row['Price'];
                    $date=$row['Date'];
                    $orderno=$row['OrderNo'];
                    $status=$row['Status'];
                    $paymentid=$row['Id'];

                    switch ($status) {
                        case 0:
                            $statusre = "<p class='colorred  m-auto'>未付款</p>";
                            break;
                        case 1:
                            $statusre = "<p class='colorgreen  m-auto'>已付款</p>";
                            break;
                        case 2:
                            $statusre = "<p class='grey m-auto'>已完成</p>";
                            break;
                    }
                    if($method === "WECHATPAY"){
                      $method = "static/img/wechartpay.png";
                    }
                    if($method === "ALIPAY"){
                      $method = "static/img/alipaymethod.png";
                    }
                    if($method === "UNIONPAY"){
                      $method = "static/img/yinliangmethod.png";
                    }
            ?>
            <div class="col-12 ">
              <div class="row listborder ud10">                
                <div class="col-2 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $date?></strong></p>
                </div>               
                <div class="col-4 col-lg-4">
                  <p class="nobottom"><strong><?= $companyname ?></strong></p>
                  <p class="nobottom"><?= $statusre ?></p>
                </div>                
                <div class="col-2 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-2 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto" >CAD<br>$<strong><?= $price ?></strong></p>
                </div>
                <div class="col-1 col-lg-2">
                <?php
                  if($status === '1'){
                ?>
                <form class="col-12" action="houseconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="付款">
                </form>
                <form class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input type="hidden" name="deltable" value="house">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="删除" onclick="check()">
                </form>
                <?php
                  }else{
                  ?>
                  <form class="col-12 m-auto" action="houseconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                    <input type="hidden" name="check" value="1">
                    <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
              </div>
            </div>

            <?php
                  }
                } 
            ?>
          </div>

          <div class="row collapse pre-scrollable" id="list2">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `student_table` ORDER BY `Date` AND `Status`;");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $method=$row['Method'];
                    $companyname=$row['SchoolName'];
                    $price=$row['Price'];
                    $date=$row['Date'];
                    $orderno=$row['OrderNo'];
                    $status=$row['Status'];
                    $paymentid=$row['Id'];
                    switch ($status) {
                        case 0:
                            $statusre = "<p class='colorred  m-auto'>未付款</p>";
                            break;
                        case 1:
                            $statusre = "<p class='colorgreen  m-auto'>已付款</p>";
                            break;
                        case 2:
                            $statusre = "<p class='grey m-auto'>已完成</p>";
                            break;
                    }
                    if($method === "WECHATPAY"){
                      $method = "static/img/wechartpay.png";
                    }
                    if($method === "ALIPAY"){
                      $method = "static/img/alipaymethod.png";
                    }
                    if($method === "UNIONPAY"){
                      $method = "static/img/yinliangmethod.png";
                    }
            ?>

            <div class="col-12 ">
              <div class="row listborder ud10">                
                <div class="col-2 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $date?></strong></p>
                </div>               
                <div class="col-4 col-lg-4">
                  <p class="nobottom"><strong><?= $companyname ?></strong></p>
                  <p class="nobottom"><?= $statusre ?></p>
                </div>                
                <div class="col-2 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-2 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto" >CAD<br>$<strong><?= $price ?></strong></p>
                </div>
                <div class="col-1 col-lg-2">
                <?php
                  if($status === '0'){
                ?>
                <form class="col-12" action="tuitionconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="付款">
                </form>
                <form class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input type="hidden" name="deltable" value="tuition">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="删除">
                </form>
                <?php
                  }else{
                  ?>
                  <form class="col-12 m-auto" action="tuitionconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                    <input type="hidden" name="check" value="1">
                    <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
              </div>
            </div>

            <?php
                  }
                } 
            ?>
          </div>

          <div class="row collapse pre-scrollable" id="list3">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `life_table` ORDER BY `Date` AND `Status`;");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $method=$row['Method'];
                    $companyname=$row['CompanyName'];
                    $price=$row['Price'];
                    $date=$row['Date'];
                    $orderno=$row['OrderNo'];
                    $status=$row['Status'];
                    $paymentid=$row['Id'];
                    switch ($status) {
                        case 0:
                            $statusre = "<p class='colorred  m-auto'>未付款</p>";
                            break;
                        case 1:
                            $statusre = "<p class='colorgreen  m-auto'>已付款</p>";
                            break;
                        case 2:
                            $statusre = "<p class='grey m-auto'>已完成</p>";
                            break;
                    }
                    if($method === "WECHATPAY"){
                      $method = "static/img/wechartpay.png";
                    }
                    if($method === "ALIPAY"){
                      $method = "static/img/alipaymethod.png";
                    }
                    if($method === "UNIONPAY"){
                      $method = "static/img/yinliangmethod.png";
                    }
            ?>

            <div class="col-12 ">
              <div class="row listborder ud10">                
                <div class="col-2 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $date?></strong></p>
                </div>               
                <div class="col-4 col-lg-4">
                  <p class="nobottom"><strong><?= $companyname ?></strong></p>
                  <p class="nobottom"><?= $statusre ?></p>
                </div>                
                <div class="col-2 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-2 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto" >CAD<br>$<strong><?= $price ?></strong></p>
                </div>
                <div class="col-1 col-lg-2">
                <?php
                  if($status === '0'){
                ?>
                <form class="col-12" action="lifefeeconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="付款">
                </form>
                <form class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input type="hidden" name="deltable" value="life">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="删除">
                </form>
                                <?php
                  }else{
                  ?>
                  <form class="col-12 m-auto" action="lifefeeconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                    <input type="hidden" name="check" value="1">
                    <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
              </div>
            </div>

            <?php
                  }
                } 
            ?>
          </div>

          <div class="row collapse pre-scrollable" id="list4">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `other_table` ORDER BY `Date` AND `Status`;");
                $stmt->execute();
                if($stmt != null){
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $method=$row['Method'];
                    $companyname=$row['CompanyName'];
                    $price=$row['Price'];
                    $date=$row['Date'];
                    $orderno=$row['OrderNo'];
                    $status=$row['Status'];
                    $paymentid=$row['Id'];
                    switch ($status) {
                        case 0:
                            $statusre = "<p class='colorred  m-auto'>未付款</p>";
                            break;
                        case 1:
                            $statusre = "<p class='colorgreen  m-auto'>已付款</p>";
                            break;
                        case 2:
                            $statusre = "<p class='grey m-auto'>已完成</p>";
                            break;
                    }
                    if($method === "WECHATPAY"){
                      $method = "static/img/wechartpay.png";
                    }
                    if($method === "ALIPAY"){
                      $method = "static/img/alipaymethod.png";
                    }
                    if($method === "UNIONPAY"){
                      $method = "static/img/yinliangmethod.png";
                    }
            ?>

            <div class="col-12 ">
              <div class="row listborder ud10">                
                <div class="col-2 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $date?></strong></p>
                </div>               
                <div class="col-4 col-lg-4">
                  <p class="nobottom"><strong><?= $companyname ?></strong></p>
                  <p class="nobottom"><?= $statusre ?></p>
                </div>                
                <div class="col-2 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-2 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto" >CAD<br>$<strong><?= $price ?></strong></p>
                </div>
                <div class="col-1 col-lg-2">
                <?php
                  if($status === '0'){
                ?>
                <form class="col-12" action="otherconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="付款">
                </form>
                <form class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                  <input type="hidden" name="deltable" value="other">
                  <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="删除">
                </form>
                <?php
                  }else{
                  ?>
                  <form class="col-12 m-auto" action="otherconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $paymentid ?>">
                    <input type="hidden" name="check" value="1">
                    <input class="btn btn-primary listbtn btncolor" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
              </div>
            </div>

            <?php
                  }
                } 
            ?>
          </div>

            </div>
          </div>
        </div>
      </div>

      <?php include("footer.php")?>
      <div class="row footer text-center ">
        <div class="col-12 m-auto">
          <p>@ 2019 Alexander International Ltd. All rights reserved.</p>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function hideall(name) {
      $('#list1').collapse('hide');
      $('#list2').collapse('hide');
      $('#list3').collapse('hide');
      $('#list4').collapse('hide');
      $('#list'.name).collapse('show');
      }
      function hidea1() {
      $('#list1').collapse('hide');
      $('#list2').collapse('hide');
      $('#list3').collapse('hide');
      $('#list4').collapse('hide');
      $('#list1').collapse('show');
      }
      function showlist1(){
      $('#list1').collapse('show');
      }
      showlist1();
    </script>
  </body>
</html>