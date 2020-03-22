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

    $query = "insert into menu(menu_no, menu_name, menu_price, total_quantity, img_path) values ('".$menu_no."', '".$menu_name."', '".$menu_price."', '".$total_quantity."', '".$img_path."')";
    $parse = oci_parse($conn, $query);
    oci_execute($parse);
    oci_commit($parse);
    
    // 설정
    $uploads_dir = '/var/www/html/a_team/a_team4/';
    $allowed_ext = array('jpg','jpeg','png','gif','PNG','JPG');
    
    
    // 변수 정리
    $error = $_FILES['file']['error'];
    $name = $_FILES['file']['name'];
    $ext = array_pop(explode('.', $name));

    // 오류 확인
    if($error != UPLOAD_ERR_OK) {
        switch($error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "파일이 너무 큽니다. ($error)";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "파일이 첨부되지 않았습니다. ($error)";
                break;
            default:
                echo "파일이 제대로 업로드되지 않았습니다. ($error)";
        }
        exit;
    }
    
    // 확장자 확인
    if(!in_array($ext, $allowed_ext)) {
        echo "허용되지 않는 확장자입니다.";
        exit;
    }
    
    // 파일 이동
    move_uploaded_file($_FILES['file']['tmp_name'], $uploads_dir.$name);
    
    if(oci_num_rows($parse)){
        oci_free_statement($parse);
        oci_close($conn);
        echo "<script>alert('메뉴가 정상적으로 추가되었습니다.');</script>";
        echo "<script>opener.location.reload();</script>";
        echo "<script>window.close();</script>";
    } else {
        oci_free_statement($parse);
        oci_close($conn);
        echo "<script>alert('메뉴 추가 중 오류가 발생하였습니다.');</script>";
        echo "<script>window.close();</script>";
    }
?>