<?php

$city = $_GET['city'];

$conn = mysqli_connect('localhost', 'root', '', 'gujju_homes');

    $qry = "select DISTINCT rent_sell from property where status=0 and city='" . $city . "'";
    $rs = mysqli_query($conn, $qry);

    ?><option value="">Select Property Option Here</option><?php

    while ($row = $rs->fetch_assoc()) {
        echo "<option value='" . $row['rent_sell'] . "' class='text-capitalize'>" . $row['rent_sell'] . "</option>";
    }

?>