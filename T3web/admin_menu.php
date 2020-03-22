<?php
    session_start();
    include("./db_connect.php");
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

<style>
    table.type02 {

        margin:auto;
        border-collapse: separate;
        border-spacing: 0;
        text-align: center;
        line-height: 1.5;
        border-top: 1px #BDBDBD;
        border-left: 1px #BDBDBD;

    }
    table.type02 th {
        width: 300px;
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
        border-right: 1px #BDBDBD;
        border-bottom: 1px #BDBDBD;
        border-top: 1px solid #fff;
        border-left: 1px solid #fff;
        background: #eee;
    }
    table.type02 th.button {
        width: 300px;
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
    }
    table.type02 td {
        width: 250px;

        padding: 10px;
        vertical-align: top;
        border-right: 1px #BDBDBD;
        border-bottom: 1px #BDBDBD;
    }
<?php
    $query = "select menu_name from menu";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    for($i=0;$array = oci_fetch_array($result);$i++)
    {
    echo "
        input[id='cb".$i."'] + label {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #bcbcbc;
            cursor: pointer;
        }
        input[id='cb".$i."']:checked + label {
            background-color: #666666;
        }
        input[id='cb".$i."'] {
            display: none;
        }
    ";
    }
    ?>
</style>

<script>
 $(document).ready(function(){

  $().UItoTop({ easingType: 'easeOutQuart' });
  $('#stuck_container').tmStickUp({});
  $('.gallery .gall_item').touchTouch();

  });

  function add()
  {
    window.name = "add";
	var OpenCW = "./add_menu.php";
    OpenWin = window.open(OpenCW, "Add", "width=570, height=400, resizable = no, scrollbars = no");    
  }

  function upd()
  {
    var index;
	var size = document.getElementsByName("checkinfo[]").length;
	for(var i = 0; i < size; i++){
	  if(document.getElementsByName("checkinfo[]")[i].checked == true){
	    index = document.getElementsByName("checkinfo[]")[i].value;
      }
	}
    window.name = "update"; 
	var OpenCW = "./update_menu.php?index=" + index;
    OpenWin = window.open(OpenCW, "Update", "width=570, height=400, resizable = no, scrollbars = no");    
  }

  function del()
  {
    document.getElementById('aa').setAttribute("action", "./delete_mn.php");
	document.getElementById('aa').submit();
  }
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
                <li><a href="admin_main.php">home</a></li>
                <li class="current"><a href="./admin_menu.php">menu</a></li>
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

  <section class="content">
    <div class="container" style="height:80vh;">
        <form id="aa" name="change" method="post">
        <table class='type02' style="text-align:center; margin:5% 0 0 0;">
		    <tr>
                <th></th>
                <th>메뉴번호</th>
                <th>메뉴명</th>
                <th>가격</th>
                <th>가능수량</th>
                <th>이미지경로</th>
			  </tr>
            <?php
            $query = "select menu_no, menu_name, menu_price, total_quantity, img_path from menu";
            $result = oci_parse($conn, $query);
            oci_execute($result);
            for($i=0;$array = oci_fetch_array($result);$i++)
            {
                echo "
                <tr>
                <td><input type='checkbox' id='cb".$i."' name='checkinfo[]' value='".$array[MENU_NO]."'><label for='cb".$i."'></label></td>
                <td>".
                $array[MENU_NO]."
                </td>
                <td>".
                $array[MENU_NAME]."
                </td>
                <td>".
                $array[MENU_PRICE]."
                </td>
                <td>".
                $array[TOTAL_QUANTITY]."
                </td>
                <td>".
                $array[IMG_PATH]."
                </td>
                </tr>";
			}
	    echo "
		</table>
      ";
      oci_free_statement($result);
      oci_close($conn);
        ?>
        <button class="btn btn-outline-success" type="button" onclick="add();" style="width:100px; padding:10px 20px 10px 20px;">추 가</button>
        <button class="btn btn-outline-success" type="button" onclick="upd();" style="width:100px; padding:10px 20px 10px 20px;">수 정</button>
        <button class="btn btn-outline-success" type="button" onclick="del();" style="width:100px; padding:10px 20px 10px 20px;">삭 제</button>
        </form>
	</div>

</body>
</html>
