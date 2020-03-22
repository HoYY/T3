<!doctype html>

<html>
    <head>
        <meta charset="utf-8"/>
    </head>

    <body>
        <h1>test main 2 회원관리</h1>

        <a href="testmain1.php"><strong>[주문조회]</strong></a>
        <a href="testmain3.php"><strong>[메뉴관리]</strong></a>
        
        <p align="center">
            <?
	            putenv("NLS_LANG=KOREAN_KOREA.KO16MSWIN949"); // 한글 깨짐 현상 해결
                //DB 연결할 주소 설정
	            $db = "(DESCRIPTION =(ADDRESS =(PROTOCOL = TCP)(HOST =203.249.87.162)(PORT = 1521))(CONNECT_DATA = (SID = orcl)))";
                //Env("ORACLE_HOME=/oracle/app/oracle/product/10.2.0");
	            //DB 연결
	            $id = "B489077";
	            $pw = "wlsghdyd";
	            $connect = OCILogon($id,$pw,$db);
	            //에러 체크
	            if($connect == false) {
		            error("cn0000-1","데이타 베이스 공사 중 입니다");
                }
                
                 //SQL문 작성
                 $sql = "select *from CELLAR order by BIN#";
                 //SQL문 파싱(and 검사)
                 $stmt = OCIParse($connect,$sql);
                 //SQL문 보내기
                 OCIExecute($stmt);
 
                 //결과 테이블 가져와서
                 //$sql에 레코드 한줄씩 읽어와서
                 //결과 테이블의 마지막일 때까지 출력
                 echo"<table border='1'>\n";
                 echo"<table width='800 border='1'>\n";
                 echo"<tr>\n";
                 echo"<th>번호</th>\n";
                 echo"<th>와인이름</th>\n";
                 echo"<th>생산자</th>\n";
                 echo"<th>년도</th>\n";
                 echo"<th>개수</th>\n";
                 echo"</tr>\n";
 
                 while(OCIFetchInto($stmt,$sql)) {
                     echo"<tr>\n";
                     echo"<td align='center'>".$sql[0]."</td>\n";
                     echo"<td align='center'>".$sql[1]."</td>\n";
                     echo"<td align='center'>".$sql[2]."</td>\n";
                     echo"<td align='center'>".$sql[3]."</td>\n";
                     echo"<td align='center'>".$sql[4]."</td>\n";
                     echo"</tr>\n";
                 }
                 echo"</table>\n";
 
                 // 연결 해제
                 OCIFreeStatement($stmt);
                 OCILogoff($connect);
            ?>
        </p>

    </body>
</html>