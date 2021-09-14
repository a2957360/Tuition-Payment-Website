<?php
	$leadtopage = $_POST['payreason'];
	if($leadtopage === 'tuition'){
        echo "<script> location.href='houseinfo.html'; </script>";
	}else if($leadtopage === 'lifefee'){
        echo "<script> location.href='houseinfo.html'; </script>";
	}else if($leadtopage === 'rentfee'){
        echo "<script> location.href='houseinfo.html'; </script>";
	}else if($leadtopage === 'other'){
        echo "<script> location.href='houseinfo.html'; </script>";
	}

?>
