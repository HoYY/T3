<?php
    session_start();
	include("./db_connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    if(is_null($_SESSION['id'])) {
      echo "<script>window.alert('로그인 해주세요');</script>";
      echo "<script>location.href='./main.html';</script>";
    }
    else if($_SESSION['id'] != 'admin'){
      echo "<script>window.alert('권한이 없습니다.');</script>";
      echo "<script>location.href='./user_main.php';</script>";
    }

	$menu_no = $_POST['checkinfo'];
	if($menu_no == null){
		echo "<script>alert('삭제할 메뉴를 선택해주십시요.');</script>";
		echo "<script>history.back();</script>";
	} else {
		for($i=0 ; $i < count($_POST['checkinfo']) ; $i++)
		{
            $query1 = "select img_path from menu where menu_no = '".$menu_no[$i]."'";
            $result = oci_parse($conn, $query1);
            oci_execute($result);
            $row = oci_fetch_array($result);
            $img_path = $row[IMG_PATH];
			$query2 = "delete from menu where menu_no = '".$menu_no[$i]."'";
			$parse = oci_parse($conn, $query2);
			oci_execute($parse);
            oci_commit($parse);
            if(!oci_num_rows($parse)){
                echo "<script>alert('메뉴 삭제 중 오류가 발생하였습니다. 주문목록을 확인하십시요.');</script>";
                echo "<script>location.href='./admin_menu.php';</script>";
            }
		}
		echo "<script>alert('삭제 완료.');</script>";
		echo "<script>location.href='./admin_menu.php';</script>";
	}
?>