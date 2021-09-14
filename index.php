<?php 
include("static/include/sql.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $method=$_POST['method'];
  $_SESSION["Method"] = $method;
  $leadtopage = $_POST['payreason'];
  if(!isset($_SESSION["UserName"])){
      echo "<script> location.href='login.php'; </script>";
  }
  if($leadtopage === 'tuition'){
        echo "<script> location.href='tuitioninfo.php'; </script>";
  }else if($leadtopage === 'lifefee'){
        echo "<script> location.href='lifefeeinfo.php'; </script>";
  }else if($leadtopage === 'rentfee'){
        echo "<script> location.href='houseinfo.php'; </script>";
  }else if($leadtopage === 'other'){
        echo "<script> location.href='otherinfo.php'; </script>";
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
         <link rel="stylesheet" href="fontawesome-free-5.11.2-web/css/all.css" >
      <script defer src="fontawesome-free-5.11.2-web/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/style.css"/>
    <title>Silver Pacific Gyre Front Page</title>
  </head>

  <body>
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row indexbg">
        <div class="col-2"></div>
<!--
        <div class="col-4  m-auto text-left">
          <h1 class="ud10p"><span><strong><em>3 </em></strong></span> 步</h1>
          <h4 class="ud10p">国 际 账 单 轻 松 付</h4>
          <p class=""><h4>为全球华人服务</h4></p>
        </div>
-->
        <div class="col-6"></div>
      </div>

      <div class="row">
        <div class="col-10 m-auto">

          <div class="row ud40">
            <div class="col-12 col-lg-8 m-auto text-center">
                <h4><strong>国际支付，就是这么简单</strong></h4>
              <hr class="line">
              <p>Silver Gyre pay, make your life easier</p>
            </div>
          </div>

          <div class="row ud20">

            <div class="col-lg-6 text-center col-12 ">
                <img class="img-fluid" alt="Responsive image" src="static/img/midrow1.png">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4 col-12 border frame shadow-pay paypart">
            <form id="fform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="row text-center">
                  <div style="padding:0" class="col-lg-6 col-6">
                    <label class="radioimg">
                      <input type="radio" name="payreason" value="tuition" checked />
                    <img id="leftimg" class="img-fluid" alt="Responsive image" src="static/img/school.png">
                    </label>
<!--                    <input class="typeradio" type="radio" name="payreason" value="tuition" checked><p>向学校付款</p>-->
                  </div>
<!--
                  <div class="col-lg-3 col-6 ud20">
                    <input type="radio" name="payreason" value="lifefee" >交生活费
                  </div>
                  <div class="col-lg-3 col-6 ud20">
                    <input type="radio" name="payreason" value="rentfee" >交房租
                  </div>
-->
                  <div style="padding:0" class="col-lg-6 col-6">
                    <label class="radioimg">
                      <input type="radio" name="payreason" value="other" />
                    <img id="rightimg" class="img-fluid" alt="Responsive image" src="static/img/company.png">
                    </label>
<!--                    <input class="typeradio" type="radio" name="payreason" value="other" ><p>向企业付款</p>-->
                  </div>
                </div>

<!--            <p class="text-center ud20">请选择需要支付的机构</p>-->
<!--                <p class="text-center ud20"></p>-->
            <div class="col-12 ud40">
              <div class="row">
                <div class="col-lg-2 col-md-2 col-2"></div>
                <label class="col-8 col-lg-8 col-md-8 alignCenter">
                  <input class="text-left" type="radio" name="method" value="ALIPAY" form="fform" required="">
                  <img class=" payicon img-fluid text-right" alt="Responsive image"  src="static/img/alipaymethod.png">
                </label>
                  <div class="col-lg-2 col-md-2 col-2"></div>
                <div class="col-lg-2 col-md-2 col-2"></div>
                <label class="col-8 col-lg-8 col-md-8 alignCenter">
                  <input class="text-left" type="radio" name="method" value="WECHATPAY" form="fform">
                  <img class=" payicon img-fluid " alt="Responsive image"  src="static/img/wechatmethod.png">
                </label>
                   <div class="col-lg-2 col-md-2 col-2"></div>
                <div class="col-lg-2 col-md-2 col-2"></div>
                <label class="col-8 col-lg-8 col-md-8 alignCenter">
                  <input class="text-left" type="radio" name="method" value="UNIONPAY" form="fform">
                  <img class=" payicon img-fluid" alt="Responsive image"  src="static/img/yinliangmethod.png">
                </label>
                   <div class="col-lg-2 col-md-2 col-2"></div>
              </div>
            </div>

            <div class="row ud20">
              <div class="col-10 m-auto">
              <input class="btn btn-primary btn-lg btn-block btncolor" type="submit" name="submit" value="提交">
              </div>
            </div>
          </form>


            </div>

          </div>
            
        <div class="row ud20">
        <div class="col-lg-6 col-12 ">
            <h4 class="text-left bold">我们能付什么</h4>
<!--            <p class="text-left grey">Almost Everything</p>-->
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">学费</h5>
                <p class="grey">大学/中学/小学</p>
            </div>
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">汽车</h5>
                <p class="grey">现款/购买/长租</p>
            </div>            
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">居住</h5>
                <p class="grey">租金/押金</p>
            </div>            
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">政府</h5>
                <p class="grey">税务/罚款/缴费</p>
            </div>            
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">生活费用</h5>
                <p class="grey">水费/电费/天然气</p>
            </div>            
            <div class="col-12 noPaddingLeft">
                <img src="static/img/check-box.svg" class="checkBOX">
                <h5 class="serviceTitle">信用卡</h5>
                <p class="grey">Visa/MasterCard/AMEX</p>
            </div>          
                   
          
            </div>
            <div class="col-lg-6 text-center col-12 m-auto">
                <img class="img-fluid" alt="Responsive image" src="static/img/homeG1.gif">
            </div>
          </div>

          <div class="row ud40">
            <div class="col-12 col-lg-8 m-auto text-center">
              <h4>简单三步，在家轻松完成付款</h4>
              <hr class="line">
              <p>Simple three-step, easy payment at home</p>
            </div>
          </div>

          <div class="row text-center ">
            <div class="col-12 col-lg-3 rounded">
              <img class="img-fluid" alt="Responsive image" src="static/img/midrow2l.png">
              <h5 class="stepsTitle">1.告诉我们你想付给谁</h5>
              <p class="stepDetails">注册一个账户，输入金额，收款方信息，选择你的付款方式。</p>
            </div>
            <div class="col-12 col-lg ud10"> </div>
            <div class="col-12 col-lg-3  rounded">
              <img class="img-fluid" alt="Responsive image" src="static/img/midrow2m.png">
              <h5 class="stepsTitle">2.我们从你的卡里扣款</h5>
              <p class="stepDetails">银流宝支持微信，支付宝，银行卡等付款方式。我们每笔收取2.5%或更低的手续费</p>
            </div>
            <div class="col-12 col-lg  ud10"></div>
            <div class="col-12 col-lg-3  rounded">
              <img class="img-fluid" alt="Responsive image" src="static/img/midrow2r.png">
              <h5 class="stepsTitle">3. 对方收到款项</h5>
              <p class="stepDetails">您选择的收款方会通过支票或银行转账收到他们的款项，并且不需要在银流宝上注册</p>
            </div>
          </div>

          <div class="row ud40">
            <div class="col-12 col-lg-8 m-auto text-center">
              <h4>关于银流支付</h4>
              <hr class="line">
              <p>About us</p>
              <p class=" aboutUsDetail">银流支付致力于为海外华人提供最实惠的支付服务，为与支付宝，微信及中国银联的长期合作伙伴，powered by Silver Pacific Gyre Ltd.是由加拿大金融交易与报告分析中心授权（FINTRACT）的货币服务机构。</p>
            </div>
          </div>

          <div class="row text-center d80">
            <div class="col-12 col-lg-3 shadow-lg p-3 mb-5 bg-white rounded">
            <img class="payIcon" src="static/img/global2.gif">
              <h5 class="payTitle">全球商户</h5>
              <p class="payDetail">与全球数百所知名学校和企业合作，支持全类别付款，没有付不到，只有想不出</p>
            </div>
            <div class="col-12 col-lg ud10"> </div>
            <div class="col-12 col-lg-3 shadow-lg p-3 mb-5 bg-white rounded">
                <img class="payIcon" src="static/img/currency.gif">
              <h5 class="payTitle">安全快捷，资金保障</h5>
              <p class="payDetail">无任何手续与审核，银流支付由加拿大政府，金融管理中心与加拿大反洗钱中心和支付合作伙伴四方监管，支付有保障</p>
            </div>
            <div class="col-12 col-lg ud10"> </div>
            <div class="col-12 col-lg-3 shadow-lg p-3 mb-5 bg-white rounded">
                <img class="payIcon" src="static/img/pay.gif">
              <h5 class="payTitle">无限额支付</h5>
              <p class="payDetail">不占用中国公民外汇额度，提供大额第三方支付方式，为您的资金流动加速</p>
            </div>
          </div>

        </div>
      </div>

    <?php include("footer.php");    ?>
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