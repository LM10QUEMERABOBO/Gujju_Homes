<?php
session_start();
require("../shortlink/connection.php");

$pid = $_GET['pid'];
$uid = $_SESSION['u_id'];

$q = "select * from fav_property where pr_id=" . $pid . " and u_id=" . $uid;
$r = mysqli_query($conn, $q);
if (mysqli_fetch_row($r) > 0) {
    $q = "delete from fav_property where pr_id=" . $pid . " and u_id=" . $uid;
    $r = mysqli_query($conn, $q);
?><script>
        alert('Property Unsaved');

        window.top.location = './filter.php';
    </script>
<?php
} else {
    $q = "insert into fav_property(pr_id, u_id) values(" . $pid . "," . $uid . ")";
    $r = mysqli_query($conn, $q);
?><script>
        alert('Property Saved');
        window.top.location = './filter.php';
    </script>
<?php
}

?>