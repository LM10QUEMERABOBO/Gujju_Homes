<?php
session_start();
require("../shortlink/connection.php");
if (!$conn) {

    ?>
        <script>
            alert("Error with the database, Please try after some time.");
        </script>
    <?php
}else{
$pid=$_GET['pid'];
$uid=$_GET['uid'];

 $q1="DELETE FROM bookings WHERE  pr_id='".$pid."' and u_id='".$uid."'";
 $result1=mysqli_query($conn,$q1);
if($result1){
    ?>
    <script>
        alert("Booking cancel successful.");
        window.top.location = './profile.php';
    </script>
 <?php
}
}
?>