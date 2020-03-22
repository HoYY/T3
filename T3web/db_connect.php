<?php
	putenv("NLS_LANG=KOREAN_KOREA.KO16MSWIN949"); // 한글 깨짐 현상 해결
    //DB 연결할 주소 설정
	$db = "(DESCRIPTION =(ADDRESS =(PROTOCOL = TCP)(HOST =203.249.87.162)(PORT = 1521))(CONNECT_DATA = (SID = orcl)))";
    //Env("ORACLE_HOME=/oracle/app/oracle/product/10.2.0");
	//DB 연결
	$id = "B489077";
	$pw = "wlsghdyd";
	$conn = OCILogon($id,$pw,$db);
	//에러 체크
	if($conn == false) {
		error("cn0000-1","데이타 베이스 공사 중 입니다");
	}
?>