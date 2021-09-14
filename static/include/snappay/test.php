<?php
$a = '<form id="form" action="../../../tuitionconfirm.php" method="POST">';
$a .= '<input name="name" value="Mike" type="hidden" />';
$a .= '<input name="age" value="18" type="hidden" />';
$a .= '<input name="sex" value="boy" type="hidden" />';
$a .= '</form>';
echo $a;
echo '<script>document.forms["form"].submit();</script>';
?>