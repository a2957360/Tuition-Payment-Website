<?php
    header("Content-Type: text/html; charset=utf8");
    include("static/include/sql.php");
    $resultlist = array();
    unset($_SESSION['PaymentId']);
    if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='outoftime.html'; </script>";
    }
    $userid = $_SESSION['UserId'];
    $stmt = $pdo->prepare("DELETE FROM `student_table` WHERE `UserId`='$userid' AND `FirstName` <=> NULL;");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM `other_table` WHERE `UserId`='$userid' AND `FirstName` <=> NULL");
    $stmt->execute();
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
    $stmt = $pdo->prepare("SELECT * FROM `user_table` WHERE `Id` = '$userid';");
    $stmt->execute();
    if($stmt != null){
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $username=$row['UserName'];
        $phone=$row['Phone'];
        $email=$row['Email'];
      }
    } 
	  $searchmethod = "";
	  $searchdate = "";
	  $searchname = "";
	  $minprice = "";
	  $maxprice = "";

	  $dselect = "selected";
	  $aliselect = "";
	  $wechatselect = "";
	  $unionselect = "";
    if(isset($_POST['searchsubmit'])){
      $searchmethod = $_POST['searchmethod'];
      $searchdate = $_POST['searchdate'];
      $searchname = $_POST['searchname'];
      $minprice = $_POST['minprice'];
      $maxprice = $_POST['maxprice'];

      if($searchmethod === "WECHATPAY"){
	  	$wechatselect = "selected";
      }
      if($searchmethod === "ALIPAY"){
        $aliselect = "selected";
      }
      if($searchmethod === "UNIONPAY"){
        $unionselect = "selected";
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
    <title>Silver Pacific Gyre TradeCenter</title>
<script src="static/js/prefixfree.min.js"></script>

  </head>



  <body >
    <!-- <canvas id="c"></canvas> -->
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row blueback">
        <div class="col-10 m-auto text-center colorblack">
          <h2 class="ud20">订单中心</h2>
          <p  class="aboutDesc">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>
      <div class="row ud20">
        <div class="col"></div>
        <div class="col-lg-2 col-10 text-left personalinfo">
          <div class="row text-center  border personalinfo shadow-lg rounded">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'  class="col-lg-12 col-12 ">
            <h4 class="ud10p">搜索条件</h4>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text pmwidth" id="basic-addon1">付款方式</span>
              </div>
                <select class="custom-select" name="searchmethod" id="inputGroupSelect01">
                  <option <?=$searchname?> value="">Choose...</option>
                  <option <?=$aliselect?> value="ALIPAY">支付宝</option>
                  <option <?=$wechatselect?> value="WECHATPAY">微信支付</option>
                  <option <?=$unionselect?> value="UNIONPAY">银联支付</option>
                </select>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"  id="basic-addon1">从 $</span>
              </div>
              <input type="text" name="minprice" value="<?=$minprice?>" class="form-control"  aria-describedby="basic-addon1">
            <div class="input-group-prepend">
                <span class="input-group-text"  id="basic-addon1">到 $</span>
              </div>
              <input type="text" name="maxprice" value="<?=$maxprice?>" class="form-control"  aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"  id="basic-addon1">名称</span>
              </div>
              <input type="text" name="searchname" value="<?=$searchname?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">日期</span>
              </div>
              <input type="month" class="form-control" value="<?=$searchdate?>" name="searchdate"  aria-label="Username" aria-describedby="basic-addon1">
            </div>
              
            <input class="btn btn-primary btn-lg btncolor text-center"  type="submit" name="searchsubmit" value="搜索">
          </form>
          </div>

        </div>
                  <div class="col"></div>
          
        <div class="col-lg-8 col-12">
          <div class="row scrollablehight">
<!--             <div class="col-lg-12 col-2">
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
            </div> -->
            <div class="col-1 col-lg-12"></div>
          <div class="col-lg-12 col-10">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `house_table` WHERE `UserId` = '$userid' ORDER BY `Date` desc;");
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
                    array_push($resultlist,$row);
                  }
                }
            ?>
            <?php
                $stmt = $pdo->prepare("SELECT * FROM `student_table` WHERE `UserId` = '$userid' ORDER BY `Date` desc;");
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
                    $row['tabletype'] = "student";
                    array_push($resultlist,$row);
                  }
                }
            ?>




            <?php
                $stmt = $pdo->prepare("SELECT * FROM `life_table` WHERE `UserId` = '$userid' ORDER BY `Date` desc;");
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
                        array_push($resultlist,$row);
                    }
                  }

            ?>


          <div class="row " id="list4">

            <?php
                $stmt = $pdo->prepare("SELECT * FROM `other_table` WHERE `UserId` = '$userid' ORDER BY `Date` desc;");
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
                    $row['tabletype'] = "other";
                        array_push($resultlist,$row);
                    }
                  }
                    $keysvalue = $new_array = array();
                    foreach ($resultlist as $k=>$v){
                    $keysvalue[$k] = $v['Date'];
                    }
                    arsort($keysvalue);
                    reset($keysvalue);
                    foreach ($keysvalue as $k=>$v){
                    $new_array[$k] = $resultlist[$k];
                    }
                    $resultlist = $new_array;
              
                foreach ($resultlist as $key => $value) {
                  switch ($value['Status']) {
                      case '0':
                          $statusre = "<p class='colorred  m-auto'>未付款</p>";
                          break;
                      case '1':
                          $statusre = "<p class='colorgreen  m-auto'>已付款</p>";
                          break;
                      case '2':
                          $statusre = "<p class='grey m-auto'>已完成</p>";
                          break;
                  }
                  if($value['Method'] === "WECHATPAY"){
                    $method = "static/img/wechartpay.png";
                  }
                  if($value['Method'] === "ALIPAY"){
                    $method = "static/img/alipaymethod.png";
                  }
                  if($value['Method'] === "UNIONPAY"){
                    $method = "static/img/yinliangmethod.png";
                  }
                 if(strstr( $value['Method'] , $searchmethod ) === false && $searchmethod != ""){
					continue;
                  }
                  if(strstr( $value['Date'] , $searchdate ) === false && $searchdate != ""){
					continue;
                  }
                  if(strstr( $value['SchoolName'] , $searchname ) === false && isset($value['SchoolName']) && $searchname != ""){
					continue;
                  }
                  if(strstr( $value['CompanyName'] , $searchname ) === false && isset($value['CompanyName']) && $searchname != ""){
					continue;
                  }
                if($value['Price'] < (float)$minprice && $minprice != ""){
					continue;
                  }
                if($value['Price'] > (float)$maxprice && $maxprice != ""){
					continue;
                  }
                if($value['tabletype'] === 'student'){
            ?>

            <div class="col-12">
              <div class="row listborder ud10">                
                <div class="col-12 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $value['Date']?></strong></p>
                </div>               
                <div class="col-12 col-lg-4">
                  <p class="nobottom"><strong><?= $value['CompanyName'] ?><?= $value['SchoolName'] ?></strong></p>
                  <?= $statusre ?>
                </div>                
                <div class="col-6 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-6 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto shadow-sm" >CAD<br>$<strong><?= $value['Price'] ?></strong></p>
                </div>
                <div class="col-12 col-lg-2">
                <div class="row">
                <?php
                  if($value['Status'] === '0'){
                ?>
                <form class="col-6 col-lg-12 text-center" action="tuitionconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                  <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="付款">
                </form>
                <form class="col-6 col-lg-12 text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                  <input type="hidden" name="deltable" value="tuition">
                  <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="删除">
                </form>
                <?php
                  }else{
                  ?>
                  <form class="col-6 m-auto text-center" action="tuitionconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                    <input type="hidden" name="check" value="1">
                    <input type="hidden" name="noemail" value="1">
                    <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
                </div>
              </div>
            </div>

            <?php
                }else{
            ?>
              
            <div class="col-12 ">
              <div class="row listborder ud10">                
                <div class="col-12 col-lg-2">
                  <p class="m-auto ud10p grey"><strong><?= $value['Date']?></strong></p>
                </div>               
                <div class="col-12 col-lg-4">
                  <p class="nobottom"><strong><?= $value['CompanyName'] ?><?= $value['SchoolName'] ?></strong></p>
                  <p class="nobottom"><?= $statusre ?></p>
                </div>                
                <div class="col-6 col-lg-2 d-flex">
                  <img class="img-fluid p-2 m-auto" alt="Responsive image" src="<?= $method ?>">
                </div>
                <div class="col-6 col-lg-2 text-right d-flex">
                  <p class="border nobottom lineh m-auto shadow-sm" >CAD<br>$<strong><?= $value['Price'] ?></strong></p>
                </div>
                <div class="col-12 col-lg-2 ">
                <div class="row">
                <?php
                  if($value['Status'] === '0'){
                ?>
                <form class="col-6 col-lg-12 text-center" action="otherconfirm.php" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                  <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="付款">
                </form>
                <form class="col-6 col-lg-12 text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                  <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                  <input type="hidden" name="deltable" value="tuition">
                  <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="删除">
                </form>
                <?php
                  }else{
                  ?>
                  <form class="col-6 m-auto text-center" action="otherconfirm.php" method="POST" enctype='multipart/form-data'>
                    <input type="hidden" name="paymentid" value="<?= $value['Id'] ?>">
                    <input type="hidden" name="check" value="1">
                    <input type="hidden" name="noemail" value="1">
                    <input class="btn btn-primary listbtn btncolor tradebtn" type="submit" name="submit" value="查看">
                  </form>
                <?php
                  } 
                  ?>
                </div>
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