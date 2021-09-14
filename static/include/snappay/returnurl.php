<?php
  include('../sql.php');//链接数据库
	if(isset($_REQUEST['out_order_no'])){
		$out_order_no = $_REQUEST['out_order_no'];
		echo 'out_order_no:' . $out_order_no . '<br>';
	}
?>

<?php
    header("Content-Type: text/html; charset=utf8");
    $payfor = $_SESSION['Payfor'];
    $paymentid = $_SESSION['PaymentId'];
    if(isset($_GET['PayFor'])){
        $payfor = $_GET['PayFor'];
        $paymentid = $_GET['PaymentId'];
        $method = $_GET['method'];
        $amount = $_GET['amount'];
        $merchant = $_GET['merchant'];
    }
    switch ($payfor) {
        case 'tuition':
                $url = '../../../tuitionconfirm.php';
            break;
        case 'life':
                $url = '../../../lifefeeconfirm.php';
            break;
        case 'house':
                $url = '../../../houseconfirm.php';
            break;
        case 'other':
                $url = '../../../otherconfirm.php';
            break;
    }
    switch ($payfor) {
        case 'tuition':
            $stmt = $pdo->prepare("UPDATE `student_table` SET `Status`='1', `MercantId`='$merchant' WHERE `Id`='$paymentid';");
            $stmt->execute();
            break;
        case 'life':
            $stmt = $pdo->prepare("UPDATE `life_table` SET `Status`='1', `MercantId`='$merchant' WHERE `Id`='$paymentid';");
            $stmt->execute();
            break;
        case 'house':
            $stmt = $pdo->prepare("UPDATE `house_table` SET `Status`='1', `MercantId`='$merchant' WHERE `Id`='$paymentid';");
            $stmt->execute();
            break;
        case 'other':
            $stmt = $pdo->prepare("UPDATE `other_table` SET `Status`='1', `MercantId`='$merchant' WHERE `Id`='$paymentid';");
            $stmt->execute();
            break;
    }
    switch ($method) {
        case 'ALIPAY':
            $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `AliAmount` = `AliAmount` + '$amount' 
            WHERE `MerchantNo` = '$merchant';");
            $stmt->execute();
        break;
        case 'WECHATPAY':
            $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `WechatAmount` = `WechatAmount` + '$amount' 
            WHERE `MerchantNo` = '$merchant';");
            $stmt->execute();
        break;
        case 'UNIONPAY':
            $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `UnionAmount` = `UnionAmount` + '$amount' 
            WHERE `MerchantNo` = '$merchant';");
            $stmt->execute();
        break;
    }

//    echo "<script> location.href='../../../tuitionconfirm.php'; </script>";
    unset($_SESSION['PaymentId']);
  $a = '<form id="form" action='.$url.' method="POST">';
  $a .= '<input name="check" value="1" type="hidden" />';
  $a .= '<input name="paymentid" value='.$paymentid.' type="hidden" />';
  $a .= '</form>';
  echo $a;
  echo '<script>document.forms["form"].submit();</script>';
?>
