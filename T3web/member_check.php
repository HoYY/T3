<?php
session_start();
if(is_null($_SESSION['id'])) {
  echo "<script>window.alert('로그인 해주세요');</script>";
  echo "<script>location.href='./main.html';</script>";
}
?>
<meta charset="UTF-8">
<?php
include("./db_connect.php");
$id = $_SESSION['id'];
$pw=$_POST['pw'];  

$query = "select * from member,qrcode where member.member_id = '$id' and member.password ='$pw' and member.member_id=qrcode.member_id";
$parse = oci_parse($conn, $query);
oci_execute($parse);
$row = oci_fetch_array($parse);
if($pw==NULL){
   echo "<script>window.alert('비밀번호를 입력해주세요.');</script>";
   echo "<script>location.href='member.php';</script>";
   }

else if(!is_null($row[MEMBER_ID]))  
   {
      $pw=$row[PASSWORD];
      $name=$row[MEMBER_NAME];
      $company=$row[COMPANY_NAME];
      $number=$row[PHONE_NUMBER];
      $url=$row[QR_CODE];
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
<link rel="stylesheet" href="css/table.css">
<link rel="stylesheet" href="css/button.css">
<script src="js/jquery.js"></script>
<script sr  c="js/jquery-migrate-1.1.1.js"></script>
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
                <li><a href="user_menu.php">menu</a></li>
                <li  class="current"><a href="member.php">mypage</a></li>
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
  <br/><br/>
   <?php
  
    
    echo"<p align = center><img src='$url' width=200 height=200><p/>";
    ?>

    <form action='memberdb.php' name='DB' method='POST'>
    <table class="type02" >
        
        <tr>
            <th  scope="row"><h3>아이디</h3></th>
            <td><?=$_SESSION['id']?></td>
        </tr>
        <tr>
            <th  scope="row"><h3>비밀번호</h3></th>
            <td><input type="password" name="pw" value=<?=$pw?> ></td>
        </tr>
        <tr>
            <th  scope="row"><h3>비밀번호 확인</h3></th>
            <td><input type="password" name="pwconfirm"value=<?=$pw?>></td>
        </tr>
        <tr>
            <th  scope="row"><h3>이름</h3></th>
            <td><input type="text" name="name" value=<?=$name?>></td>
        </tr>
        <tr>
            <th scope="row"><h3>회사</h3></th>
            <td><input type="text" name="company" value=<?=$company?>></td>
        </tr>
        <tr>
            <th  scope="row"><h3>휴대폰</h3></th>
            <td><input type="text" name="tell" value=<?=$number?>></td>
        </tr>
        <tr>
        <th colspan="2"><button>수정</button></th>
</tr>
<tr>
        <th colspan="2"><button type="button" onclick="location.href='delete.php' ">탈퇴</button></th>
</tr>
      </table>
</form>
    <br>
    
    <table class="type02">
    <tr>
      <th colspan="5"><h3>오늘 주문 목록<h3></th>
    </tr>  
    <tr>
				<th><h3>주문번호</h3></th>
				<th><h3>메뉴</h3></th>
				<th><h3>주문수량</h3></th>
				<th><h3>메뉴가격</h3></th>
        <th><h3>주문날짜</h3></th>
			</tr>
   <?php
   $today = date("Y/m/d");
   $query3 = "select * from member,orderlist,menu where member.member_id = '$id' and password='$pw' and 
   member.member_id=orderlist.member_id and orderlist.menu_name=menu.menu_name and orderlist.order_date='$today'";
   $result3 = oci_parse($conn,$query3);  
   oci_execute($result3);
    for($i=0;$array =oci_fetch_array($result3);$i++)
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
					$array[ORDER_QUANTITY]."
                </td>
                <td>".
					$array[MENU_PRICE]."
                </td>
                <td>".
					$array[ORDER_DATE]."
				</td>
			</tr>";
			}
			echo "</table>
			";

?>
        </div>
	</body>
</html>

 <?
   }

   else{
         echo "<script>window.alert('잘못된 비밀번호입니다.');</script>";
         echo "<script>location.href='member.php';</script>";
      }

?>