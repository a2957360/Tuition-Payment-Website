<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="static/css/style.css"/>
    <title>AliCanada PoweredByFineStufio</title>
  </head>



  <body class="fullback">
    <div class="container-fluid">

      <div class="row fullhight">

            <div class="col-12 ">
              <h2>你已成功注册，我们向您的邮箱发送了验证码，请去邮箱查看验证码。</h2>
              <p><span id="timer">5</span>秒后悔跳转到验证页面。。。 未跳转？<a href="emaicheck.php">请点击链接</a></p>
            </div>
      </div>
    </div>


  <script type="text/javascript">
    οnlοad=function(){
      setInterval(go, 1000);
    };
    var x=5; //??????????
    function go(){
    x--;
      if(x>0){
      document.getElementById("timer").innerHTML=x;  //?????x????????
      }else{
      location.href='emaicheck.php';
      }
    }
    function start(){
      setInterval(go, 1000);
    }
    start();
  </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>