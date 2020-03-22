<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<script language="javascript">
    msg = "정말로 로그아웃을 하시겠습니까?";
    if (confirm(msg)!=0) {
        location.href='./logout.php';
    }
    else {
        history.back(-1);
    }
</script>
</head>
<body>
</body>
</html>

