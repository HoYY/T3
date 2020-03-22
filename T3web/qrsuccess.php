<meta charset="UTF-8">
<?php
include("./db_connect.php"); 
$id=$_GET['id'];
$today = date("Y/m/d");
$sql = "select menu_name,sum(order_quantity) as count from orderlist where member_id ='$id' and order_date='$today' group by menu_name";
$result = oci_parse($conn,$sql);  
oci_execute($result);
for($i=0;$array =oci_fetch_array($result);$i++)
			{
                $a.=$array[MENU_NAME];
                $a.=" ";
                $a.=$array[COUNT];
                $a.="개 ";
            }

        echo "<script>window.alert('오늘 주문하신 메뉴는 ".$a."입니다');</script>";
?>
