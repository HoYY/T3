<?php
    session_start();
    include("./db_connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
    $order_quantity = $_POST['menu'];
    $menu_name = $_POST['menu_name'];
    $menu_no = $_POST['menu_no'];
    $count = 0;
    for($i=0 ; $i < count($_POST['menu']) ; $i++)
    {
            if($order_quantity[$i] == '0') {
                $count = $count + 1;
            }
    }
    if($count == count($_POST['menu'])){
        oci_close($conn);
        echo "<script>alert('주문할 메뉴를 선택해주십시요.');</script>";
        echo "<script>history.back();</script>";
    } else {
        for($i=0 ; $i < count($_POST['menu']) ; $i++)
        {
            if($order_quantity[$i] > 0) {
                $query1 = "select total_quantity from menu where menu_no = '".$menu_no[$i]."'";
                $result = oci_parse($conn, $query1);
                oci_execute($result);
                $row = oci_fetch_array($result);
                oci_free_statement($result);
                if($row[TOTAL_QUANTITY] < $order_quantity[$i]) {
                    oci_close($conn);
                    echo "<script>alert('".$menu_name[$i]." 메뉴의 수량이 부족합니다.');</script>";
                    echo "<script>location.href='./user_menu.php';</script>";
                }
            }
        }
        $today = date("Y/m/d");
        for($i=0 ; $i < count($_POST['menu']) ; $i++)
        {
            if($order_quantity[$i] > 0) {
                $order_number = mt_rand(1, 10000);
                $query2 = "insert into orderlist(order_number, menu_no, menu_name, member_id, order_quantity, order_date) 
                    values('".$order_number."', '".$menu_no[$i]."', '".$menu_name[$i]."', '".$_SESSION['id']."', '".$order_quantity[$i]."', '".$today."')";
                $parse2 = oci_parse($conn, $query2);
                oci_execute($parse2);
                oci_commit($parse2);
                $query3 = "update menu m set m.total_quantity = ((select n.total_quantity from menu n where n.menu_no = m.menu_no) - ".$order_quantity[$i].") where m.menu_no = '".$menu_no[$i]."'";
                $parse3 = oci_parse($conn, $query3);
                oci_execute($parse3);
                oci_commit($parse3);
                oci_free_statement($parse2);
                oci_free_statement($parse3);
            }
        }
        oci_close($conn);
        echo "<script>alert('주문 완료.');</script>";
        echo "<script>location.href='./user_menu.php';</script>";
    }
?>