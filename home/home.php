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

$id = $_SESSION['u_id'];
$q = "SELECT * FROM user WHERE u_id=" . $id;
$match = mysqli_query($conn, $q);
$res = mysqli_num_rows($match);
$row = mysqli_fetch_assoc($match);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Rent/Sale</title>
    <!-- LInk To CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../img/HomeLogo.png">

    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        @media (max-width: 572px) {
            .signup {
                display: none !important;
            }
        }

        #homes {
            background-color: var(--mainhover-color) !important;
        }
    </style>
</head>

<body onscroll="onScroll()">

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">

        </div>
    </div>
    <!-- Spinner End -->

    <a href="#"><i class="fa fa-long-arrow-up" id="myBtn"></i></a>

    <!-- This will add HEADER -->
    <?php require("../shortlink/home_head.php") ?>

    <div class="slideshow-container">

    <div class="mySlides fades">
                <div class="slide_img1"></div>
                <div class="text5">Find Your Next Perfect Place To Live.</div>
            </div>

            <div class="mySlides fades">
                <div class="slide_img2"></div>
                
                    <div class="text5">Find Your Next Perfect Place To Live.</div>
            </div>

            <div class="mySlides fades">
                <div class="slide_img3"></div>
                <div class="text5">Find Your Next Perfect Place To Live.</div>
            </div>
    </div>

    <!-- About -->
    <section class="about index-container" id="about" style="padding-bottom: unset;">
        <div class="about-img">
            <img class="images" src="../img/about.jpg" alt="">
        </div>
        <div class="about-text">
            <span>About Us</span>
            <h2>We Provide The Best <br>Property For You !</h2>
            <p>This web-site is all-in-on plateform that providing the space that the user can buy their liked proprties or sell their properites.</p>
            <p>It was founded in 2022 and headquartd in Ahmedabad (gujarat).</p>
            <div style="padding-top:1rem">
                <a href="./about.php" class="buttons">Learn More</a>
            </div>
        </div>
    </section>

    <!-- This will add Search filter -->
    <?php require("../shortlink/homesearch.php") ?>
    
    <!-- cards -->

    </div>
    <!-- This will add FOOTER -->
    <?php require("../shortlink/home_foot.php") ?>

    <!-- The below bothe link for spinner -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>

    <script>
        function onLogout() {
            if (confirm("Are you sure, You want to Logout?") == 1) {

                window.top.location = '../login-signup/logout.php';
            }
        }

        let slideIndex1 = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex1++;
            if (slideIndex1 > slides.length) {
                slideIndex1 = 1
            }

            slides[slideIndex1 - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }
    </script>
</body>

</html>