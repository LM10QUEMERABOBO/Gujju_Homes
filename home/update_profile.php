<?php
session_start();

require("../shortlink/connection.php");

if (isset($_POST['save'])) {
    $id= $_SESSION['u_id'];
    
  $name = mysqli_real_escape_string($conn, $_POST['u_name']);
  $mail = mysqli_real_escape_string($conn, $_POST['u_email']);
  $phone = mysqli_real_escape_string($conn, $_POST['u_mobile']);
  $city = mysqli_real_escape_string($conn, $_POST['u_city']);
  $addr = mysqli_real_escape_string($conn, $_POST['u_address']);

  $imgname = $_FILES['myimage']['name'];
  $imgsize = $_FILES['myimage']['size'];
  $tmpname = $_FILES['myimage']['tmp_name'];
  $error = $_FILES['myimage']['error'];

  $q = "SELECT * FROM user WHERE u_id=" . $id;
$match = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($match);

  //For Upload Image
  if (isset($_FILES['myimage'])) {
    if ($error === 0) {
      if ($imgsize > 2500000) {
?>
        <script>
          alert("Your file is too large!, Please select another file.");
          window.top.location = './profile.php';
        </script>
        <?php
      } else {
        $imgEx = pathinfo($imgname, PATHINFO_EXTENSION);
        $imgEx_lc = strtolower($imgEx);
        $allowexten = array("jpg", "png", "jpeg");

        if (in_array($imgEx_lc, $allowexten)) {
          mkdir("../Uploads/Users/" . $_SESSION['u_id'] . "/", 0777, true);
          $new_img_name = uniqid("IMG-", true) . '.' . $imgEx_lc;
          $imge_upload_path = '../Uploads/Users/' . $_SESSION['u_id'] . '/' . $new_img_name;
          move_uploaded_file($tmpname, $imge_upload_path);

          if ($row['photo'] != $new_img_name) {
            unlink('../Uploads/Users/' . $_SESSION['u_id'] . '/' . $row['photo']);
          }

          $q2 = "UPDATE user SET photo='" . $new_img_name . "' WHERE u_id=" . $id;
          mysqli_query($conn, $q2);
        } else {
        ?>
          <script>
            alert("Uploaded file must be in (.jpg, .png, .jpeg) formate");
            window.top.location = './profile.php';
          </script>
  <?php
        }
      }
    }
  }

  $q2 = "UPDATE user SET username='" . $name . "', email='" . $mail . "', mobile='" . $phone . "', city='" . $city . "', address='" . $addr . "' WHERE u_id=" . $id;
  mysqli_query($conn, $q2);

  ?>
  <script>
    alert("Data Saved Successfully.");
    window.top.location = './profile.php';
  </script>
<?php

}
?>