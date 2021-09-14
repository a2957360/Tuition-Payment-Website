<?php 
include("static/include/sql.php");
    $stmt = $pdo->prepare("UPDATE `storeinfo_table` SET `AliAmount`='0',`WechatAmount`='0',`UnionAmount`='0',`AliState`='1',`WechatState`='1'");
    $stmt->execute();
?>
