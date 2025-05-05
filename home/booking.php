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
$uid1 = $_GET['uid'];

$uid=$_SESSION['u_id'];

 $q1="SELECT * FROM bookings WHERE u_id='".$uid."' and pr_id='".$pid."'";
 $result1=mysqli_query($conn,$q1);

if($row = $result1->fetch_assoc()){
?>
     <script>
        alert("You have already booked this property");
        window.top.location = './property.php?pid=<?php echo $pid?>&uid=<?php echo $uid1; ?>';
    </script>
<?php
}
else{
$q2="INSERT INTO bookings (u_id,pr_id) VALUES ('".$uid."','".$pid."')";
$result2=mysqli_query($conn,$q2);
if($result2){
    ?>
    <script>
        alert("Booking Confirmed! Wait for the owners response");
        window.top.location = './property.php?pid=<?php echo $pid?>&uid=<?php echo $uid1; ?>';
    </script>
 <?php
}
}
}
?>