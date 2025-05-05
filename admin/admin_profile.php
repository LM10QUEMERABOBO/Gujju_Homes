<?php
session_start();

if (!isset($_SESSION['u_id'])) {
  header("location: ../login-signup/login.php");
}

require("../shortlink/connection.php");


if (!$conn) {
?>
  <script>
    alert("Error in Connection!");
  </script>
<?php
}

$id = $_SESSION['u_id'];
$q = "SELECT username, email, mobile, city, address, photo FROM admin_info WHERE admin_id=" . $id;
$match = mysqli_query($conn, $q);
$res = mysqli_num_rows($match);
$row = mysqli_fetch_assoc($match);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Admin Profile</title>


  <!-- User Stylesheet -->
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Admin Stylesheet -->
  <link rel="stylesheet" href="./css/style.css" />

  <!-- online links -->
  <?php require("../links/links.php") ?>

  <style>
    #logo {
      background-color: #eee;
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

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container">

      <!-- This will add Side Menu Bar of Admin -->
      <?php require("../shortlink/admin_sidebar.php") ?>


      <section class="main">
        <h3>Admin Profile</h3>
        <section class='adminprofile'>
          <div class='list'>
            <section>

              <div class="op">

                <img src="<?php if ($row['photo'] != "") {
                  echo '../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $row['photo'];
                } else {
                  echo '../Uploads/default_profile.png';
                }
                ?>" id="photo" alt="Image">
                <label for="file_input">Edit&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></label>

                <input type="file" id="file_input" name="myimage">
                <h4><?php echo $row['username'] ?></h4>
              </div>

              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group'>
                    <label for="name">User Name:</label>
                    <input type='text' class='form-control' id="name" name='name' maxlength="20" value="<?php echo $row['username'] ?>">
                  </div>
                </div>

                <div class='col-md-6'>
                  <div class='form-group'>
                    <label for="email">E-mail:</label>
                    <input type='text' class='form-control' id="email" name='email' maxlength="30" value="<?php echo $row['email'] ?>">
                  </div>
                </div>
                <div class='col-md-6'>
                  <div class='form-group'>
                    <label for="mobile">Phone No:</label>
                    <input type='text' class='form-control' id="mobile" name='mobile' maxlength="10" value="<?php echo $row['mobile'] ?>">
                  </div>
                </div>
                <div class='col-md-6'>
                  <div class='form-group'>
                    <label for="city">City:</label>
                    <input type='text' class='form-control' id="city" name='city' maxlength="20" value="<?php echo $row['city'] ?>">
                  </div>
                </div>

                <div class='col-md-12'>
                  <div class='form-group'>
                    <label for="addr">Address:</label>
                    <textarea class='form-control' rows='4' id="addr" maxlength="100" name='address'><?php echo $row['address'] ?></textarea>
                  </div>
                </div>
              </div>
              <div>
                <input type="submit" name="update" value="Save Changes" class="btn btn-head">

              </div>
          </div>
    </div>
    </section>
    </section>
  </div>
</form>

  <!-- The below bothe link for spinner -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    //profile photo render
    file_input.onchange = evt => {
      const [file] = file_input.files
      if (file) {
        photo.src = URL.createObjectURL(file);
      } else {
        <?php if ($row['photo'] == "") { ?>photo.src = "../Uploads/default_profile.png";
        <?php } else { ?>photo.src = "<?php echo '../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $row['photo']; ?>";
      <?php } ?>

      }
    }

    function onLogout() {
      if (confirm("Are you sure, You want to Logout?") == 1) {

        window.top.location = '../login-signup/logout.php';

      }
    }
  </script>

</body>

</html>

<?php
if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $mail = $_POST['email'];
  $phone = $_POST['mobile'];
  $city = $_POST['city'];
  $addr = $_POST['address'];

  $imgname = $_FILES['myimage']['name'];
  $imgsize = $_FILES['myimage']['size'];
  $tmpname = $_FILES['myimage']['tmp_name'];
  $error = $_FILES['myimage']['error'];

  //For Upload Image
  if (isset($_FILES['myimage'])) {
    if ($error === 0) {
      if ($imgsize > 2500000) {
?>
        <script>
          alert("Your file is too large!, Please select another file.");
          window.top.location = './admin_profile.php';
        </script>
        <?php
      } else {
        $imgEx = pathinfo($imgname, PATHINFO_EXTENSION);
        $imgEx_lc = strtolower($imgEx);
        $allowexten = array("jpg", "png", "jpeg");

        if (in_array($imgEx_lc, $allowexten)) {
          mkdir("../Uploads/Admins/" . $_SESSION['u_id'] . "/", 0777, true);
          $new_img_name = uniqid("IMG-", true) . '.' . $imgEx_lc;
          $imge_upload_path = '../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $new_img_name;
          move_uploaded_file($tmpname, $imge_upload_path);

          if ($row['photo'] != $new_img_name) {
            unlink('../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $row['photo']);
          }

          $q2 = "UPDATE admin_info SET photo='" . $new_img_name . "' WHERE admin_id=" . $id;
          mysqli_query($conn, $q2);
        } else {
        ?>
          <script>
            alert("Uploaded file must be in (.jpg, .png, .jpeg) formate");
            window.top.location = './admin_profile.php';
          </script>
  <?php
        }
      }
    }
  }

  $q2 = "UPDATE admin_info SET username='" . $name . "', email='" . $mail . "', mobile='" . $phone . "', city='" . $city . "', address='" . $addr . "' WHERE admin_id=" . $id;
  mysqli_query($conn, $q2);

  ?>
  <script>
    alert("Data Saved Successfully.");
    window.top.location = './admin_profile.php';
  </script>
<?php

}
?>