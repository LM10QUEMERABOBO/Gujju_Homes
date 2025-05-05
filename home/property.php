<?php
session_start();
if (!isset($_SESSION['u_id'])) {
    header("location: ../login-signup/login.php");
}

require("../shortlink/connection.php");

$id = $_SESSION['u_id'];
$q = "SELECT * FROM user WHERE u_id=" . $id;
$match = mysqli_query($conn, $q);
$res = mysqli_num_rows($match);
$row = mysqli_fetch_assoc($match);

$uid = $_GET['uid'];
$pid = $_GET['pid'];

$query = "select * from property where pr_id=".$pid;
$result = mysqli_query($conn, $query);
$row6 = mysqli_fetch_assoc($result);

$query2 = "select * from prop_photo where pr_id=".$pid;
$result2 = mysqli_query($conn, $query2);
// $row2 = mysqli_fetch_assoc($result2);
$i=0;
while($row2 = mysqli_fetch_assoc($result2)){
    $photo[]= $row2['photo'];
    $i++;
}

$query1 = "select * from user where u_id=".$uid;
$result1 = mysqli_query($conn, $query1);
$row1= mysqli_fetch_assoc($result1);
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

    <link rel="stylesheet" href="./property.css">
    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        @media (max-width: 572px) {
            .signup {
                display: none !important;
            }
        }

td{
    text-transform: capitalize;
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

    <!-- This will add HEADER -->
    <?php require("../shortlink/home_head.php") ?>


    <section class="about index-container" id="about" style="padding: 0rem 0 3rem;">

        <div class="header position-relative">
            <h2 style="color: var(--btnhead-color);" class="ps-3 pt-1 text-decoration-underline">Owner: <?php echo $row1['username'] ?></h2>
            <div class="bg-success rounded text-white position-absolute top-0 m-4 py-1 px-3" style="left: 38rem;">Available</div>

        </div>

        <div class="about-img">
            <div class="slidecontainer">
                <div class="mineSlides">
                    <div class="numbertext">1 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[0]; ?>" style="width:100%">
                </div>

                <div class="mineSlides">
                    <div class="numbertext">2 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[1]; ?>" style="width:100%">
                </div>

                <div class="mineSlides">
                    <div class="numbertext">3 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[2]; ?>" style="width:100%">
                </div>

                <div class="mineSlides">
                    <div class="numbertext">4 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[3]; ?>" style="width:100%">
                </div>

                <div class="mineSlides">
                    <div class="numbertext">5 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[4]; ?>" style="width:100%">
                </div>

                <div class="mineSlides">
                    <div class="numbertext">6 / 6</div>
                    <img src="<?php echo '../Uploads/Users/' . $row6['u_id'] . '/P' .$pid.'/'. $photo[5]; ?>" style="width:100%">
                </div>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>



            </div>
        </div>
        <div class="about-text">
            <h2 class="text-decoration-underline text-center">Property Details</h2>

            <table class="table">
                
                <tbody>
                    <tr>
                        <td>Type: <?php echo $row6['type'] ?></td>
                        <td>Available: For <?php echo $row6['rent_sell'] ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Peroperty No:  <?php echo $row6['pro_no']?></td>
                        <td>Space:  <?php echo $row6['p_space'] ?></td>
                        <td>Price:  <?php echo $row6['price'] ?> ₹</td>
                    </tr>
                    <tr>
                        <td>City:  <?php echo $row6['city'] ?></td>
                        <td>Area:  <?php echo $row6['area'] ?></td>
                        <td>Society:  <?php echo $row6['society'] ?></td>
                    </tr>

                </tbody>
            </table>

            <div style="display: flex; " class="ps-5">
                <p class="d-block  my-2">Other Description: <?php echo $row6['description'] ?></p>
            </div>

            <div style="padding-top:1rem; display: flex; justify-content: center;">
                <!-- <button class="buttons disabled" disabled>Book Now</button> -->

                <a class="btn buttons px-5 text-white" href="./booking.php?pid=<?php echo $pid; ?>&uid=<?php echo $uid ?>">Book Now</a>
            </div>
        </div>
    </section>





    </div>
    <!-- This will add FOOTER -->
    <?php require("../shortlink/home_foot.php") ?>

    <!-- The below bothe link for spinner -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>

    <script>
        document.getElementById("search").style.display = "none";

        function onLogout() {
            if (confirm("Are you sure, You want to Logout?") == 1) {

                window.top.location = '../login-signup/logout.php';
            }
        }

        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mineSlides");
            let dots = document.getElementsByClassName("demos");
            // let captionText = document.getElementById("captions");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            // captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
</body>

</html>