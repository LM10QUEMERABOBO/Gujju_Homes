<?php
session_start();

require("../shortlink/connection.php");

$del = "delete from contact where sr_id=" . $_GET['id'];

if (mysqli_query($conn, $del)) {
?>
    <script>
        alert("Mail has been deleted.");
        window.top.location = './Emails.php';
    </script>
<?php

}
else{
    ?>
    <script>
        alert("Error");
        window.top.location = './Emails.php';
    </script>
<?php
}
?>