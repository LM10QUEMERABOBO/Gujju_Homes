<?php
session_start();

if (!isset($_SESSION['u_id'])) {
  header("location: ../login-signup/login.php");
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

  $q1 = "SELECT * FROM property";
  $result = mysqli_query($conn, $q1);

  // $match=mysqli_query($conn,$q1);
  // $res =mysqli_num_rows($match);
  // $row = mysqli_fetch_assoc($match);
  $i = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Manage Properties</title>

  <!-- User Stylesheet -->
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    #manage {
      background-color: #eee;
    }

    #manage i {
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
      <h3>Manage Properties</h3>

      <section class="Manage Properties">
        <div class="list">
          <h5>Properties List:-</h5>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>City</th>
                <th>Address</th>
                <th>Rent/Sell</th>
                <th>Own By</th>
                <th>Registered At</th>
                <th style="text-align:center;">-</th>
              </tr>
            </thead>
            <tbody>
            <?php
             
             while ($row = $result->fetch_assoc()) {
              
              $q2 = "SELECT username, address FROM user where u_id=".$row['u_id'];
              $result2 = mysqli_fetch_assoc(mysqli_query($conn, $q2));

               echo "<tr>";

               echo "<td>" . $i . "</td>";
               echo "<td>" . $row['city'] . "</td>";
               echo "<td>" . $row['area'].", ".$row['society'].", ".$row['city']. "</td>";
               echo "<td>" . $row['rent_sell'] . "</td>";
               echo "<td>" . $result2['username'] . "</td>";
               echo "<td>" . $row['p_date'] . "</td>";
               echo "<td style='text-align:center;'><a href='delete_prop.php?id=".$row['pr_id']."'><i class='fa fa-trash' style='color: red; font-size:20px;'></i></a></td>";
       
               echo "</tr>";
               $i++;
           }
           ?>
            </tbody>
          </table>
        </div>
      </section>
    </section>
  </div>
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