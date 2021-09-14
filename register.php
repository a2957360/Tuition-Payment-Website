<?php
    include("static/include/sql.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    header("Content-Type: text/html; charset=utf8");
    $errormes =  "";
    $email="";
    $phone="";
    $firstname="";
    $lastname="";
    $phone="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作

    $password=$_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $match=$_POST['match'];
    $code=$_POST['code'];
    $firstname=$_POST['Firstname'];
    $lastname=$_POST['Lastname'];
    $date= date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("SELECT * FROM `user_table` WHERE `Email` = '$email';");
    $stmt->execute();
    if($stmt != null){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $errormes =  "该邮箱已被使用";
            }
    }
      if($match !== $code){
        $errormes =  "验证码不正确";

      }
    if($errormes ===  ""){
    $stmt = $pdo->prepare("insert into `user_table`(`FirstName`, `LastName`, `password`, `Phone`, `Email`, `RegisterDate`, `Checked`) values ('$firstname','$lastname','$password','$phone','$email','$date','1');");
      $stmt->execute();
            $_SESSION["UserName"] = $email;
            $stmt = $pdo->prepare("SELECT LAST_INSERT_ID();");
            $stmt->execute();
            if($stmt != null){
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $_SESSION['UserId'] = $row['LAST_INSERT_ID()'];
                  echo $_SESSION["UserName"];
                echo "<script> location.href='registersucess.html'; </script>";
              }
            }
        }else{
//          die('Error: ' . mysql_error());
      }

    $pdo = null;
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
                <form id="registform" class="col-12 ud10p" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
                <div class="row">
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        姓(拼音)：
                      </div>
                      <div class="col-7  col-lg-5">
                        <input class="form-control" type="text" name="Lastname" pattern="[a-zA-Z]{1,50}" title="请使用拼音" value="<?=$lastname?>" required>
                      </div>
                  	</div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        名(拼音)：
                      </div>
                      <div class="col-7  col-lg-5">
                        <input class="form-control"  type="text" name="Firstname" pattern="[a-zA-Z]{1,50}" title="请使用拼音" value="<?=$firstname?>" required>
                      </div>
                    </div>
                  </div>
                <div class="col-12 ud10p">
                      <p class="text-center colorred"><?= $errormes ?></p>
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        电子邮箱：
                      </div>
                      <div class="col-7  col-lg-5">
                      <input class="form-control"  id="getemail" type="email" name="email" value="<?=$email?>" required autofocus>
                      </div>

                    </div>
                  </div>
                    <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        验证码：
                      </div>
                      <div class="col-7  col-lg-3">
                        <input type="hidden" name="match" id="match">
                        <input  class="form-control"  type="text" maxlength="6" minlength="6" name="code" required>
                      </div>
                    <div style="padding-left:0" class="col-6 d-lg-none d-md-none">
                    </div>
                    <div style="padding-left:0" class="col-6  col-lg-4">
                            <button id="checkbtn" type="button" class="btn btn-outline-primary yzm " onclick="checkcode('checkcode.php')">获取验证码</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        密码：
                      </div>
                      <div class="col-7  col-lg-5">
                        <input  class="form-control"  type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="密码必须包含大写、小写字母和数字，最少八位。" oninput="checkPassword()" required>
                          <p class="d-lg-none">密码必须包含大写、小写字母和数字，最少八位。</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4 noPaddingRight " for="exampleFormControlInput1">
                        再输一次密码:
                      </div>
                    <div class="col-7  col-lg-5">
                      <input  class="form-control "   type="password" name="repassword" id="repassword"  oninput="checkPassword()" required>
                    </div>
                    </div>
                  </div>
                  <div class="col-12 ud10p">
                    <div class="row">
                      <div class="col-4 col-lg-4">
                        电话：
                      </div>
                      <div class="col-7  col-lg-5">
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
    function checkPassword(){
        var password = document.getElementById("password");
        var re_password = document.getElementById("repassword");
        if(password.value === re_password.value){
            re_password.setCustomValidity('');
        }else{
            re_password.setCustomValidity('两次输入的密码不相同');
        }
    }
    function checkcode(theUrl){
        var code = Math.random().toString(36).slice(2).substr(0,5);
        
        var btn = document.getElementById('checkbtn');
        var email = document.getElementById('getemail').value;
        btn.setAttribute("disabled", "disabled");
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open("post", theUrl, true);
        var info = "email="+email;
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(info);
        xmlHttp.onreadystatechange = function(){
        //若响应完成且请求成功
        if(xmlHttp.readyState === 4 && xmlHttp.status === 200){
            if(xmlHttp.responseText !== 'error'){
                codevalue = xmlHttp.responseText;
                if(codevalue === "have"){
                        alert("该邮箱已经注册");
                        btn.removeAttr("disabled");
                        return;
                   }
                btn.style.backgroundColor='grey';
                document.getElementById('match').value = codevalue;
                console.log(codevalue);
            }
        }else{
            
        }
        }
        xmlHttp.onerror = function(e) {
            alert("验证码发送错误！请重试！");
        };

        return xmlHttp.responseText;
    }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>