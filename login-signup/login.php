<?php
session_start();


if (!isset($_SESSION['u_id'])) {
    setcookie('emailcookie', '', time() - (60 * 60 * 24));
    setcookie('passwordcookie', '', time() - (60 * 60 * 25));
}
/*
This code is prepared to perform the backend process for the Login procedure of the website.
author:-KHD solutions.
*/
require("../shortlink/connection.php");

if (!$conn) {

?>
    <script>
        alert("Error with the database, Please try after some time.");
    </script>
    <?php
       
} else {
    if (isset($_POST['login'])) {


        //Taking user information
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $qry1 = "select password from admin_info where email= '" . $email . "'";
        $str_pass1 = mysqli_fetch_array(mysqli_query($conn, $qry1));

        if ($pass== ($str_pass1['password'])) 
        {
            $qselect = "SELECT admin_id, username, mobile FROM admin_info WHERE email='" . $email . "'";
                $data = mysqli_fetch_assoc(mysqli_query($conn, $qselect));

                $_SESSION['u_id'] = $data['admin_id'];
                $_SESSION['u_name'] = $data['username'];
                $_SESSION['u_mobile'] = $data['mobile'];
                $_SESSION['u_email'] = $email;

                $_SESSION['counter'] = 0;

                if (isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time() + 60 * 60 * 24);
                    setcookie('passwordcookie', $pass, time() + 60 * 60 * 24);
                }

                header('location:../admin/dashboard.php');
        }
        else {
            $qry2 = "select password from user where email= '" . $email . "'";
            $str_pass2 = mysqli_fetch_array(mysqli_query($conn, $qry2));
            $check2 = password_verify($pass, $str_pass2['password']);

            //Cheking for the matched entry.
            // $sl = "SELECT * FROM user WHERE email='" . $email . "' and password='" . $check . "'";
            // $match = mysqli_query($conn, $sl);

            if ($check2) {

                $qselect = "SELECT u_id, username, mobile FROM user WHERE email='" . $email . "'";
                $data = mysqli_fetch_assoc(mysqli_query($conn, $qselect));

                $_SESSION['u_id'] = $data['u_id'];
                $_SESSION['u_name'] = $data['username'];
                $_SESSION['u_mobile'] = $data['mobile'];
                $_SESSION['u_email'] = $email;

                $_SESSION['counter'] = 0;

                if (isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time() + 60 * 60 * 24);
                    setcookie('passwordcookie', $pass, time() + 60 * 60 * 24);
                }

                header('location:../home/home.php');
            } else {
    ?>
                <script>
                    alert("Email or Password is not valid!");
                    window.top.location = './login.php';
                </script>
<?php
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- LInk To CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        .login {
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

    <section class="dd" style="padding: 13rem 0 !important;">
        <div class="wrapper">
            <h2 class="after-h2">LogIn</h2>
            <form method="post">
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        mail
                    </span>

                    <input type="email" name="email" placeholder="E-mail" maxlength="30" value="<?php if (isset($_COOKIE['emailcookie'])) {
                                                                                        echo $_COOKIE['emailcookie'];
                                                                                    } ?>" required>

                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        lock
                    </span>

                    <input type="password" onfocus="showEye1()" id="password1" maxlength="20" name="password" placeholder="Password" value="<?php if (isset($_COOKIE['passwordcookie'])) {
                                                                                                                                    echo $_COOKIE['passwordcookie'];
                                                                                                                                } ?>" required>

                    <span class="material-symbols-outlined eye-icon" id="togglePassword1">
                        visibility_off
                    </span>
                </div>
                <div class="option_field">
                    <span class="checkboxs">
                        <input type="checkbox" id="check" name="rememberme" />
                        <label for="check">Remember me</label>
                    </span>
                    <!-- <a href="#" class="forgot_pw">Forgot password?</a> -->
                </div>

                <div class="input-box button">
                    <input type="Submit" class="log-sign" name="login" value="Login">
                </div>
                <div class="text">
                    <h3>Don't have an account? <a href="sign-up.php">Sign-in now</a></h3>
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