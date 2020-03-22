<?php
    session_start();
    include("./db_connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
    $id=$_POST['id'];
    $pw=$_POST['pw'];

    $query = "select * from member where member_id = '$id' and password ='$pw'";
    $parse = oci_parse($conn, $query);
    oci_execute($parse);
    $row = oci_fetch_array($parse);
    oci_free_statement($parse);
    oci_close($conn);
    if(is_null($row[MEMBER_ID])) {
        echo "<script>window.alert('잘못된 아이디 혹은 비밀번호입니다.');</script>";
        echo "<script>location.href='./login.php';</script>";
    }
    else{
        $_SESSION['id']=$row[MEMBER_ID];
        $_SESSION['name']=$row[MEMBER_NAME];
        if($_SESSION['id']=="admin") {
            echo "<script>window.alert('관리자로 로그인');</script>";
            echo "<script>location.href='./admin_main.php';</script>";
        }
        else {
            echo "<script>window.alert('로그인 되었습니다.');</script>";
            echo "<script>location.href='./user_main.php';</script>";
        }
	}
?>

