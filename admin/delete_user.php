<?php
session_start();

require("../shortlink/connection.php");

$del = "delete from user where u_id=" . $_GET['id'];

if (mysqli_query($conn, $del)) {
?>
    <script>
        alert("User deleted successfully.");
        window.top.location = './user_list.php';
    </script>
<?php

}
else{
    ?>
    <script>
        alert("Error");
        window.top.location = './user_list.php';
    </script>
<?php
}
?>