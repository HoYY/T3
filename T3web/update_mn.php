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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
    $menu_no = $_POST["menu_no"];
    $menu_name = $_POST["menu_name"];
    $menu_price = $_POST["menu_price"];
    $total_quantity = $_POST["total_quantity"];
    $img_path = $_POST["img_path"];
    echo $img_path;
    $query = "update menu set menu_name = '".$menu_name."', menu_price = '".$menu_price."', total_quantity = '".$total_quantity."', img_path = '".$img_path."' where menu_no = '".$menu_no."'";
    $parse = oci_parse($conn, $query);
    oci_execute($parse);
	oci_commit($parse);
    if(oci_num_rows($parse)){
        echo "<script>alert('메뉴가 정상적으로 수정되었습니다.');</script>";
        echo "<script>opener.location.reload();</script>";
        echo "<script>window.close();</script>";
    } else {
        echo "<script>alert('메뉴 수정 중 오류가 발생하였습니다.');</script>";
        echo "<script>window.close();</script>";
    }
?>