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

  $q1 = "SELECT * FROM contact";
  $result = mysqli_query($conn, $q1);
  $i = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Emails</title>

  <!-- User Stylesheet -->
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    #email {
      background-color: #eee;
    }

    #email i {
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
      <h3>Manage Mails</h3>

      <section class="ManageEmails">
        <div class="list">
          <h5>Mails:-</h5>

          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Message</th>
                <th>Date-Time</th>
                <!-- <th style="text-align:center;">Reply</th> -->
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
               echo "<td>" . $row['message'] . "</td>";
               echo "<td>" . $row['datetime'] . "</td>";
               echo "<td style='text-align:center;'><a href='delete_mail.php?id=".$row['sr_id']."'><i class='fa fa-trash' style='color: red; font-size:20px;'></i></a></td>";
       
               echo "</tr>";
               $i++;
           }
           ?>

              <!-- <tr>
                <td>01</td>
                <td>Harsh Patel</td>
                <td>harshpatel@gmail.com</td>
                <td>Be economical with words. Tempora, deserunt eum quidem quas cum, impedit optio ullam consectetur, cupiditate numquam consequatur at?</td>
                <td>05-05-2003 00:00:00am</td>
                <td><button>Reply</button></td>
                <td style="text-align:center;"><i class="fa fa-trash" style="color: red; font-size:20px;"></i></td>

              </tr> -->
              
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