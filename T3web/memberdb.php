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
$id= $_SESSION['id']; 
$pw = $_POST['pw'];   
$pwconfirm = $_POST['pwconfirm'];
$name = $_POST['name'];
$company = $_POST['company']; 
$tell = $_POST['tell'];


if( $pw==NULL || $pwconfirm==NULL || $name==NULL ||$company==NULL || $tell==NULL){
	echo "<script>window.alert('모두 입력하지 않으셨습니다.');</script>";
	echo "<script>location.href='member_check.php';</script>";
} 
else if($pw != $pwconfirm){
	echo "<script>window.alert('pw와 pwconfirm이 다릅니다.');</script>";
	echo "<script>location.href='member_check.php';</script>";
}
else {

	$sql = "update member set password='$pw', member_name='$name', company_name='$company', phone_number='$tell' where member_id='$id'"; 
	$parse=oci_parse($conn, $sql);
	oci_execute($parse);
	oci_commit($parse);
	echo "<script>window.alert('수정되었습니다.');</script>";
	echo "<script>location.href='user_main.php';</script>";
}

?>