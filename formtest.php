<?php

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
    <title>Silver Pacific Gyre Registration</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

    <?php include('static/include/header.php'); ?>

      <div class="row fullhight">
            <div class="col-lg-6 col-1">
            </div>
            <div class="col-11 col-lg-4 m-auto">
              <div class="row text-left lagrefont">
                <div class="col-12 text-center">
                </div>
<!--
                <form id="registform" class="col-12 ud10p" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="row">
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        姓：
                      </div>
                      <div class="col-7  col-lg-4">
                        <input class="form-control" type="text" name="Lastname" value="<?=$lastname?>" required>
                      </div>
                  	</div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        名：
                      </div>
                      <div class="col-7  col-lg-4">
                        <input class="form-control"  type="text" name="Firstname" value="<?=$firstname?>" required>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud10p">
                      <p class="text-center colorred"><?= $errormes ?></p>
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        电子邮箱：
                      </div>
                      <div class="col-7  col-lg-4">
                      <input class="form-control"  id="getemail" type="email" name="email" value="<?=$email?>" required autofocus>
                      </div>

                    </div>
                  </div>
                    <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        验证码：
                      </div>
                      <div class="col-3  col-lg-2">
                        <input type="hidden" name="match" id="match">
                        <input  class="form-control"  type="text" maxlength="6" minlength="6" name="code" required>
                      </div>
                    <div style="padding-left:0" class="col-4  col-lg-4">
                            <button id="checkbtn" type="button" class="btn btn-outline-primary yzm " onclick="checkcode('checkcode.php')">获取验证码</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        密码：
                      </div>
                      <div class="col-7  col-lg-4">
                        <input  class="form-control"  type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="密码必须包含大写、小写字母和数字，最少八位。" oninput="checkPassword()" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4 noPaddingRight " for="exampleFormControlInput1">
                        再输一次密码:
                      </div>
                    <div class="col-7  col-lg-4">
                      <input  class="form-control "   type="password" name="repassword" id="repassword"  oninput="checkPassword()" required>
                    </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        电话：
                      </div>
                      <div class="col-7  col-lg-4">
                        <input class="form-control"  type="text" pattern="(^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8})|(\d{10})" value="<?=$phone?>" name="phone" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 ud20 text-center">
                    <div class="row">
                    <div class="col-12 ud10">
                        <input class="btn btn-outline-primary " type="submit" name="submit" value="注册账号">
                    </div>
                    <div class="col-12 ud10p">
                        <a href="login.php" class="btn btn-outline-primary ">返回登陆</a>
                    </div>
                    </div>
                  </div>
                </div>
                </form>
-->
<form class="needs-validation" novalidate>
  <div class="form-row">
    <div class="col-12 ">
      <label for="validationCustom01"> 姓：</label>
      <input type="text" class="form-control" name="Lastname" value="<?=$lastname?>" required>
        <div class="invalid-feedback">
          请输入该字段
        </div>
    </div>
    <div class="col-12 ">
      <label for="validationCustom02">名：</label>
      <input type="text" class="form-control" name="Firstname" value="<?=$firstname?>"  required>
      <div class="invalid-feedback">
        请输入该字段
      </div>
    </div>
    <div class="col-12 ">
      <label for="validationCustom02">电子邮箱：</label>
      <input type="email"  id="getemail" class="form-control" name="email" value="<?=$email?>" required>
      <div class="invalid-feedback">
        请输入有效邮箱
      </div>
  </div>
          <div class="col-7 ">
      <label for="validationCustom02">验证码：</label>
      <input type="text" name="code" maxlength="6" minlength="6" class="form-control" required>
      <div class="invalid-feedback">
        验证码为六位
      </div>
  </div>
<div class="col-4 ">
                       <button id="checkbtn" type="button" class="btn btn-outline-primary yzm " onclick="checkcode('checkcode.php')">获取验证码</button>
  </div>
          <div class="col-12 ">
      <label for="validationCustom02">密码：</label>
      <input type="password"  id="getemail" class="form-control" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" oninput="checkPassword()" required>
      <div class="invalid-feedback">
        密码必须包含大写、小写字母和数字，最少八位。
      </div>
  </div>
          <div class="col-12 ">
      <label for="validationCustom02">再输一次密码：</label>
      <input  class="form-control "   type="password" name="repassword" id="repassword"  oninput="checkPassword()" required>
      <div class="invalid-feedback">
        密码必须包含大写、小写字母和数字，最少八位。
      </div>
      </div>
    <div class="col-12 ">
      <label for="validationCustom02">电话：</label>
        <input class="form-control"  type="text" pattern="(^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8})|(\d{10})" value="<?=$phone?>" name="phone" required>
    <div class="invalid-feedback">
        请输入正确电话号码
      </div>
    </div>
</div>
<!--
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">City</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">State</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
-->
<div class="col-12 ud20 text-center">
    <div class="row">
    <div class="col-12 ud10">
        <input class="btn btn-outline-primary " type="submit" name="submit" value="注册账号">
    </div>
    <div class="col-12 ud10p">
        <a href="login.php" class="btn btn-outline-primary ">返回登陆</a>
    </div>
    </div>
  </div>
</form>
                <div class="col-12  text-center">
                  <p>注册表示同意<a class="colorblue" href="#">《银流宝用户协议》</a></p>
                </div>
              </div>
            </div>
  <!--         </div>
        </div> -->
      </div>

      <?php include("footer.php")?>
      <div class="row footer text-center ">
        <div class="col-12 m-auto ">
          <p>@ 2019 Silver Pacific Gyre Inc. All rights reserved. Powered By Finestudio.</p>
        </div>
      </div>
    </div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>