<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- LInk To CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        .signup {
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

    <!-- This will add Header -->
    <?php require("../shortlink/header.php") ?>

    <section class="dd">
        <div class="wrapper">
            <h2>SignUp</h2>
            <form method="post">
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        person
                    </span>
                    <input type="text" name="name" placeholder="Username" maxlength="20" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        smartphone
                    </span>
                    <input type="text" name="mobile" placeholder="Mobile" minlength="10" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        mail
                    </span>
                    <input type="email" name="email" placeholder="E-mail" maxlength="30" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        lock
                    </span>
                    <input type="password" onfocus="showEye1()" id="password1" minlength="8" maxlength="20" name="password" placeholder="Password" required>
                    <span class="material-symbols-outlined eye-icon" id="togglePassword1">
                        visibility_off
                    </span>

                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        lock
                    </span>
                    <input type="password" onfocus="showEye2()" id="password2" minlength="8" maxlength="20" name="cpass" placeholder="Confirm Password" required>
                    <span class="material-symbols-outlined eye-icon" id="togglePassword2">
                        visibility_off
                    </span>

                </div>
                <!-- <div class="policy">
                    <input type="checkbox" required>
                    <h3>I accept all Terms & Conditions</h3>
                </div> -->
                <div class="option_field">
                    <span class="checkboxs">
                        <input type="checkbox" id="check" required>
                        <label for="check">I accept the Terms & Conditions</label>
                    </span>
                </div>
                <div class="input-box button">
                    <input type="Submit" class="log-sign" name="signup" value="Signup">
                </div>
                <div class="text">
                    <h3>Already have an account? <a href="./login.php">Login now</a></h3>
                </div>
            </form>
        </div>
    </section>
    </div>
    <!-- This will add Footer -->
    <?php //require("../shortlink/footer.php") ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/showpass.js"></script>
    <script>
        document.getElementById("search").style.display = "none";
    </script>

</body>

</html>
<?php

/*
This code is prepared to perform the backend process for the signup procedure of the website.
author:-KHD solutions.
*/
require("../shortlink/connection.php");

if (!$conn) {

?>
    <script>
        alert("Error with the database, Please try after some time.");
    </script>
    <?php
       
} 
else {
    if (isset($_POST['signup'])) {
        //Taking user information
        $un = mysqli_real_escape_string($conn, $_POST['name']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

        // password and confirm password matching
        if ($pass != $cpass) {
    ?>
            <script>
                alert("Password and ConfirmPassword are not same.");
            </script>
            <?php
        } else {

            //password encryption
            $ph = password_hash($pass, PASSWORD_BCRYPT);

            //Cheking for the matched entry.
            $sl = "SELECT * FROM user WHERE username='$un' or email= '$email' or mobile='$mobile'";
            $match = mysqli_query($conn, $sl);

            if (mysqli_num_rows($match) == 1) {
            ?>
                <script>
                    alert("This Account is already exist.");
                </script>
            <?php
            } else {
                //Insert the data in the table.
                $in = "INSERT INTO user(username,email,mobile,password) VALUES('" . $un . "','" . $email . "','" . $mobile . "','" . $ph . "')";
                $q3 = mysqli_query($conn, $in);

            ?>

                <script>
                    alert("Signup successful, Please Login now.");
                    window.top.location = './login.php';
                </script>
<?php
            }
        }
    }
}
?>