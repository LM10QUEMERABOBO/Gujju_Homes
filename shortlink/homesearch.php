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
                                <a href="" id="search9"><input type="ok" class="btn btn-dark border-0 w-100 py-3 btn-search" name="search" value="Search"></a>

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

                                        document.getElementById('search9').href = "./home.php?city=" + city + "&method=" + method + "&type=" + type + "#search1";
                                    }

                                    city = document.getElementById('city').value;
                                    method = document.getElementById('method').value;
                                    type = document.getElementById('type').value;

                                    document.getElementById('search9').href = "./home.php?city=" + city + "&method=" + method + "&type=" + type + "#search1";
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
                                        $q1 = "SELECT * FROM user WHERE u_id=" . $uid;
                                        $res = mysqli_fetch_assoc(mysqli_query($conn, $q1));

                                        $q2 = "SELECT photo FROM prop_photo WHERE pr_id=" . $pid;
                                        $res1 = mysqli_fetch_assoc(mysqli_query($conn, $q2));

                                    ?>
                                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="property-item rounded overflow-hidden">
                                                <div class="position-relative overflow-hidden">
                                                    <a href="./property.php?pid=<?php echo $row['pr_id']?>&uid=<?php echo $res['u_id'] ?>"><img class="img-fluid" src="<?php echo '../Uploads/Users/' . $uid . '/P' . $pid . '/' . $res1['photo']; ?>" alt=""></a>
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
                                                    <a href="./property.php?pid=<?php echo $row['pr_id']?>&uid=<?php echo $res['u_id'] ?>" class="btn bg-primary rounded text-white m-2 py-2 px-5 border-0" style="margin-left: 3rem !important;">More Details</a>
                                                    <small class="flex-fill text-center border-end py-2"></small>
                                                                                                       
                                                    <small class="flex-fill text-center heart"><a href="./save.php?pid=<?php echo $pid ?>&city=<?php echo $city?>&method=<?php echo $method ?>&type=<?php echo $type?>"><i id="1" class="fa <?php 
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

                                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                        <a class="btn btn-primary py-3 px-5 text-white" href="./filter.php">Browse More Property</a>
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