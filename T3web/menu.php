<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Menu</title>
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
          <a href="main.html">
            <img src="images/logo.png" alt="Logo alt">
          </a>
        </h1>
          <div class="navigation">
            <nav>
              <ul class="sf-menu">
                <li><a href="./login.php" class="btn btn-outline-success" style="display:inline; border-radius:10px;">Sign in</a></li>
                <li><a href="./signup.php" class="btn btn-outline-success" style="display:inline; border-radius:10px;">Sign up</a></li>
                <li><a href="main.html">home</a></li>
                <li class="current"><a href="./menu.php">menu</a></li>
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
<section class="content gallery pad1">
  <div class="container">
    <div class="row">
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main1.jpg" class="gall_item"><img src="./images/main1.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Vivamus at magna non nunc </a></div>
            Rehoncus. Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreet
            </div>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main2.jpg" class="gall_item"><img src="./images/main2.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Divamus at magna non nunce </a></div>
            Kehoncus. Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreet
            </div>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main3.jpg" class="gall_item"><img src="./images/main3.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Livamus at magna non nunc </a></div>
            Tehoncus. Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreeto
            </div>
          </div>
        </div>
      </div>
      <div class="clear sep__1"></div>
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main4.jpg" class="gall_item"><img src="./images/main4.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Sivamus at magna non nute </a></div>
            Rehoncus. Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreetet
            </div>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main5.jpg" class="gall_item"><img src="./images/main5.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Kivamus at magna non nunj </a></div>
            Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreet
            </div>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="./images/main6.jpg" class="gall_item"><img src="./images/main6.jpg" alt=""></a>
            <div class="gall_bot">
            <div class="text1"><a href="#">Vivamus at magna non nunc </a></div>
            Rehoncus. Aliquam nibh antegestas id ictum a, commodo. Praesenterto faucibus maleada faucibusnec laeet metus id laoreet
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>