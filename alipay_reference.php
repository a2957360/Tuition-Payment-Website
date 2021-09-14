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
          <h2 class="ud20">支付宝绑定银联卡限额 参考表</h2> 
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
        <b> 支付宝绑定银联卡限额</b> <br>
        1.	手机端与电脑端共享额度<br>
2.	针对10周岁~16周岁认证人群银行卡限额（单张银行卡支付限额（不含网银）共享1000元/日，10000元/年）<br>
3. 
国内信用卡/储蓄卡 参照<br>
 <div class="ud10"><b>储蓄卡快捷支付限额</b> </div>
 
中国银行	单笔1万、单日1万、单月无限额<br>
农业银行	单笔1万、单日1万、单月30万<br>
工商银行	单笔1万、单日5万、单月10万<br>
交通银行	单笔1万、单日1万、单月10万<br>
建设银行	单笔1万、单日5万、单月10万<br>
平安银行	单笔5万、单日5万、单月无限额<br>
中信银行	单笔1万、单日1万、单月无限额
(淘宝、天猫、阿里巴巴消费场
景和余额宝 充值场景，额度为单
笔20万、单日20万、单月无限额)<br>
光大银行	单笔10万、单日10万、单月无限额<br>
浦发银行	单笔50万、单日50万、单月无限额<br>
招商银行	单笔5万、单日5万、单月无限额<br>
广发银行	单笔3万、单日3万、单月无限额<br>
邮储银行	单笔10000、单日20000、单月无限额<br>
民生银行	单笔5万、单日5万、单月无限额<br>
兴业银行	单笔5万、单日5万、单月无限额<br>
华夏银行	单笔50万、单日50万、单月无限额<br>
上海银行	单笔5万、单日5万、单月10万<br>
网商银行	1万/日、20万/年，快捷支付与网商APP<br>
<span class="grey">*发起的转出到支付宝额度共享。具体请 
以页面提示为准。</span>
	<br>
             <div class="ud10"><b>银联信用卡快捷支付限额</b> </div>
  
农业银行	单笔2万、单日2万、单月20万<br>
工商银行	单笔5万、单日10万、单月10万<br>
交通银行	单笔5万、单日5万、单月无限额<br>
建设银行	单笔5万、单日5万、单月10万<br>
平安银行	单笔无限额、单日无限额、单月无限额<br>
中国银行	单笔无限额、单日无限额、单月无限额<br>
光大银行	单笔6万、单日6万、单月无限额<br>
浦发银行	单笔10万、单日10万、单月无限额<br>
招商银行	单笔5万、单日无限额、单月无限额<br>
广发银行	单笔3万、单日3万、单月无限额<br>
邮储银行	单笔2万、单日5万、单月5万<br>
民生银行	单笔5万、单日5万，单月无限额<br>
兴业银行	单笔5万、单日无限额、单月无限额<br>
华夏银行	单笔5万、单日无限额、单月无限额<br>
中信银行	单笔无限额、单日无限额、单月无限额<br>

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