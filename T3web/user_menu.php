<?php
    session_start();
    if(is_null($_SESSION['id'])) {
        echo "<script>window.alert('로그인 해주세요');</script>";
        echo "<script>location.href='./main.html';</script>";
    }
    include("./db_connect.php");

    $query1 = "select count(menu_no) as count from menu where menu_name <> ' '";
    $result1 = oci_parse($conn, $query1);
    oci_execute($result1);
    $row = oci_fetch_array($result1);
    oci_free_statement($result1);
    $menu_count = $row[COUNT];

    $query2 = "select menu_no, menu_name, menu_price, img_path from menu where menu_name <> ' ' and rownum >= 1 and rownum <= 3";
    $query3 = "select menu_no, menu_name, menu_price, img_path from 
                ( select m.menu_no, m.menu_name, m.menu_price, m.img_path, rownum n from menu m where menu_name <> ' ' ) where n >= 4 and n <= 6";
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
          <a href="./user_main.php">
            <img src="images/logo.png" alt="Logo alt">
          </a>
        </h1>
          <div class="navigation">
            <nav>
              <ul class="sf-menu">
                <li><a href="./out_question.php" class="btn btn-outline-success" style="display:inline; border-radius:10px;">Sign out</a></li>
                <li><p><? echo $_SESSION['name']?> 님</p></li>
                <li><a href="user_main.php">home</a></li>
                <li class="current"><a href="./user_menu.php">menu</a></li>
                <li><a href="./member.php">mypage</a></li>
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
    <div class="content" style="position:absolute; height:80vh; width:100%; padding:0 0 0 60px;">
        <div style="position:relative; float:left; height:80%; width:68%;">
            <form action="./order_insert.php" method="post">
            <?php
            if($menu_count['count'] < 4)
            {
                echo "
                <div style='position:relative; height:33%; width:100%;'>
                ";
                $result2 = oci_parse($conn, $query2);
                oci_execute($result2);
                for($i=0;$array = oci_fetch_array($result2);$i++)
                {
                    echo "
                    <div style='position:static; float:left; height:100%; width:30%; margin:10px 30px 10px 0px;'>
                        <img src='".$array[IMG_PATH]."' class='img-thumbnail' alt='Cinque Terre' style='width:100%; height:100%;'>
                    </div>
                    ";
                }
                echo "
                </div>
                <div style='position:relative; height:10%; width:100%; overflow:hidden;'>
                ";
                $result2 = oci_parse($conn, $query2);
                oci_execute($result2);
                for($i=0;$array = oci_fetch_array($result2);$i++)
                {
                    echo "
                    <div style='position:relative; float:left; height:100%; width:30%; margin:0px 30px 10px 0px; text-align:center;'>
                        <div class='btn-group' style='display:inline-block; margin:-20px 0 -50px 0;'>
                            <a href='#' class='link1 bt_up'>+</a>
                            <a href='#' class='link1 num'>0</a>
                            <a href='#' class='link1 bt_down'>-</a>
                        </div>
                        <div class='bq_title color1'>".$array[MENU_NAME]."</div>
                        <div class='bq_title color1'>".$array[MENU_PRICE]."원</div>
                        <input type='hidden' name='menu[]' value='0' />
                        <input type='hidden' name='menu_name[]' value='".$array[MENU_NAME]."' />
                        <input type='hidden' name='menu_price[]' value='".$array[MENU_PRICE]."' />
                        <input type='hidden' name='menu_no[]' value='".$array[MENU_NO]."' />
                    </div>
                    ";
                }
                oci_free_statement($result2);
                echo "
                </div>
                ";
            }
            else
            {
                echo "
                <div style='position:relative; height:33%; width:100%;'>
                ";
                $result2 = oci_parse($conn, $query2);
                oci_execute($result2);
                for($i=0;$array = oci_fetch_array($result2);$i++)
                {
                    echo "
                    <div style='position:static; float:left; height:100%; width:27%; margin:30px 80px 10px 0px;'>
                        <img src='".$array[IMG_PATH]."' class='img-thumbnail' alt='Cinque Terre' style='width:100%; height:100%;'>
                    </div>
                    ";
                }
                echo "
                </div>
                <div style='position:relative; height:10%; width:100%; overflow:hidden;'>
                ";
                $result2 = oci_parse($conn, $query2);
                oci_execute($result2);
                for($i=0;$array = oci_fetch_array($result2);$i++)
                {
                    echo "
                    <div style='position:static; float:left; height:100%; width:27%; margin:0px 80px 10px 0px; text-align:center;'>
                        <div class='btn-group' style='display:inline-block; margin:-20px 0 -50px 0;'>
                            <a href='#' class='link1 bt_up'>+</a>
                            <a href='#' class='link1 num'>0</a>
                            <a href='#' class='link1 bt_down'>-</a>
                        </div>
                        <div class='bq_title color1'>".$array[MENU_NAME]."</div>
                        <div class='bq_title color1'>".$array[MENU_PRICE]."원</div>
                        <input type='hidden' name='menu[]' value='0' />
                        <input type='hidden' name='menu_name[]' value='".$array[MENU_NAME]."' />
                        <input type='hidden' name='menu_price[]' value='".$array[MENU_PRICE]."' />
                        <input type='hidden' name='menu_no[]' value='".$array[MENU_NO]."' />
                    </div>
                    ";
                }
                oci_free_statement($result2);
                echo "
                </div>
                <div style='position:relative; height:33%; width:100%;'>
                ";
                $result3 = oci_parse($conn, $query3);
                oci_execute($result3);
                for($i=0;$array = oci_fetch_array($result3);$i++)
                {
                    echo "
                    <div style='position:static; float:left; height:100%; width:27%; margin:10px 80px 10px 0px;'>
                        <img src='".$array[IMG_PATH]."' class='img-thumbnail' alt='Cinque Terre' style='width:100%; height:100%;'>
                    </div>
                    ";
                }
                echo "
                </div>
                <div style='position:relative; height:10%; width:100%; overflow:hidden;'>
                ";
                $result3 = oci_parse($conn, $query3);
                oci_execute($result3);
                for($i=0;$array = oci_fetch_array($result3);$i++)
                {
                    echo "
                    <div style='position:static; float:left; height:100%; width:27%; margin:0px 80px 10px 0px; text-align:center;'>
                        <div class='btn-group' style='display:inline-block; margin:-20px 0 -50px 0;'>
                            <a href='#' class='link1 bt_up'>+</a>
                            <a href='#' class='link1 num'>0</a>
                            <a href='#' class='link1 bt_down'>-</a>
                        </div>
                        <div class='bq_title color1'>".$array[MENU_NAME]."</div>
                        <div class='bq_title color1'>".$array[MENU_PRICE]."원</div>
                        <input type='hidden' name='menu[]' value='0' />
                        <input type='hidden' name='menu_name[]' value='".$array[MENU_NAME]."' />
                        <input type='hidden' name='menu_price[]' value='".$array[MENU_PRICE]."' />
                        <input type='hidden' name='menu_no[]' value='".$array[MENU_NO]."' />
                    </div>
                    ";
                }
                oci_free_statement($result3);
                echo "
                </div>
                ";
            }
            oci_close($conn);
            ?>
        </div>

        <div style="position:fixed; float:right; height:60%; width:20%; top:24%; left:76%; border:4px dashed #bcbcbc;">
            <div id="order_box" style="position:static; float:right; height:80%; width:100%; text-align:center;">
            </div>
            <div id="order_price" style="position:static; float:right; height:20%; width:100%; border-top: 4px dashed #bcbcbc; font-family: Consolas, monospace;">
                <div class='blog_title pull-right' style="position:relative; top:40px; left:-30px;">0원</div>
            </div>
        </div>
            <input type="submit" value="주 문" class="btn btn-outline-success" style="position:fixed; top:86%; left:90%; width:100px; padding:10px 20px 10px 20px;"/>
            </form>
    </div>

    <script>
        $(function(){
          $('.bt_up').click(function(){
            var n = $('.bt_up').index(this);
            var num = $(".num:eq("+n+")").val();
            num = $(".num:eq("+n+")").val(num*1+1);
            $(".num:eq("+n+")").html($(".num:eq("+n+")").val());
            document.getElementsByName("menu[]")[n].value = $(".num:eq("+n+")").val();
            $('#order_box').empty();
            var total_price = 0;
            for(var i=0; i < $('.num').length; i++) {
                if($('.num').eq(i).val() > 0) {
                    $order_price = $('.num').eq(i).val() * document.getElementsByName("menu_price[]")[i].value;
                    total_price = total_price + $order_price;
                    $('#order_box').append("<div style='position:static; height:10%; width:70%; display:inline-block; border-bottom:4px dashed #bcbcbc;'><div class='bq_title color1 pull-right' style='position:relative; top:11px; left:-70px;'>"
                        +document.getElementsByName("menu_name[]")[i].value+" "+$(".num:eq("+i+")").val()+"개 "+$order_price+"원</div></div>");
                }
            }
            $("#order_price").html("<div class='blog_title pull-right' style='position:relative; top:40px; left:-30px;'>"+total_price+"원</div>");
          });
          $('.bt_down').click(function(){
            var n = $('.bt_down').index(this);
            var num = $(".num:eq("+n+")").val();
            if(num > 0) {
                num = $(".num:eq("+n+")").val(num*1-1);
                $(".num:eq("+n+")").html($(".num:eq("+n+")").val());
                document.getElementsByName("menu[]")[n].value = $(".num:eq("+n+")").val();
                $('#order_box').empty();
                var total_price = 0;
                for(var i=0; i < $('.num').length; i++) {
                    if($('.num').eq(i).val() > 0) {
                        $order_price = $('.num').eq(i).val() * document.getElementsByName("menu_price[]")[i].value;
                        total_price = total_price + $order_price;
                        $('#order_box').append("<div style='position:static; height:10%; width:70%; display:inline-block; border-bottom:4px dashed #bcbcbc;'><div class='bq_title color1 pull-right' style='position:relative; top:11px; left:-70px;'>"
                            +document.getElementsByName("menu_name[]")[i].value+" "+$(".num:eq("+i+")").val()+"개 "+$order_price+"원</div></div>");
                    }
                }
                $("#order_price").html("<div class='blog_title pull-right' style='position:relative; top:40px; left:-30px;'>"+total_price+"원</div>");
            }
          });
        })

    </script>
</body>
</html>
