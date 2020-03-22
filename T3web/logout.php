<?php
    session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    session_destroy();
    echo "<script>location.href='./main.html';</script>";
?>