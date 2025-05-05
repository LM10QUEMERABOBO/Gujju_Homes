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
    <link rel="stylesheet" href="./about.css">

    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        @media (max-width: 572px) {
            .signup {
                display: none;
            }
        }

        #about {
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
    <div class="about_img">
        <section class="home" id="home">

            <div class="home-text">
                <!-- <h1>ABOUT US</h1> -->
            </div>
        </section>
        <div class="content">
            <h3 class="about_head">ABOUT US</h3>

            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This web-site is all-in-on plateform that providing the space that the user can buy their liked proprties or sell their properites. It will cover the entire country in nearest future. It is very profitable and reliable platform. It was founded in 2022 and headquartd in Ahmedabad (gujarat). Our story telling is driven by our curiosity, creativity and humor.</p>

            <p>Through this Website users can search the properties as per thier requirement and sell their properties.</p>
            <p>Users can also Search all the type of propertues for ex:- tenament,apartment,penthouse,etc.</p>

            <p>In future we will add several new/unique features to our project which will be provided to end users/admins like: 
                <br><br>
                 - We will add feature for performing the real-time payment methodology. We will add subscription plans after the user can buy/sell/rent the first property. 
                 <br>
                 - We will more property types as the demands arises for the other kind of properites. 
                 <br>
                 - We will add features like one admin will be appointed for each city.Each admin have around 10/15 people's team, and he/she will assign one of them to be used as to check the registered property and he/she will be median for the property's deal. </p>

        </div>
        <div class="content_back">

        </div>
    </div>
    <div>
        <h3 style="text-align:center" class="about_head">OUR TEAM</h3>
        <div class="row">
            <div class="column">
                <div class="card">

                    <!-- <div class="our_img"></div> -->
                    <img src="../img/img_avatar.png" alt="Mike">

                    <div class="container">
                        <h4>KISHAN</h4>
                        <p class="title">PROJECT LEADER</p>
                        <p>-Manages the whole project and help members to design website.</p>
                        <p class="title mb-1">E-mail: </p>
                        <p>kishanrana6353@gmail.com</p>
                        <!-- <p><button class="button">Contact</button></p> -->
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <img src="../img/img_avatar.png" alt="Jane">
                    <div class="container">
                        <h4>DHAIRYA</h4>
                        <p class="title">PROJECT MEMBER</p>
                        <p>-Design the more interactive front-end with project members.</p>
                        <p class="title mb-1">E-mail: </p>
                        <p>dhairya749@gmail.com</p>
                        <!-- <p><button class="button">Contact</button></p> -->
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">
                    <img src="../img/img_avatar.png" alt="Mike">
                    <div class="container">
                        <h4>HARSH</h4>
                        <p class="title">PROJECT MEMBER</p>
                        <p>-He also design front-end and give support to our members.</p>
                        <p class="title mb-1">E-mail: </p>
                        <p>harsh5339@gmail.com</p>

                        <!-- <p><button class="button">Contact</button></p> -->
                    </div>
                </div>
            </div>


            <div class="column">
                <div class="card">
                    <img src="../img/img_avatar.png" alt="John">
                    <div class="container">
                        <h4>KRISH</h4>
                        <p class="title">PROJECT MEMBER</p>
                        <p>-Provide the back-end support to the project leader</p>
                        <p class="title mb-1">E-mail: </p>
                        <p>krish949@gmail.com</p>
                        <!-- <p><button class="button">Contact</button></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div> <!--for menu bars -->

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