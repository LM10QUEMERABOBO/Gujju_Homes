<?php
session_start();

require("../shortlink/connection.php");

$del = "delete from property where pr_id=" . $_GET['id'];

if (mysqli_query($conn, $del)) {
?>
    <script>
        alert("Property deleted successfully.");
        window.top.location = './Manage_Properties.php';
    </script>
<?php

}
else{
    ?>
    <script>
        alert("Error");
        window.top.location = './Manage_Properties.php';
    </script>
<?php
}
?>