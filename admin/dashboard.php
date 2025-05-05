<?php
session_start();

if (!isset($_SESSION['u_id'])) {
  header("location: ../login-signup/login.php");
}

if ($_SESSION['counter'] == 0) {
?>
  <script>
    alert("Welcome <?php echo $_SESSION['u_name'] ?>");
  </script>
<?php
  $_SESSION['counter']++;
}

require("../shortlink/connection.php");

if (!$conn) {

?>
  <script>
    alert("Error with the database, Please try after some time.");
  </script>
<?php

} else {
  $id = $_SESSION['u_id'];
  $q = "SELECT username, photo FROM admin_info WHERE admin_id=" . $id;
  $match = mysqli_query($conn, $q);
  $res = mysqli_num_rows($match);
  $row = mysqli_fetch_assoc($match);

  $q1 = "SELECT * FROM user";
  $result = mysqli_query($conn, $q1);
  $count1 = mysqli_num_rows($result);

  $q2 = "SELECT * FROM property";
  $result1 = mysqli_query($conn, $q2);
  $count2 = mysqli_num_rows($result1);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>

  <!-- User Stylesheet -->
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    #dashboard {
      background-color: #eee;
    }

    #dashboard i {
      color: var(--main-color);
    }

    @media (max-width: 572px) {
      .signup {
        display: none;
      }
    }

    .fa-search {
      display: none;
    }
  </style>

</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">

    </div>
  </div>
  <!-- Spinner End -->

  <!-- This will add HEADER -->
  <?php require("../shortlink/admin_header.php") ?>

  <div class="container">

    <!-- This will add Side Menu Bar of Admin -->
    <?php require("../shortlink/admin_sidebar.php") ?>

    <section class="main">
      <h3>Dashboard</h3>

      <div class="users">
        <div class="cards">

          <p>Total Users:</p>
          <p><?php echo $count1;  ?></p>
          <button><a href="./user_list.php" style="all: unset !important;">Details</a></button>

        </div>
        <div class="cards">

          <p>Total Properties:</p>
          <p><?php echo $count2;  ?></p>
          <button><a href="./Manage_Properties.php" style="all: unset !important;">Details</a></button>

        </div>
      </div>
    
    </section>
  </div>

  <!-- The below bothe link for spinner -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    function onLogout() {
      if (confirm("Are you sure, You want to Logout?") == 1) {

        window.top.location = '../login-signup/logout.php';

      }
    }
  </script>
</body>

</html>