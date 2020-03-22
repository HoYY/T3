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
    <title>Add</title>
    
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
    <p style="text-align:center;"><font size='5' color='#7E6ECD'>메뉴추가</font></p>
    <br>
        <form method='post' name='add' enctype="multipart/form-data" action='./insert_mn.php' style="text-align:center;">
            <p>메뉴번호 : <input class="form-control" type='text' name='menu_no' placeholder='메뉴번호는 1~6 사이의 숫자입니다.' style="width:230px; margin:0 0 5px 0; display:inline-block;"/></p>
            <p>&nbsp;&nbsp;&nbsp;메뉴명 : <input class="form-control" type='text' name='menu_name' style="width:230px; margin:0 0 5px 0; display:inline-block;"/></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;가격 : <input class="form-control" type='text' name='menu_price' style="width:230px; margin:0 0 5px 0; display:inline-block;"/></p>
            <p>가능수량 : <input class="form-control" type='text' name='total_quantity' style="width:230px; display:inline-block;"/></p>
            <div class="filebox" style="margin:-5px 0 10px -55px;">
		        <input class="upload-name" value="메뉴사진선택" disabled="disabled"/>
		        <label class="btn btn-default" for="memfile">파일선택...</label>
		        <input type="file" id="memfile" name="file" class="upload-hidden"/>
            </div>

            <input type="hidden" id="img_path" name="img_path" value="" />
            <button type='submit' id="upload" class="btn btn-default" disabled="true" style="display:inline-block;">추가</button>
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
	    		$("#upload")[0].disabled = false;
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
