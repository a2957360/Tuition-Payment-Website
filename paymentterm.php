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
          <h1 class="ud20">支付条款</h1>
        </div>
      </div>

      <div class="row">

        <div class="col-12 col-lg-6 text-center">
            <div>            
                <img class="img-fluid" alt="Responsive image" src="static/img/midrow1.png">
            </div>
            <div>            
            <a style="width:50%" class="btn btn-primary btncolor" onclick="javascript:history.go(-1);">返回</a>
            </div>
        </div>

        <div style="max-height:700px" class="col-12 col-lg-6 pre-scrollable">
            <div class="ud10"></div>
            <div >            
            <a style="width:50%" class="btn btn-primary btncolor" onclick="javascript:history.go(-1);">返回上一页</a>
            </div>
            <div class="ud10"></div>
        <h3> TERMS OF USE</h3>
        <strong>PLEASE READ THE FOLLOWING CAREFULLY BEFORE USING THIS WEBSITE</strong><br>
        This website (the “Site ”) is owned and operated by Silver Pacific Gyre Inc.  (“SPG”). By using this Site, you signify your acceptance of the following Site Terms of Use (“Terms of Use”) and our Privacy Policy. If you do not agree to the Terms of Use and our Privacy Policy, then do not use this Site. These Terms of Use and Privacy Policy apply to all users of the Site.<br><br>
        <h4>1. Content<br></h4><br>
        The Site displays information including, but not limited to, transaction history, illustrations, tables, trademarks, trade names, logos and other information provided by SPG, SPG’s affiliates or third parties (“Site Content”). For clarity, Site Content includes Account Site Content (which is defined below in section 2). Although SPG attempts to provide an accurate description of the Site Content, SPG not does represent or warrant the accuracy, completeness, currency or reliability of such Site Content nor is SPG responsible if the Site Content is not accurate, complete, current or reliable. The Site Content is provided for general information only and should not be relied upon or used as the sole basis for making decisions. Any reliance on the Site Content is at your own risk.<br>
        None of the Site Content may be copied, reproduced or transferred without the prior permission of SPG. SPG authorizes you to view, print and download a single copy of the Site Content for your own use. If you violate any of these Terms of Use, your permission to use the Site Content immediately terminates and you must destroy any copies you have made of all or any portion of the Site Content. The Site Content is protected by copyright, trademark and other intellectual property laws under both Canadian law and foreign laws. Nothing contained on the Site should be understood as granting you a license to use any of the trademarks, trade names or logos owned by SPG, SPG’s affiliates or any third party.<br><br>
            <h4>2. Account Information<br></h4><br>
        In order to access special Site Content, certain visitors will be asked register and create an account on the Site (“Account Site Content”). You agree to provide true and current information on the registration form and to promptly update your account and other information, including contact information, so that SPG can provide you our services and contact you as needed. You also agree to maintain the confidentiality of your password. If you have any reason to believe or become aware of a loss, theft or unauthorized use of your password, you agree to notify SPG immediately.<br><br>
            <h4>3. Errors, Inaccuracies and Omissions<br></h4><br>
        Occasionally there may be information in the Site Content that contains typographical errors, inaccuracies or omissions. SPG reserves the right to correct any errors, inaccuracies or omissions and make any modifications to the Site Content at any time without prior notice. SPG has no obligation to update any information to the Site. You agree that it is your responsibility to monitor changes to our Site.<br><br>
            <h4>4. Liability<br></h4><br>
        SPG assumes no liability for any damage or loss, including, without limitation, any loss of revenue, anticipated revenue or other economic loss in connection with use of or reliance on the Site or Site Content.<br><br>
            <h4>5. Changes<br></h4><br>
        You can review the most current version of the Terms of Use at any time on this page.<br>
        SPG reserves the right, at its sole discretion, to update, change or replace any part of these Terms of Use by posting updates and changes to our Site. Your continued use of our Site following any changes to these Terms of Use constitutes acceptance of those changes.<br><br>
            <h4>6. Links to other Websites<br></h4><br>
        Our Service may contain links to third party websites or services that are not owned or controlled by SPG. SPG has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party websites or services. You further acknowledge and agree that SPG will not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such third party websites or services. We do not endorse, promote or recommend any services or products that may be offered by or accessed through such third party websites or the operators of them, except as may be explicitly stated to the contrary.<br><br>
            <h4>7. Personal Information<br></h4><br>
        Your submission of personal information through the Site is governed by our Privacy Policy. <br><br>
            <h4>8. Indemnity<br></h4><br>
        You agree to indemnify, defend and hold harmless SPG and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, subcontractors, suppliers, interns and employees, from any claim or demand, including reasonable attorneys’ fees, made by any third party due to or arising out of your breach of these Terms of Use.<br><br>
            <h4>9. Termination<br></h4><br>
        If, in our sole judgment, you violate any of these Terms of Use, we may terminate your permission to access or use the Account Site Content at any time without notice.<br><br>
            <h4>10. General Conditions<br></h4><br>
        SPG’s service may be available exclusively online through the Site. We reserve the right to refuse permission to anyone to access or use the Account Site Content for any reason at any time. You may not use our Site or Site Content for any illegal or unauthorized purpose nor may you, in the use of the Site or Site Content, violate any laws in your jurisdiction, including but not limited to copyright laws. A breach or violation of any of the Terms of Use will result in an immediate termination of your permission to use the Account Site Content.<br><br>
            <h4>11. Governing Law<br></h4><br>
        These Terms of Use are to be construed in accordance with the laws of the Province of Ontario (other than Ontario principles of conflicts of law) and the laws of Canada applicable in the Province of Ontario and are to be treated in all respects as an Ontario contract. All disputes arising out of or in connection with or in relation to these Terms of Use are to be submitted to the jurisdiction of the courts of the province of Ontario which have exclusive jurisdiction over any such dispute. You agree to attorn to the jurisdiction of the courts of the Province of Ontario.<br><br>
            <h4>12. Headings<br></h4><br>
        The headings used in this agreement are included for convenience only and will not limit or otherwise affect these Terms of Use.<br><br>
            <h4>13. Language<br></h4><br>
        The parties agree that these Terms of Use are in English and that English is the official language of these Terms of Use.<br><br>
            <h4>14. Entire Agreement<br></h4><br>
        These Terms of Use constitute the entire agreement between you and SPG and govern your use of this Site, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us. The failure of SPG to exercise or enforce any right or provision of these Terms of Use shall not constitute a waiver of such right or provision.<br>
            <div class="ud10"></div>
            <div >            
            <a style="width:50%" class="btn btn-primary btncolor" onclick="javascript:history.go(-1);">返回上一页</a>
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