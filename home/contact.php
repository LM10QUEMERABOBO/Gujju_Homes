<?php
session_start();

require("../shortlink/connection.php");

if (isset($_SESSION['u_id'])) {
  $id = $_SESSION['u_id'];
  $q = "SELECT * FROM user WHERE u_id=" . $id;
  $match = mysqli_query($conn, $q);
  $res = mysqli_num_rows($match);
  $row = mysqli_fetch_assoc($match);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>

  <!-- LInk To CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="./contact.css">

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    @media (max-width: 572px) {
      .signup {
        display: none;
      }
    }

    #contact {
      background: var(--mainhover-color) !important;
    }
  </style>

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"> -->
</head>

<body class="body">

  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">

    </div>
  </div>
  <!-- Spinner End -->

  <!-- This will add Header -->
  <?php if (!isset($_SESSION['u_id'])) {
    require("../shortlink/header.php");
  } else {
    require("../shortlink/home_head.php");
  } ?>

    <div class="back2">
    <div class="back1">

      <!-- This will add cotact us -->
      <?php require("../shortlink/contact_body.php") ?>

    </div>
  </div>

  <!-- This will add Footer -->
  <?php if (!isset($_SESSION['u_id'])) {
    require("../shortlink/footer.php");
  } else {
    require("../shortlink/home_foot.php");
  } ?>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    document.getElementById("search").style.display = "none";
    
    function onLogout() {
            if (confirm("Are you sure, You want to Logout?") == 1) {

                window.top.location = '../login-signup/logout.php';
            }
        }
  </script>
</body>

</html>