<?php 
include("static/include/sql.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $leadtopage = $_POST['payreason'];
  if($leadtopage === 'tuition'){
        echo "<script> location.href='houseinfo.php'; </script>";
  }else if($leadtopage === 'lifefee'){
        echo "<script> location.href='houseinfo.php'; </script>";
  }else if($leadtopage === 'rentfee'){
        echo "<script> location.href='houseinfo.php'; </script>";
  }else if($leadtopage === 'other'){
        echo "<script> location.href='houseinfo.php'; </script>";
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
    <title>Silver Pacific Gyre term</title>
  </head>



  <body >
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>
    
      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <h2 class="ud20">微信支付限额参考表</h2>
        </div>
      </div>

      <div class="row">

        <div class="col-12 col-lg-6 text-center">
            <div>            
                <img class="img-fluid" alt="Responsive image" src="static/img/midrow1.png">
            </div>
     
        </div>

        <div style="max-height:700px" class="col-12 col-lg-6 pre-scrollable">
            <div class="ud10"></div>
      
            <div class="ud10"></div>
        <b> 微信/支付宝 支付限额解决方案</b>
      <div class="ud10"></div>
      由于款项支付金额可能较大，而各个银行卡在支付宝或微信平台上的单笔限额不一，各位家长和同学可能会遇到超出单笔限额无法一笔完成支付的情况（ 各个银行限额明细请参考相对应的表格），请参考以下解决方案：<br><br>
        <b>支付宝<br></b><br>
        1、	用支付宝余额支付，先将对应支付金额转入支付宝余额，然后在支付宝中选择账户余额进行支付。（单张银行卡的银行限额可能不足，可以使用多张银行卡提前转入支付宝账户余额。可能会发生银行卡单日转入余额限额规定，可分多天完成）<br>
        2、	用余额宝支付。请使用电脑PC端打开网页完成支付，先将对应支付金额转入余额宝内，在支付宝支付方式中选择用余额宝支付（可能会发生银行卡单日转入余额宝限额规定，可分两天完成；或使用多张银行卡单日完成转款）
余额宝支付方式仅适用于电脑PC端支付 <br><br>
            <b>微信<br></b><br>
         3、	用微信钱包支付，先将对应支付金额转入微信钱包零钱（可以使用多张银行卡提前转入微信钱包零钱），然后在微信中选择零钱进行支付。<br>
4、根据不同银行卡的发卡行限额规定，可分多笔（建议3-4笔）拆分，也可分别使用微信，或支付宝进行拆分，最终完成全部款项的支付。
<br><br>
            
            <div class="ud10"></div>
            <div >            
            <a style="width:50%;color:white" class="btn btn-primary btncolor" onclick="javascript:history.go(-1);">返回上一页</a>
            </div>
            <div class="ud10"></div>

        </div>

      </div>


<?php include("footer.php") ?>


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