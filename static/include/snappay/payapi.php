<?php
    include('../sql.php');//链接数据库
    if(!isset($_SESSION["PaymentId"])){
        unset($_SESSION['PaymentId']);
    }
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    <title>AliCanada PoweredByFineStufio</title>
</head>

<?php
  require_once( 'lib/snappay-sign-utils.php' );



  $trans_amount = $_REQUEST['trans_amount'];
  $trans_amount =  round($trans_amount,2);
  $payment_method = $_REQUEST['payment_method'];
  $currency = $_REQUEST['currency'];
  $out_order_no = $_REQUEST['out_order_no'];
  $timestamp = date_create('',timezone_open("UTC"));
  $timestamp = date_format($timestamp, 'Y-m-d H:i:s');
  $notify_url = $_REQUEST['notify_url'];
  $description = $_REQUEST['description'];


    
    //MUST keep sign key secretly. Best to load from somewhere else, like database.
  $stmt = $pdo->prepare("SELECT * FROM `storeinfo_table`;");
  $stmt->execute();
  if($stmt != null){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $usepay = true;
        if(strpos($row['Name'], "USD") && $currency == "CAD"){
            continue;
        }else if(!strpos($row['Name'], "USD") && $currency == "USD"){
            continue;
        }
        if($payment_method == 'ALIPAY' && $row['AliState'] == '0'){
            continue;
        }
        if($payment_method == 'WECHATPAY' && $row['WechatState'] == '0'){
            continue;
        }
        if($payment_method == 'UNIONPAY' && $row['UnionState'] == '0'){
            continue;
        }
        if((float)$row['AliAmount'] + (float)$trans_amount >= 130000 && $payment_method == 'ALIPAY'){
            $payid = $row['Id'];
            $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `AliState` = 1 WHERE `Id` = '$payid';");
            $stmt->execute();
            $usepay = false;
        }
        if((float)$row['WechatAmount'] + (float)$trans_amount >= 130000 && $payment_method == 'WECHATPAY'){
            $payid = $row['Id'];
            $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `WechatState` = 1 WHERE `Id` = '$payid';");
            $stmt->execute();
            $usepay = false;
        }
        if($usepay){
          $signKey =$row['SignKey'];
          $app_id =$row['AppId'];
          $merchant_no =$row['MerchantNo'];
          break;
        }
    }
  }
    if(!isset($signKey)){
        header('Location: '."../../../nomoney.html");
    }
    
    $return_url = $_POST['return_url']."&merchant=".$merchant_no."&method=".$payment_method."&amount=".$trans_amount;
    
  if($payment_method === 'WECHATPAY'){
    $parmethod = 'pay.qrcodepay';
  }else{
    $parmethod = 'pay.webpay';

  }

  $post_data = array(
        'app_id' => $app_id,
        'format' => 'JSON',
        'charset' => 'UTF-8',
        'sign_type' => 'MD5',
        'version' => '1.0',
        'timestamp' => $timestamp,

        'method' => $parmethod,
        'merchant_no' => $merchant_no,
        'payment_method' => $payment_method,
        'out_order_no' => $out_order_no,
        'trans_amount' => $trans_amount,
        'trans_currency' => $currency,
        'notify_url' => $notify_url,
        'return_url' => $return_url,
        'description' => $description,
    );

  $post_data_sign = snappay_sign_post_data($post_data, $signKey);

  //echo print_r($post_data_sign);

  $url = 'https://open.snappay.ca/api/gateway';

  $options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  =>  "Content-Type: application/json\r\n"."Accept: application/json\r\n",
        'content' => json_encode($post_data_sign)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) {  
    //Handle error  
  }

  if ($payment_method === 'WECHATPAY') {
    $result = preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $result);
    $result_json = json_decode($result, true);
    $codeStr = '';
    if($result_json['code'] === '0'){
      $qrcode_url = $result_json['data'][0]['qrcode_url'];
      //echo print_r($qrcode_url);
      $codeStr = $qrcode_url;
    }
  }else{
    var_dump($result);

    $result_json = json_decode($result, true);
    if($result_json['code'] === '0'){
      $webpay_url = $result_json['data'][0]['webpay_url'];
      //echo print_r($webpay_url);
      header('Location: '.$webpay_url);
      exit();
    }

  }

?>

