<?php require("./shortlink/connection.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Rent/Sale</title>
    <!-- LInk To CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/HomeLogo.png">

    <!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
    <!-- online links -->
    <?php require("./links/links.php") ?>

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <style>
        @media (max-width: 572px) {
            .signup {
                display: none;
            }
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

    <!-- Back to Top -->
    <a href="#"><i class="fa fa-long-arrow-up" id="myBtn"></i></a>

    <header>
        <div class="header">
            <a href="./index.php" class="logo">
                <!-- <span class="logo-txt">Gujju</span> -->
                <img class="images home-logo" src="./img/MainLogo.png" alt="Logo">
                <!-- <span class="logo-txt">Homes</span> -->
            </a>
            <div class="head-btn">
                <a href="./login-signup/sign-up.php" class="buttons signup btn-head">Sign Up</a>
                <a href="./login-signup/login.php" class="buttons btn-head">Log In</a>
            </div>
        </div>
    </header>
    <!-- Navbar -->
    <nav>
        <div class="navmenu">
            <!-- Nav List -->
            <ul class="navmenubar ul">
                <li><a href="index.php" class="activet"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                <li class="aboutus"><a href="./home/about.php">About</a></li>
                <li class="contactus"><a href="./home/contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="menu">
            <a href="#search1" style="color: unset;">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>

            <a href="javascript:void(0)" style="color: unset;" onclick="opencloseNav()">
                <i class="fa fa-bars" id="bars" aria-hidden="true"></i>

            </a>
        </div>
    </nav>

    <!-- Below Nav -->
    <div class="afterNav">
        <div id="mySidenav" class="sidenav">
            <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
            <a href="#">Home</a>
            <a href="./home/about.php">About</a>
            <a href="./home/contact.php">Contact</a>
        </div>

        <!-- Home -->
        <!-- <section class="home" id="home">

            <div class="home-text">
                <h1>Find Your Next <br>Perfect Place To <br>Live.</h1>
                <a href="#" class="buttons">More About</a>
            </div>
        </section> -->

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
                <img class="images" src="img/about.jpg" alt="">
            </div>
            <div class="about-text">
                <span>About Us</span>
                <h2>We Provide The Best <br>Property For You !</h2>
                <p>This web-site is all-in-on plateform that providing the space that the user can buy their liked proprties or sell their properites.</p>
                <p>It was founded in 2022 and headquartd in Ahmedabad (gujarat).</p>
                <div style="padding-top:1rem">
                    <a href="./home/about.php" class="buttons">Learn More</a>
                </div>
            </div>
        </section>

        <!-- This will add Search filter -->
        <!-- Search -->
        <section id="search1">
            <div class="container-fluid fadeIn" style="padding: 35px;">
                <div class="container">
                    <form action="" method="post" style="display: inherit;">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <div class="row g-2">

                                    <?php
                                    $fetchc = "select DISTINCT city from property";
                                    $pc = mysqli_query($conn, $fetchc);

                                    $fetcht = "select DISTINCT type from property";
                                    $pt = mysqli_query($conn, $fetcht);
                                    ?>

                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3 text-capitalize " name="city" id="city" onchange="onCity()">

                                            <option value="">Select City Here</option>

                                            <?php

                                            while ($row = $pc->fetch_assoc()) {
                                                if ($_GET['city'] == $row['city']) {
                                                    echo "<option value='$row[city]' class='text-capitalize' selected>$row[city]</option>";
                                                } else {

                                                    echo "<option value='$row[city]' class='text-capitalize' >$row[city]</option>";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3 text-capitalize" name="method" id="method" onchange="onMethod()">
                                            <option value="">Select Property Option Here</option>

                                            <?php
                                            if ($_GET['method'] == "Rent") {
                                                echo "<option value='Rent' selected>Rent</option>";
                                            } else {
                                                echo "<option value='Rent'>Rent</option>";
                                            }

                                            if ($_GET['method'] == "Sell") {
                                                echo "<option value='Sell' selected>Sell</option>";
                                            } else {
                                                echo "<option value='Sell'>Sell</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3 text-capitalize" name="type" id="type" onchange="onType()">
                                            <option value="">Select Property Type Here</option>
                                            <?php

                                            while ($row = $pt->fetch_assoc()) {
                                                if ($_GET['type'] == $row['type']) {
                                                    echo "<option value='$row[type]' class='text-capitalize' selected>$row[type]</option>";
                                                } else {

                                                    echo "<option value='$row[type]' class='text-capitalize' >$row[type]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="" id="search"><input type="ok" class="btn btn-dark border-0 w-100 py-3 btn-search" name="search" value="Search"></a>

                                <script>
                                    let city = "",
                                        method = "",
                                        type = "";

                                    function onCity() {
                                        onSelect();
                                        onMethod();

                                        const ajaxreq = new XMLHttpRequest();
                                        ajaxreq.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                document.getElementById('method').innerHTML = ajaxreq.responseText;
                                            }
                                        }
                                        ajaxreq.open('GET', 'http://localhost/6th-Project/Project_Coding_Main/jquerydata/index_data1.php?city=' + city, true);
                                        ajaxreq.send();
                                    }

                                    function onMethod() {
                                        onSelect();

                                        const ajaxreq = new XMLHttpRequest();
                                        ajaxreq.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                document.getElementById('type').innerHTML = ajaxreq.responseText;
                                            }
                                        }
                                        ajaxreq.open('GET', 'http://localhost/6th-Project/Project_Coding_Main/jquerydata/index_data2.php?method=' + method+'&city='+city, true);
                                        ajaxreq.send();
                                    }

                                    function onType(ype) {
                                        onSelect();

                                    }

                                    function onSelect() {

                                        city = document.getElementById('city').value;
                                        method = document.getElementById('method').value;
                                        type = document.getElementById('type').value;

                                        document.getElementById('search').href = "./index.php?city=" + city + "&method=" + method + "&type=" + type + "#search1";
                                    }

                                    city = document.getElementById('city').value;
                                    method = document.getElementById('method').value;
                                    type = document.getElementById('type').value;

                                    document.getElementById('search').href = "./index.php?city=" + city + "&method=" + method + "&type=" + type + "#search1";
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Search End -->

        <?php

        if ($_GET['city'] != "" || $_GET['method'] != "" || $_GET['type'] != "") {
            $city = $_GET['city'];
            $type = $_GET['type'];
            $method = $_GET['method'];

            $qry = "SELECT * FROM property WHERE status=0";
            if ($city != "") {
                $qry .= " AND city='" . $city . "'";
            }
            if ($type != "") {
                $qry .= " AND type='" . $type . "'";
            }
            if ($method != "") {
                $qry .= " AND rent_sell='" . $method . "'";
            }
            // $qry = "SELECT * FROM property";

            $result2 = mysqli_query($conn, $qry);
            if ($result2) {
        ?>
                <div class="container-xxl pb-5 name2" id="name2">
                    <div class="container">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <?php while ($row = $result2->fetch_assoc()) {
                                        $uid = $row['u_id'];
                                        $pid = $row['pr_id'];
                                        $q1 = "SELECT username FROM user WHERE u_id=" . $uid;
                                        $res = mysqli_fetch_assoc(mysqli_query($conn, $q1));

                                        $q2 = "SELECT photo FROM prop_photo WHERE pr_id=" . $pid;
                                        $res1 = mysqli_fetch_assoc(mysqli_query($conn, $q2));

                                    ?>
                                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="property-item rounded overflow-hidden">
                                                <div class="position-relative overflow-hidden">
                                                    <a href="./home/property.php"><img class="img-fluid" src="<?php echo './Uploads/Users/' . $uid . '/P' . $pid . '/' . $res1['photo']; ?>" alt=""></a>
                                                    <div class="bg-primary rounded text-white position-absolute top-0 m-4 py-1 px-3">
                                                        <?php
                                                        echo $row['rent_sell']; ?></div>
                                                    <div class="bg-success rounded text-white position-absolute top-0 m-4 py-1 px-3" style="left: 6rem;">
                                                        <?php
                                                        $st = $row['status'];
                                                        if ($st == 0) {
                                                            echo "Available";
                                                        } else {
                                                            echo "Aquired";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3 text-capitalize">
                                                        <?php
                                                        echo $row['type']; ?></div>
                                                </div>
                                                <div class="p-4 pb-0 name1">
                                                    <h5 class="text-primary mb-3"><?php echo $row['price']; ?> ₹</h5>
                                                    <a class="d-block h5 mb-2 text-capitalize"><i class="fa fa-user text-primary me-2"></i>Owner: <?php echo $res['username']; ?></a>
                                                    <p class="text-capitalize"><i class="fas fa-map-marker-alt text-primary me-2"></i>City:
                                                        <?php
                                                        echo $row['city']; ?></p>
                                                    <p class="text-capitalize"></i>Address: <?php echo $row['society'] . ', ' . $row['area'] . ', ' . $row['city']; ?></p>
                                                </div>
                                                <div class="d-flex border-top">
                                                    <a href="./login-signup/login.php" class="btn bg-primary rounded text-white m-2 py-2 px-5 border-0" style="margin-left: 3rem !important;">More Details</a>
                                                    <small class="flex-fill text-center border-end py-2"></small>
                                                    <small class="flex-fill text-center heart"><a href="./login-signup/login.php"><i id="1" class="fa fa fa-heart-o text-primary myhear"></i></a></small>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                        <a class="btn btn-primary py-3 px-5 text-white" href="./home/filter.php">Browse More Property</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<h2 class='text-center' style='margin-bottom: 4.5rem;'>--Search The Property Here--</h2>";
        }

        ?>
        <!-- Search filter end -->

        <!-- Footer -->
        <section class="footer">
            <div class="footer-container index-container">
                <div class="foot-logo">
                    <a href="./index.php" class="logo" style="margin-left: unset;"><img class="images home-logo" src="./img/FootLogo.png" alt="Logo"></a>
                </div>
                <div class="footer-box">
                    <h3 class="hh3">Quick Links</h3>
                    <a href="./home/about.php">About us</a>
                    <a href="./home/contact.php">Contact us</a>
                </div>
                <div class="footer-box">
                    <h3 class="hh3">Contact</h3>
                    <a>+91 8320302446</a>
                    <a>Gujjuhomes@khd.com</a>
                    <div class="social">
                        <a href="#"><i class='bx bxl-facebook'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Copyright -->
        <div class="copyright">
            <p class="p">&#169; KHDSolutions. All Right Reserved</p>
        </div>
    </div>

    <script>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="./js/main.js"></script>
</body>

</html>