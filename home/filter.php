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

        #filter {
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

    <div id="search">
        <div class="container-fluid fadeIn" style="padding: 35px;background: #004c83; height: 32%;">
            <div class="container">
                <form action="" method="post" style="display: inherit;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <select class="form-select border-0 py-3" name="city[]" required>
                                        <option value="">Select City Here</option>
                                        <option value="Patan">Patan</option>
                                        <!-- <option value="Patan">Ahmedabad</option> -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select border-0 py-3" name="method[]">
                                        <option value="">Select Property Option Here</option>
                                        <!-- <option value="Rent-Sale">Rent-Sell</option> -->
                                        <option value="Rent">Rent</option>
                                        <option value="Sell">Sell</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select border-0 py-3" name="type[]">
                                        <option value="">Select Property Type Here</option>
                                        <option value="apartmrnt">Apartment</option>
                                        <option value="tenament">Tenament</option>
                                        <!-- <option value="3"></option> -->
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <!-- <select class="form-select border-0 py-3" name="price" required>
                                            <option value="">Price:</option>
                                            <option value="Patan">3,000 to 4,000</option>
                                            <option value="Patan">5,000 to 6,000</option>
                                        </select> -->
                                        <input type="text" name="price" class="form-select border-0 py-3 form-select1" placeholder="Specify Price Range" style="background-image: unset !important; ">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3" name="area[]">
                                            <option value="">Select Area Here</option>
                                            <option value="ambaji nediyu">Ambaji Nediyu</option>
                                            <option value="bhairav nagar">Bhairav Nagar</option>
                                            <option value="bukdi chock">Bukdi Chock</option>
                                            <option value="subhash chock">Shubhash Chok</option>
                                            <option value="soni vado">Soni Vado</option>
                                            <!-- <option value="">City point</option> -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3" name="space[]">
                                            <option value="">Select Space Here:</option>
                                            <option value="1BHK">1BHK</option>
                                            <option value="2BHK">2BHK</option>
                                            <option value="3BHK">3BHK</option>
                                            <!-- <option value="3">More then Above</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-2" style="margin-inline: 105%; margin-top: -105px;    padding-bottom: 65px;">
                                <input type="Submit" class="btn btn-dark border-0 w-100 py-3 btn-search" name="search" value="Search" style="margin-block: -76%;">
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Property List Start -->
    <?php
    if (isset($_POST['search'])) {

        $city = $_POST['city'];
        $area = $_POST['area'];
        $type = $_POST['type'];
        $method = $_POST['method'];
        $space = $_POST['space'];
        $price = intval($_POST['price']);

        $q = "SELECT * FROM property WHERE status=0 and city='" . $city[0] . "'";
        if ($area[0] != "") {
            $q .= " AND area='" . $area[0] . "'";
        }
        if ($type[0] != "") {
            $q .= " AND type='" . $type[0] . "'";
        }
        if ($method[0] != "") {
            $q .= " AND rent_sell='" . $method[0] . "'";
        }
        if ($space[0] != "") {
            $q .= " AND p_space='" . $space[0] . "'";
        }
        if ($price != null) {
            $q .= " AND price<=" . $price;
        }
        $result = mysqli_query($conn, $q);
        if ($result) {

    ?>
            <div class="container-xxl py-5 name2" id="name2">
                <div class="container">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <?php while ($row = $result->fetch_assoc()) {
                                    $uid = $row['u_id'];
                                    $pid = $row['pr_id'];
                                    $q1 = "SELECT * FROM user WHERE u_id=" . $uid;
                                    $res = mysqli_fetch_assoc(mysqli_query($conn, $q1));

                                    $q2 = "SELECT photo FROM prop_photo WHERE pr_id=" . $pid;
                                    $res1 = mysqli_fetch_assoc(mysqli_query($conn, $q2));

                                ?>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="property-item rounded overflow-hidden">
                                            <div class="position-relative overflow-hidden">
                                                <a href="./property.php?pid=<?php echo $row['pr_id'] ?>&uid=<?php echo $res['u_id'] ?>"><img class="img-fluid" src="<?php echo '../Uploads/Users/' . $uid . '/P' . $pid . '/' . $res1['photo']; ?>" alt=""></a>
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
                                                <h5 class="text-primary mb-3">Price: <?php echo $row['price']; ?> ₹</h5>
                                                <a class="d-block h5 mb-2 text-capitalize"><i class="fa fa-user text-primary me-2"></i>Owner: <?php echo $res['username']; ?></a>
                                                <p class="text-capitalize"><i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                    City: <?php
                                                    echo $row['city']; ?></p>
                                                <p class="text-capitalize"></i>Address: <?php echo $row['society'] . ', ' . $row['area'] . ', ' . $row['city']; ?></p>
                                            </div>
                                            <div class="d-flex border-top">
                                                <a href="./property.php?pid=<?php echo $row['pr_id'] ?>&uid=<?php echo $res['u_id'] ?>" class="btn bg-primary rounded text-white m-2 py-2 px-5 border-0" style="margin-left: 3rem !important;">More Details</a>
                                                <small class="flex-fill text-center border-end py-2"></small>
                                                <small class="flex-fill text-center heart"><a href="./save2.php?pid=<?php echo $pid ?>"><i id="1" class="fa <?php 
                                                $sel= "select * from fav_property where u_id=".$_SESSION['u_id']." and pr_id=".$pid;
                                                $res1 = mysqli_query($conn,$sel);
                                                if(mysqli_fetch_row($res1))
                                                {
                                                    echo "fa-heart";
                                                }
                                                else
                                                {
                                                    echo "fa-heart-o";
                                                }
                                            ?> text-primary myhear"></i></a></small>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        else
        {
            ?><script>alert("ere");</script><?php
            echo "<div class='container py-5'><h2 class='text-center py-5'>No Properties Found</h2></div>";
        }
    }
    ?>

    <!-- This will add FOOTER -->
    <?php //require("../shortlink/home_foot.php") ?>

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

        function onSearch() {
            document.getElementById('sec').style.display = "none";
        }
    </script>
</body>

</html>