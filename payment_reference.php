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
          <h2 class="ud20">国内信用卡使用方法</h2>
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
        <h3> 国内信用卡使用方法</h3>
             <div class="ud10"></div>
        <strong>绑定信用卡到 支付宝/微信，在 支付宝/微信 支付方式中选择信用卡支付</strong><br>
      
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