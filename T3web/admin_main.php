<?php
    session_start();
    if(is_null($_SESSION['id'])) {
      echo "<script>window.alert('로그인 해주세요');</script>";
      echo "<script>location.href='./main.html';</script>";
    }
    else if($_SESSION['id'] != 'admin'){
      echo "<script>window.alert('권한이 없습니다.');</script>";
      echo "<script>location.href='./user_main.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name = "format-detection" content = "telephone=no" />
<link rel="icon" href="images/favicon.ico">
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/stuck.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/touchTouch.css">
<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/script.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.equalheights.js"></script>
<script src="js/jquery.mobilemenu.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tmStickUp.js"></script>
<script src="js/jquery.ui.totop.js"></script>
<script src="js/touchTouch.jquery.js"></script>

<script>
 $(document).ready(function(){

  $().UItoTop({ easingType: 'easeOutQuart' });
  $('#stuck_container').tmStickUp({});
  $('.gallery .gall_item').touchTouch();

  });
</script>
<!--[if lt IE 9]>
 <div style=' clear: both; text-align:center; position: relative;'>
   <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
     <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
   </a>
</div>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">


<![endif]-->
</head>

<body class="page1" id="top">
<!--==============================
              header
=================================-->
<header>
<!--==============================
            Stuck menu
=================================-->
  <section id="stuck_container">
    <div class="container">
      <div class="row">
        <div class="grid_12">
        <h1>
          <a href="./admin_main.php">
            <img src="images/logo.png" alt="Logo alt">
          </a>
        </h1>
          <div class="navigation">
            <nav>
              <ul class="sf-menu">
                <li><a href="./out_question.php" class="btn btn-outline-success" style="display:inline; border-radius:10px;">Sign out</a></li>
                <li><p><? echo $_SESSION['name']?> 님</p></li>
                <li class="current"><a href="admin_main.php">home</a></li>
                <li><a href="./admin_menu.php">menu</a></li>
                <li><a href="./admin_memb.php">member</a></li>
                <li><a href="./admin_order.php">order</a></li>
             </ul>
            </nav>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</header>

<!--=====================
          Content
======================-->
<section class="content">
  <div class="container">
    <div class="row">
      <div class="grid_4">
        <div class="banner">
		  <div class="gall_block">
          <img src="images/main2.jpg" alt="">
          <div class="bann_capt ">
            <div class="maxheight">
              <img src="images/icon1.png" alt="">
              <div class="bann_title">Trust</div>
            </div>
          </div>
        </div>
	   </div>
      </div>
      <div class="grid_4">
        <div class="banner">
		  <div class="gall_block">
          <div class="bann_capt  bn__1">
            <div class="maxheight">
              <img src="images/icon2.png" alt="">
              <div class="bann_title">Tasty</div>
            </div>
          </div>
          <img src="images/main1.jpg" alt="">
        </div>
		</div>
      </div>
      <div class="grid_4">
        <div class="banner ">
		  <div class="gall_block">
          <img src="images/main3.jpg" alt="">
          <div class="bann_capt  bn__2">
            <div class="maxheight">
              <img src="images/icon3.png" alt="">
                <div class="bann_title">Tidy</div>
            </div>
          </div>
		  </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

