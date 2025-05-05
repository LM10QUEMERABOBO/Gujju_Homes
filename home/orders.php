<?php
session_start();
require("../shortlink/connection.php");

$pid=$_GET['pid'];
$uid=$_GET['uid'];

$q2="INSERT INTO my_orders (u_id,pr_id) VALUES ('".$uid."','".$pid."')";
$result2=mysqli_query($conn,$q2);

$q1="DELETE FROM bookings WHERE  pr_id='".$pid."' or u_id='".$uid."'";
 mysqli_query($conn,$q1);

 $q4="DELETE FROM fav_property WHERE  pr_id='".$pid."'";
 mysqli_query($conn,$q4);

 $q3="update property set status=1 where pr_id=".$pid;
 mysqli_query($conn,$q3);

if($result2){
    ?>
    <script>
        alert("Congratulations Your order has been confirmed!");
        window.top.location = './profile.php';
    </script>
 <?php
}


?>