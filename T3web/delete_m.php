<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//체크한 주문번호와 주문자의 폰번호를 받아와 delete문 실행
include("./db_connect.php");
$member_id = $_POST['checkinfo'];
if($member_id == null){
	echo "<script>alert('삭제할 회원을 선택해주십시요.');</script>";
	echo "<script>history.back();</script>";
} else {
	for($i=0 ; $i < count($_POST['checkinfo']) ; $i++)
	{
		$query = "delete from member where member_id = '".$member_id[$i]."'";
		$parse = oci_parse($conn, $query);
		oci_execute($parse);
		oci_commit($parse);
	}
	echo "<script>alert('삭제 완료.');</script>";
	echo "<script>location.href='./admin_memb.php';</script>";
}
?>