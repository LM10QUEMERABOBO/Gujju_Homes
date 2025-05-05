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

  $q1 = "SELECT * FROM user";
  $result = mysqli_query($conn, $q1);
  // $res =mysqli_num_rows($match);
  //$row = mysqli_fetch_assoc($match);
  $i = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>User List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- User Stylesheet -->
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    #user {
      background-color: #eee;
    }

    #user i {
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
      <h3>Manage Users</h3>


      <section class="Manage Users">
        <form method="post">
          <div class="list">
            <div class="d-flex justify-content-between align-items-center">
              <h5>Users List:-</h5>
              <!-- <div class="dhairya">
                <input type="text" id="search" placeholder="Search Name" name="search">
                <label for="search" class="search"><i class="fa fa-search" style="display:inline;"></i></label>

              </div> -->
            </div>

            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Mobile</th>
                  <th>City</th>
                  <th>Joined At</th>
                  <th style="text-align:center;">-</th>

                </tr>
              </thead>
              <tbody>

                <?php
             
                  while ($row = $result->fetch_assoc()) {
               
                    echo "<tr>";

                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['u_date'] . "</td>";
                    echo "<td style='text-align:center;'><a href='delete_user.php?id=".$row['u_id']."'><i class='fa fa-trash' style='color: red; font-size:20px;'></i></a></td>";
            
                    echo "</tr>";
                    $i++;
                }
                ?>
        </form>
        </tbody>
        </table>
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
