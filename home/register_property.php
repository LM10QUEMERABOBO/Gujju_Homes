<?php
session_start();

require("../shortlink/connection.php");

if (isset($_POST['register'])) {
    $id = $_SESSION['u_id'];

    $p_type = mysqli_real_escape_string($conn, $_POST['p_type']);
    $p_no = mysqli_real_escape_string($conn, $_POST['p_no']);
    $p_rns = mysqli_real_escape_string($conn, $_POST['p_rns']);
    $p_space = mysqli_real_escape_string($conn, $_POST['p_space']);
    $p_price = intval(mysqli_real_escape_string($conn, $_POST['p_price']));
    $p_city = mysqli_real_escape_string($conn, $_POST['p_city']);
    $p_area = mysqli_real_escape_string($conn, $_POST['p_area']);
    $p_society = mysqli_real_escape_string($conn, $_POST['p_society']);
    $p_desc = mysqli_real_escape_string($conn, $_POST['p_description']);

    // photo array
    $imgname = $_FILES['upload']['name'];
    $imgsize = $_FILES['upload']['size'];
    $tmpname = $_FILES['upload']['tmp_name'];
    $error = $_FILES['upload']['error'];
    $inp;

    //Cheking for the matched entry.
    $sl = "SELECT * FROM property WHERE city='" . $p_city . "' and society='" . $p_society . "' and pro_no='" . $p_no . "'";
    $result = mysqli_query($conn, $sl);

    if (mysqli_num_rows($result) == 1) {
?>
        <script>
            // console.log("<?php echo $imgname[0]; ?>");
            alert("This Property is already registered, try another!");
            window.top.location = './profile.php';
        </script>
        <?php
    } else {
        //Insert into the data in the table.
        $in = "INSERT INTO property(u_id,city,society,area,type,pro_no,rent_sell,p_space,price,description) VALUES(" . $id . ", '" . $p_city . "', '" . $p_society . "', '" . $p_area . "', '" . $p_type . "', '" . $p_no . "', '" . $p_rns . "', '" . $p_space . "', " . $p_price . ", '" . $p_desc . "')";
        $q3 = mysqli_query($conn, $in);

        // fetch pr_id
        $fetch= "select pr_id from property where u_id=".$id;
        $match= mysqli_query($conn, $fetch);
        $row = mysqli_fetch_assoc($match);

        $pr_id= $row['pr_id'];

        //For Upload Image
        for($i=0; $i<sizeof($imgname); $i++)
        {
            if ($error[$i] === 0) {
                if ($imgsize[$i] > 2500000) {
        ?>
                    <script>
                        alert("Your file is too large!, Please select another file.");
                        window.top.location = './profile.php';
                    </script>
                    <?php
                } else {
                    $imgEx = pathinfo($imgname[$i], PATHINFO_EXTENSION);
                    $imgEx_lc = strtolower($imgEx);
                    $allowexten = array("jpg", "png", "jpeg");

                    if (in_array($imgEx_lc, $allowexten)) {
                        mkdir("../Uploads/Users/" . $_SESSION['u_id'] . "/P".$pr_id."/", 0777, true);
                        $new_img_name = uniqid("IMG-", true) . '.' . $imgEx_lc;
                        $imge_upload_path = '../Uploads/Users/' . $_SESSION['u_id'] . '/P'.$pr_id.'/' . $new_img_name;
                        move_uploaded_file($tmpname[$i], $imge_upload_path);

                        $q2 = "insert into prop_photo values(".$pr_id.", '".$new_img_name."')";
                        $inp=mysqli_query($conn, $q2);
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

        if ($in && $inp) {
            ?>
            <script>
                alert('Property registered Sucessfully!');
                window.top.location = './profile.php';
            </script>
<?php
        }
    }
}

?>