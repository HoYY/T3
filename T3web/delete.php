<?php
session_start();
if(is_null($_SESSION['id'])) {
    echo "<script>window.alert('로그인 해주세요');</script>";
    echo "<script>location.href='./main.html';</script>";
  }
?>
<meta charset="utf-8"/>
<?php    
include("./db_connect.php");
    $id=$_SESSION['id'];
    $sql = "delete from member where member_id='$id'";
    $parse=oci_parse($conn, $sql);
	oci_execute($parse);
    oci_commit($parse);
    echo "<script>window.alert('탈퇴되었습니다.');</script>";
    echo "<script>location.href='main.html';</script>";
    session_destroy();
    ?>