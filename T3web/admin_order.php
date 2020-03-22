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
    .textbox {position: relative; display:inline-block; width: 200px; margin: 28px 20px 0 5px}

.textbox label {
  position: absolute;
  top: 1px;  /* input 요소의 border-top 설정값 만큼 */
  left: 1px;  /* input 요소의 border-left 설정값 만큼 */
  padding: .8em .5em;  /* input 요소의 padding 값 만큼 */
  color: #999;
  cursor: text;
}

.textbox input[type="text"],
.textbox input[type="password"] {
  width: 100%;  /* 원하는 너비 설정 */ 
  height: auto;  /* 높이값 초기화 */
  line-height : normal;  /* line-height 초기화 */
  padding: .8em .5em; /* 원하는 여백 설정, 상하단 여백으로 높이를 조절 */
  border: 1px solid #999;
  border-radius: 0;  /* iSO 둥근모서리 제거 */
  outline-style: none;  /* 포커스시 발생하는 효과 제거를 원한다면 */
  -webkit-appearance: none;  /* 브라우저별 기본 스타일링 제거 */
  -moz-appearance: none;
  appearance: none;
}

    select {
  width: 100px;
  padding: .8em .5em;
  font-family: inherit;
  background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: 1px solid #999;
  border-radius: 10px;
  margin:20px 10px 0px 0;;
}

select::-ms-expand {
  /* for IE 11 */
  display: none;
}
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
</style>

<script>
 $(document).ready(function(){

  $().UItoTop({ easingType: 'easeOutQuart' });
  $('#stuck_container').tmStickUp({});
  $('.gallery .gall_item').touchTouch();

  var select = $("select#color");
    
    select.change(function(){
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });
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
                <li><a href="admin_main.php">home</a></li>
                <li><a href="./admin_menu.php">menu</a></li>
                <li><a href="./admin_memb.php">member</a></li>
                <li class="current"><a href="./admin_order.php">order</a></li>
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
    <div class="container">
        <form action="./admin_order.php" method="post">
        <select name="select">
            <option selected>검색옵션</option>
            <option value="mem">회원ID</option>
        </select>

        <div class="textbox">
        <label for="ex_input"></label>
        <input type="text" id="ex_input" name="search">
        </div> 
        <button class="btn btn-outline-success" type="submit" style="width:100px; padding:10px 20px 10px 20px; margin:25px 0 0 0;">검 색</button>
        </form>
        <?php
        $select = $_POST['select'];
        if(is_null($select)) {?>
        <table class='type02' style="text-align:center; margin:2% 0 0 0;">
		    <tr>
                <th>주문번호</th>
                <th>메뉴명</th>
                <th>회원ID</th>
                <th>주문수량</th>
                <th>메뉴가격</th>
                <th>주문날짜</th>
                <th>회원이름</th>
                <th>전화번호</th>
                <th>소속회사</th>
                <th>회사번호</th>
			</tr>
            <?php
            $query1 = "select orderlist.order_number, orderlist.menu_name, orderlist.member_id, orderlist.order_quantity, menu.menu_price, orderlist.order_date, 
                        member.member_name, member.phone_number, member.company_name, company.company_phonenumber from orderlist, member, menu, company 
                        where orderlist.member_id = member.member_id and orderlist.menu_no = menu.menu_no and member.company_name = company.company_name";
            $result1 = oci_parse($conn, $query1);
            oci_execute($result1);
            for($i=0;$array = oci_fetch_array($result1);$i++)
            {
                echo "
                <tr>
                <td>".
                $array[ORDER_NUMBER]."
                </td>
                <td>".
                $array[MENU_NAME]."
                </td>
                <td>".
                $array[MEMBER_ID]."
                </td>
                <td>".
                $array[ORDER_QUANTITY]."
                </td>
                <td>".
                $array[MENU_PRICE]."
                </td>
                <td>".
                $array[ORDER_DATE]."
                </td>
                <td>".
                $array[MEMBER_NAME]."
                </td>
                <td>".
                $array[PHONE_NUMBER]."
                </td>
                <td>".
                $array[COMPANY_NAME]."
                </td>
                <td>".
                $array[COMPANY_PHONENUMBER]."
                </td>
                </tr>";
      }
      oci_free_statement($result1);
      oci_close($conn);
	    echo "
		</table>
	    ";
        }
        else if($select = 'mem') {
        $member_id = $_POST['search'];?>
        <table class='type02' style="text-align:center; margin:2% 0 0 0;">
		    <tr>
                <th>주문번호</th>
                <th>메뉴명</th>
                <th>회원ID</th>
                <th>주문수량</th>
                <th>메뉴가격</th>
                <th>주문날짜</th>
                <th>회원이름</th>
                <th>전화번호</th>
                <th>소속회사</th>
                <th>회사번호</th>
			</tr>
            <?php
            $query2 = "select orderlist.order_number, orderlist.menu_name, orderlist.member_id, orderlist.order_quantity, menu.menu_price, orderlist.order_date, 
                        member.member_name, member.phone_number, member.company_name, company.company_phonenumber from orderlist, member, menu, company 
                        where orderlist.member_id = member.member_id and orderlist.menu_no = menu.menu_no and member.company_name = company.company_name 
                        and member.member_id = '".$member_id."'";
            $result2 = oci_parse($conn, $query2);
            oci_execute($result2);
            for($i=0;$array = oci_fetch_array($result2);$i++)
            {
                echo "
                <tr>
                <td>".
                $array[ORDER_NUMBER]."
                </td>
                <td>".
                $array[MENU_NAME]."
                </td>
                <td>".
                $array[MEMBER_ID]."
                </td>
                <td>".
                $array[ORDER_QUANTITY]."
                </td>
                <td>".
                $array[MENU_PRICE]."
                </td>
                <td>".
                $array[ORDER_DATE]."
                </td>
                <td>".
                $array[MEMBER_NAME]."
                </td>
                <td>".
                $array[PHONE_NUMBER]."
                </td>
                <td>".
                $array[COMPANY_NAME]."
                </td>
                <td>".
                $array[COMPANY_PHONENUMBER]."
                </td>
                </tr>";
      }
      oci_free_statement($result2);
      oci_close($conn);
	    echo "
		</table>
	    ";
        }    
        ?>
    </div>
</select>


</body>
</html>
