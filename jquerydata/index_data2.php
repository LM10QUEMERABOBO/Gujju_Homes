<?php

$method= $_GET['method'];
$city= $_GET['city'];
$conn = mysqli_connect('localhost','root','','gujju_homes');
// mysqli_select_db($con,"gujju_homes");

$qry= "select DISTINCT type from property where status=0 and (city='".$city."' or rent_sell='".$method."')";
$rs= mysqli_query($conn,$qry);

?><option value="">Select Property Type Here</option>
<?php

while($row = $rs->fetch_assoc())
{
    echo "<option value='".$row['type']."' class='text-capitalize'>".$row['type']."</option>";
    
}

?>