<body>
  <?php 
  if($result_json['code'] !== '0'){
    echo 'Create order fail. [' . $result_json['msg'] . ']';
  } else {
  ?>

<div class="container-fluid">

      <div class="row blueback">
        <div class="col-10 m-auto text-center">
          <h1 class="ud20">请扫描二维码</h1>
          <p  class="ud20">参考汇率为支付宝/微信/银联官方汇率。由于实时性原因，实际交易汇率可能有上下浮动。<br>
            实际汇率请以支付宝/微信/银联官方交易确认页面为准。<br>
            有时会略低于/高于中国银行外汇卖出价。<br>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-12 m-auto">

            <div class="col-12 ud20 text-center">
              <p>支付金额：<?=$currency?> $<?= $trans_amount ?></p>
            <div id="code"></div> 
                <img id="showqr">
            </div>
                <div class="col-12 shadow-lg p-3 mb-5 bg-white rounded">
              <p class="msfont ">由于中国和加拿大的时区原因，校方会在3-4个工作日内收到款项。我们会邮件通知您。<br><br>
                了解更多信息，请拨打学费宝客服专线：<br>
                免费咨询电话: +1 613 879 7783<br>
                电子邮件:support@slpcge.com</p>
            </div> 
        <p><span class="status"></span></p>
            <div class="col-12 btnspace text-center">
              支付有问题？您可以
              <a class="btn btn-primary btn-lg btn-block btncolor" href="../../../index.php">返回首页</a>
            </div> 
        </div>
      </div>

       <div class="row blueback">
          <div class="col-10 m-auto">
            <div class="row ud20 colorblack">
              <div class="col-12  col-lg-8">
                <div class="row">
                  <h4>我们的服务</h4>
                </div>
                <div class="row">
                    <p>Silver Pacific Gyre Inc. 致力于为海外华人提供多种类的支付方式，提高您的资金流动性
                        同时为海外华人和学子提供不同的支付通道，安全，可靠，便捷
                        为您资金流动助力，为您减轻中国外汇限额带来的烦恼。
                        银流支付是由Silver Pacific  Gyre Inc. 管理。 Silver Pacific  Gyre Inc. 是由加拿大金融交易与报告分析中心授权的货币服务机构。
                        </p>
                </div>
              </div>
              <div class="col-6 col-lg-2 text-right m-auto">
                  <img style="width:50%" src="../../../static/img/QR.jpg">
              </div>
              <div class="col-6 col-lg-2 text-right m-auto">
                <a class="btn btn-outline-primary" href="contractus.php" role="button">联系我们</a>
              </div>
            </div>
          </div>
      </div> 

      <div class="row footer text-center ">
        <div class="col-12 m-auto">
          <p>@ 2019 Alexander International Ltd. All rights reserved.</p>
        </div>
      </div>
    </div>
  <script type="text/javascript" src="lib/jquery-3.3.1.min.js"></script> 
  <script type="text/javascript" src="lib/jquery.qrcode.min.js"></script> 
  <script type="text/javascript">
      
    $().ready(function(){
        setTimeout(function () {
        $("#code").qrcode({ 
            width: 200,
            height:200,
            text: "<?php echo $codeStr ?>"
        }); 
        var data = $("#code canvas")[0].toDataURL( 'image/png', 1 );
        $('#showqr').attr('src', data);
        $("#code").empty();
        }, 500);
    })
  </script> 


  <script>
        (function() {
            var out_order_no = '<?php echo $out_order_no ?>';
            var merchant_no = '<?php echo $merchant_no ?>';
            var counter =0;
            var pollingurl = "../query/queryorder.php?out_order_no="+out_order_no+"&merchant_no="+merchant_no;
            var status = $('.status'),
                poll = function() {
                    status.text('Waiting ...');
                    console.log("waiting counter: " + counter);
                    if (counter++ >  30) { // timeout after 30 times
                        status.text(" TIMEOUT !!!  "); // timeout
                        clearInterval(pollInterval); // optional: stop poll function
                        console.log("waiting for user confirm transaction is timeout  " + " === ");
                    } else {
                        $.ajax({
                            url: pollingurl,
                            dataType: 'json',
                            type: 'get',
                            success: function(data) { 
                // check if it is available
                console.log("data.data[0].trans_status: " + data.data[0].trans_status);
                                if ( data.data[0].trans_status == 'SUCCESS' ) { // get and check data value
                                    status.text(data.data[0].trans_status); // get and print data string
                                    clearInterval(pollInterval); // optional: stop poll function
                                    console.log("queryorder.jsp return success " + " === ");
                                    window.location.replace("<?php echo $return_url ?>");
                                } else {
                                    status.text(data.data[0].trans_status);
                                    console.log("queryorder.jsp return not success   " + " === ");
                                }
                            },
                            error: function(xhr, status, error) { // error logging
                              console.log(xhr);
                                // var err = eval("(" + xhr.responseText + ")");
                                // console.log(err.Message);
                            }
                        });
                    }

                };

            poll(); // also run function on init
            pollInterval = setInterval(function() { // run function every 5000 ms
                poll();
            }, 5000);
        })();
    </script>

  <?php 
  }
  ?>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>