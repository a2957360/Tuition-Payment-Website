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
    <title>Silver Pacific Gyre PoweredByFineStufio</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>
    
      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <h2 class="ud20">联系中心</h2>
          <p class="aboutDesc">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
              实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
              有时会略低于/高于中国银行外汇卖出价。 
          </p>
        </div>
      </div>

      <div class="row ud20">
        <div class="col-8 m-auto">
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="row text-left ud10p ">
                <div class="col-12 ud10p  ">
                  <h5>ADDRESS</h5>
                  <h6>&nbsp;216-2487 Kaladar Ave, Ottawa, ON K1V 8B9</h6>
                </div>
                <div class="col-12 ud10p  ">
                  <h5>PHONE NUMBER</h5>
                  <h6>&nbsp;+1 613-879-7783</h6>
                </div>
                <div class="col-12 ud10p ">
                  <h5>EMAIL</h5>
                  <h6>&nbsp;support@slpcge.com</h6>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12 m-auto shadow-lg mgb10 padding20">
              <div class="row text-left">
                <form class="col-12" id="emailform" action="email.php" method="POST" enctype='multipart/form-data'>
                <div class="col-12 ud10p">
                  您的名字
                  <input class="wide-80 form-control" type="text" name="name">
                </div>
                <div class="col-12 ud10p">
                  您的邮箱
                  <input class="wide-80 form-control" type="text" name="email">
                </div>
                <div class="col-12 ud10p">
                  您的电话
                  <input class="wide-80 form-control" type="text" name="telphone">
                </div>
                <div class="col-12  ud10p">
                  信息
                  <textarea class="wide-80 form-control" name="message" form="emailform"></textarea>
                </div>
                <div class="col-12  ud10p">
                  <input class="btn btn-outline-primary" type="submit" name="submit" value="提交">
                </div>
                </form>
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