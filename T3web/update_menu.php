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

<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <title>Update</title>
    <style>
    	.filebox label { 
    		position: relative;
    		display: inline-block; 
    		padding: .5em .75em; 
    		vertical-align: middle; 
    		cursor: pointer; 
    		margin: 3px 0 3px 0;
    		left: 5%;
    	}
    	.filebox input[type="file"] { /* 파일 필드 숨기기 */ 
    		position: absolute; 
    		width: 1px; 
    		height: 1px; 
    		padding: 0; 
    		margin: -1px; 
    		overflow: hidden; 
    		clip:rect(0,0,0,0); 
    		border: 0; 
    	}
    	/* named upload */ 
    	.filebox .upload-name { 
    		position: relative;
	    	padding: .5em .75em; /* label의 패딩값과 일치 */ 
	    	font-size: inherit; 
	    	font-family: inherit; 
	    	line-height: normal;
	    	vertical-align: middle; 
	    	background-color: #f5f5f5; 
	    	border: 1px solid #ebebeb; 
	    	border-bottom-color: #e2e2e2; 
	    	border-radius: .25em; 
	    	-webkit-appearance: none; /* 네이티브 외형 감추기 */ 
	    	-moz-appearance: none; 
	    	appearance: none;
	    	left: 5%;
    	 }
    </style>
</head>
<body>
	<br>
    <p style="text-align:center;"><font size='5' color='#7E6ECD'>메뉴수정</font></p>
    <br>
    <?php
        $menu_no = $_GET["index"];
        $query = "select menu_no, menu_name, menu_price, total_quantity, img_path from menu where menu_no = '".$menu_no."'";
        $result = oci_parse($conn, $query);
        oci_execute($result);
        $row = oci_fetch_array($result);
        ?>
        <form method='post' name='up' enctype="multipart/form-data" action='./update_mn.php' style="text-align:center;">
            <p>메뉴번호 : <input class="form-control" type='text' name='disabled' value="<?php echo $row[MENU_NO];?>" style="width:230px; margin:0 0 5px 0; display:inline-block;" disabled/></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;메뉴명 : <input class="form-control" type='text' name='menu_name' value="<?php echo $row[MENU_NAME];?>" style="width:230px; margin:0 0 5px 0; display:inline-block;" /></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;가격 : <input class="form-control" type='text' name='menu_price' value="<?php echo $row[MENU_PRICE];?>" style="width:230px; margin:0 0 5px 0; display:inline-block;"/></p>
            <p>가능수량 : <input class="form-control" type='text' name='total_quantity' value="<?php echo $row[TOTAL_QUANTITY];?>" style="width:230px; margin:0 0 5px 0; display:inline-block;"/></p>
            <div class="filebox" style="margin:-5px 0 10px -40px;">
		        <input class="upload-name" value="메뉴사진선택" disabled="disabled"/>
		        <label class="btn btn-default" for="memfile">파일선택...</label>
		        <input type="file" id="memfile" name="file" class="upload-hidden"/>
            </div>

            <input type="hidden" name="menu_no" value="<?php echo $menu_no;?>" />
            <input type="hidden" id="img_path" name="img_path" value="<?php echo $row[IMG_PATH];?>" />
            <button type='submit' class="btn btn-default" style="display:inline-block;">수정</button>
            <input type='button' class="btn btn-default" value='창닫기' onclick='Close();' style="display:inline-block;">
        </form>
    
    <script>
        $(document).ready(function(){ 
	    	var fileTarget = $('.filebox .upload-hidden'); 
	    	fileTarget.on('change', function(){ 
	    		// 값이 변경되면
	    		if(window.FileReader){ // modern browser 
	    			var filename = $(this)[0].files[0].name; 
	    		} 
	    		else { // old IE 
	    			var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출 
	    			} 
	    		// 추출한 파일명 삽입 
	    		$(this).siblings('.upload-name').val(filename);
                $("#img_path").val('images/'+filename);
	    		}); 
	    }); 

        function Close(){
    		window.opener.location.reload();
    		window.close();
    	}
    </script>
</body>
</html>
