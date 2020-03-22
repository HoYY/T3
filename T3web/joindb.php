<meta charset="utf-8"/>
<?php
include("./db_connect.php");
$id = $_POST['id'];  
$pw = $_POST['pw'];   
$pwconfirm = $_POST['pwconfirm'];
$name = $_POST['name'];
$company = $_POST['company']; 
$tell = $_POST['tell'];
$query = "select member_id from member where member_id='$id'";
$result = oci_parse($conn,$query);  
oci_execute($result);
$row = oci_fetch_array($result);

if($id==NULL || $pw==NULL || $pwconfirm==NULL || $name==NULL ||$company==NULL || $tell==NULL){
	echo "<script>window.alert('모두 입력하지 않으셨습니다.');</script>";
	echo "<script>location.href='signup.php';</script>";
} 
else if($pw != $pwconfirm){
	echo "<script>window.alert('pw와 pwconfirm이 다릅니다.');</script>";
	echo "<script>location.href='signup.php';</script>";
}
else if (!is_null($row[MEMBER_ID])){
	echo "<script>window.alert('id 중복됩니다.');</script>";
	echo "<script>location.href='signup.php';</script>";
}
else {
	$qr = "http://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=cic.hongik.ac.kr/a_team/a_team4/qrsuccess.php/?id=$id";
	$sql = "insert into member(member_id, password, member_name, company_name, phone_number) values('$id', '$pw', '$name','$company', '$tell')";
	$parse=oci_parse($conn, $sql);
	oci_execute($parse);
	oci_commit($parse);
	$sql1 = "insert into qrcode(qr_code, member_id) values('$qr', '$id')";
	$parse1=oci_parse($conn, $sql1);
	oci_execute($parse1);
	oci_commit($parse1);
	
	echo "<script>window.alert('가입되었습니다.');</script>";

	echo "<script>location.href='main.html';</script>";
}

?>