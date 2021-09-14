<?php
    include("static/include/sql.php");
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
         <link rel="stylesheet" href="fontawesome-free-5.11.2-web/css/all.css" >
      <script defer src="fontawesome-free-5.11.2-web/js/all.js"></script>
    <title>Silver Pacific Gyre Help Center</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>
    
      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <h2  class="ud20">帮助中心</h2>
          <p class="aboutDesc ">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
              实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
              有时会略低于/高于中国银行外汇卖出价。 
          </p>
        </div>
      </div>

      <div class="row text-center ud50">
        <div class="col-10 m-auto">
          <div class="row">
          <div class="col-lg-3 col-12 border rounded ud20 shadow-lg">
            <a class="helpTitle" href="./payment_reference.php" style="text-decoration:none;">
            <img class="img-fluid" alt="Responsive image" src="static/img/acounticon.png">
            <p class="payTitle">国内信用卡使用方法</p>
            <p class="payDetail">Payment Limit Solution</p>
            </a>
          </div>
            <div class="col-12 col-lg ud10"> </div>
          <div class="col-lg-3 col-12 border rounded ud20 shadow-lg">
            <a href="./alipay_reference.php" style="text-decoration:none;" >
            <img class="img-fluid" alt="Responsive image" src="static/img/alipayicon.png">
            <p class="payTitle">支付宝绑定银联卡限额参考表</p>
            <p class="payDetail">Tuition fee payment Alipay limit reference form</p>
            </a>
          </div>
            <div class="col-12 col-lg ud10"> </div>
          <div class="col-lg-3 col-12 border rounded ud20 shadow-lg">
            <a href="./wechat_reference.php" style="text-decoration:none;">
            <img class="img-fluid" alt="Responsive image" src="static/img/wechaticon.png">
            <p class="payTitle">微信支付限额参考表</p>
            <p class="payDetail">Wechat Payment Quota Reference Table</p>
            </a>
          </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-lg-8 col-10 m-auto">
      <div class="row">
        <div class="col-lg-6 col-12">
            <img class="img-fluid" alt="Responsive image" src="static/img/midrow1.png">
        </div>

        <div class="col-lg-6 col-12">

          <div class="ud50">
          <p class="text-left">安心支付 学费不耽误</p>
          <p class="text-left">Pay tuition without delay</p>
          <p class="text-left">银流支付致力于为海外华人提供最实惠的支付服务，为与支付宝，微信及中国银联的长期合作伙伴，<br>powered by Silver Pacific Gyre Ltd.是由加拿大金融交易与报告分析中心授权（FINTRACT）的货币服务机构。
          莘莘学子。</p>
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