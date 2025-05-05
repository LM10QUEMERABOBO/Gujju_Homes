<?php
session_start();
if (!isset($_SESSION['u_id'])) {
	header("location: ../login-signup/login.php");
}

require("../shortlink/connection.php");
if (!$conn) {

?>
	<script>
		alert("Error with the database, Please try after some time.");
	</script>
<?php
}
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
	<title>Profile</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

	<link rel="icon" type="image/x-icon" href="../img/HomeLogo.png">
	<!-- LInk To CSS -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="./profile.css">

	<!-- online links -->
	<?php require("../links/links.php") ?>

	<style>
		@media (max-width: 572px) {
			.signup {
				display: none !important;
			}
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

	<!-- This will add HEADER -->
	<?php require("../shortlink/home_head.php") ?>

	<div>
		<div class="bg-white shadow rounded-lg d-block d-sm-flex">

			<div class="profile-tab-nav border-right">
				<a href="./profile.php" class="prop-logo" style="color: #212529 !important;">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="<?php if ($row['photo'] != "") {
											echo '../Uploads/Users/' . $_SESSION['u_id'] . '/' . $row['photo'];
										} else {
											echo '../Uploads/default_profile.png';
										}
										?>" alt="Image" class="shadow">
						</div>
						<h4 class="text-center"><?php echo $row['username'] ?></h4>
					</div>
				</a>
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="myprofile-tab" data-toggle="pill" href="#myprofile">
						<span class="material-symbols-outlined">
							person
						</span>
						&nbsp;
						Profile
					</a>
					<a class="nav-link" id="myprop-tab" data-toggle="pill" href="#myprop">
						<span class="material-symbols-outlined">
							house
						</span>
						&nbsp;
						My Properties
					</a>
					<a class="nav-link" id="myorders-tab" data-toggle="pill" href="#myorders">
						<span class="material-symbols-outlined">
							real_estate_agent
						</span>
						&nbsp;
						My Orders
					</a>
					<a class="nav-link" id="savedprop-tab" data-toggle="pill" href="#savedprop">
						<span class="material-symbols-outlined">
							favorite
						</span>
						&nbsp;
						Saved Properties
					</a>
					<a class="nav-link" id="booking-tab" data-toggle="pill" href="#booking">
						<span class="material-symbols-outlined">
							bookmark
						</span>
						&nbsp;
						Booking List
					</a>
					<a class="nav-link" id="registerprop-tab" data-toggle="pill" href="#registerprop">
						<span class="material-symbols-outlined">
							domain_add
						</span>
						&nbsp;
						Register Property
					</a>
				</div>
			</div>

			<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

				<div class="tab-pane fade show active" id="myprofile" role="tabpanel">

					<form action="./update_profile.php" method="post" enctype="multipart/form-data" style="all: inherit;">
						<div class="op">

							<img src="<?php if ($row['photo'] != "") {
											echo '../Uploads/Users/' . $_SESSION['u_id'] . '/' . $row['photo'];
										} else {
											echo '../Uploads/default_profile.png';
										}
										?>" id="photo" alt="Image">
							<label for="file_input">Edit&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></label>

							<input type="file" id="file_input" name="myimage">
							<h4><?php echo $row['username'] ?></h4>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="un">User Name:</label>
									<input id="un" name="u_name" type="text" class="form-control" maxlength="20" value="<?php echo $row['username'] ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emai">E-mail:</label>
									<input id="emai" name="u_email" type="text" class="form-control" maxlength="30" value="<?php echo $row['email'] ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="pn">Phone Number:</label>
									<input id="pn" name="u_mobile" type="text" pattern="[0-9]{10}" title="Enter 10 digit phone no." class="form-control" minlength="10" maxlength="10" value="<?php echo $row['mobile'] ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="eecit">City:</label>
									<input id="eecit" name="u_city" type="text" class="form-control" maxlength="20" value="<?php echo $row['city'] ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="addr">Address:</label>
									<textarea style="resize: none;" id="addr" name="u_address" maxlength="100" class="form-control myselect" rows="4"><?php echo $row['address'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="mybtn">
							<input type="submit" class="btn btn-primary" name="save" value="Save Changes">
						</div>
					</form>
				</div>

				<div class="tab-pane fade" id="myprop">
					<h3 class="mb-5 text-center my-center">My Properties</h3>
					<!-- Property List Start -->
					<div class="container-xl name2" id="name2">
						<div class="container">
							<div class="tab-content">
								<div id="tab-1" class="tab-pane fade show p-0 active">
									<div class="row g-4">

										<?php
										$q1 = "SELECT * FROM property WHERE status=0 and u_id=" . $id;
										$result = mysqli_query($conn, $q1);
										while ($r1 = $result->fetch_assoc()) {
										?>
											<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
												<div class="property-item rounded overflow-hidden">
													<div class="position-relative overflow-hidden">
														<a><img class="img-fluid" src="./img/about.jpg" alt=""></a>
														<div class="bg-primary rounded text-white position-absolute top-0 m-4 py-1 px-3">
															<?php echo $r1['rent_sell']; ?></div>
														<div class="bg-success rounded text-white position-absolute top-0 m-4 py-1 px-3" style="left: 6rem;">
															<?php
															$st = $r1['status'];
															if ($st == 0) {
																echo "Available";
															} else {
																echo "Aquired";
															}
															?></div>
														<div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3 text-capitalize">
															<?php echo $r1['type']; ?></div>
													</div>
													<div class="p-4 pb-0 name1">
														<h5 class="text-primary mb-3">Price: <?php echo $r1['price']; ?> ₹</h5>
														<a class="d-block h5 mb-2 text-capitalize"><i class="fa fa-user text-primary me-2 text-ca"></i>Owner: <?php echo $row['username']; ?></a>
														<p class="text-capitalize"><i class="fas fa-map-marker-alt text-primary me-2"></i>City: <?php echo $r1['city']; ?></p>
														<p></i>Address: <?php echo $r1['pr_no'] . $r1['society'] . $r1['area'] . $r1['city']; ?></p>
													</div>
													<!-- <div class="d-flex border-top">
													<a class="btn btn-primary m-auto my-2 py-2 px-4 text-white text-center" href="">Edit</a>
												</div> -->
												</div>
											</div>

										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="myorders">
					<h3 class="mb-5 text-center my-center">My Orders</h3>
					<?php $qr2 = "SELECT pr_id FROM property WHERE u_id=" . $id;
					$re = mysqli_query($conn, $qr2);
					// $re1 = mysqli_fetch_assoc($re);
					// $id1 = $re1['pr_id'];
					$i = 0; ?>
					<table class="table">
						<thead>
							<tr>
								<th>Property No.</th>
								<th>City</th>
								<th>Society</th>
								<th>Rent/Sell</th>
								<!-- <th style="padding: 12px 1px !important;"></th> -->
								<th>Order to</th>
								<th class="text-center">Owner Profile</th>
								<!-- <th style="text-align:center;">-</th> -->
							</tr>
						</thead>
						<tbody>
							<?php

							if ($re) {
								while ($row3 = $re->fetch_assoc()) {
									$pr_id = $row3['pr_id'];
									$q3 = "SELECT * FROM my_orders WHERE pr_id=" . $pr_id;
									$r2 = mysqli_query($conn, $q3);

									if ($r2) {
										while ($row4 = $r2->fetch_assoc()) {

											$q4 = "SELECT * FROM user WHERE u_id=" . $row4['u_id'];
											$r3 = mysqli_fetch_assoc(mysqli_query($conn, $q4));

											$q5 = "SELECT * FROM property WHERE pr_id=" . $row4['pr_id'];
											$r4 = mysqli_fetch_assoc(mysqli_query($conn, $q5));

							?>
											<tr>
												<td><?php echo $r4['pro_no']; ?></td>
												<td><?php echo $r4['city']; ?></td>
												<td><?php echo $r4['society']; ?></td>
												<td><?php echo $r4['rent_sell']; ?></td>
												<!-- <td style="padding: 12px 1px  !important;">=></td> -->

												<td><?php echo $r3['username']; ?></td>

												<td class="text-center"><a class="btn btn-primary" onclick="document.getElementById('<?php echo $i ?>').style.display='block'" title="View User Profile">View</a></td>
											</tr>

											<div id="<?php echo $i ?>" class="modal">

												<div class="modal-content animate" style="width: 30% !important;">
													<div class="imgcontainer" style="margin: 0;">
														<span onclick="document.getElementById('<?php echo $i ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
													</div>
													<div class="container">
														<div class="form" style="all: inherit;">
															<p class="form-title">User Profile</p>
															<p class="form-paragraph">
															</p>
															<div class="container-fluid">
																<div class="row">
																	<div class="col-xll-4 d-inline text-center">

																		<div class="img-circle text-center mb-1">
																			<img src="<?php if ($r3['photo'] != "") {
																							echo '../Uploads/Users/' . $r3['u_id'] . '/' . $r3['photo'];
																						} else {
																							echo '../Uploads/default_profile.png';
																						}
																						?>" alt="Image" class="shadow">
																		</div>
																		<h4 class="text-center"><?php echo $r3['username'] ?></h4>

																		<div class=" text-start mt-3 ps-3 pe-3">
																			<p class="mb-1 align-middle"><i class="fas fa-envelope me-2"></i><?php echo $r3['email'] ?></p>

																			<p class="mb-1 position-relative"><i class="fas fa-phone-alt me-2"></i><?php echo $r3['mobile'] ?>
																				<span class=" position-absolute start-50"><i class="fas fa-map-marker-alt me-2"></i>Patan
																			</p></span>

																			<p class="mt-3 mb-1 align-middle">Address: <?php echo $r3['address'] ?></p>
																		</div>


																	</div>
																</div>
															</div>
															<div class="text-center mt-3 mybtn">
																<input type="ok" onclick="document.getElementById('<?php echo $i ?>').style.display='none'" class="btn btn-primary ok" name="" value="OK">
															</div>
														</div>
													</div>
												</div>
											</div>
							<?php
											$i++;
										}
									}
								}
							}

							?>

						</tbody>
					</table>

					<?php
					$mqr2 = "SELECT pr_id FROM property WHERE u_id=" . $id;
					$mre = mysqli_query($conn, $mqr2);
					$re1 = mysqli_fetch_assoc($mre);
					$id1 = $re1['pr_id'];

					$q9 = "SELECT * FROM my_orders WHERE pr_id=" . $id1;
					$r9 = mysqli_query($conn, $q9);

					if (mysqli_num_rows($r9) < 1) {
						echo "<h2 class='text-center mt-5'>--No Orders Done Yet--</h2>";
					}
					?>

				</div>

				<div class="tab-pane fade" id="savedprop">
					<h3 class="mb-5 text-center my-center">Saved Properties</h3>
					<!-- Property List Start -->
					<div class="container-xxl py-5 name2" id="">
						<div class="container">
							<div class="tab-content">
								<div id="tab-1" class="tab-pane fade show p-0 active">
									<div class="row g-4">
										<?php
										$qr5 = "SELECT * FROM fav_property WHERE u_id=" . $_SESSION['u_id'];
										$re5 = mysqli_query($conn, $qr5);

										?>
										<?php while ($row = $re5->fetch_assoc()) {

											$pid = $row['pr_id'];
											$q7 = "SELECT * FROM property WHERE pr_id=" . $pid . " and status=0";
											$res = mysqli_fetch_assoc(mysqli_query($conn, $q7));
											$uid = $res['u_id'];

											$q8 = "select * from user where u_id=" . $uid;
											$res3 = mysqli_fetch_assoc(mysqli_query($conn, $q8));

											$q9 = "SELECT photo FROM prop_photo WHERE pr_id=" . $pid;
											$res1 = mysqli_fetch_assoc(mysqli_query($conn, $q9));

										?>
											<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
												<div class="property-item rounded overflow-hidden">
													<div class="position-relative overflow-hidden">
														<a href="./property.php?pid=<?php echo $pid ?>&uid=<?php echo $uid ?>"><img class="img-fluid" src="<?php echo '../Uploads/Users/' . $uid . '/P' . $pid . '/' . $res1['photo']; ?>" alt=""></a>
														<div class="bg-primary rounded text-white position-absolute top-0 m-4 py-1 px-3">
															<?php
															echo $res['rent_sell']; ?></div>
														<div class="bg-success rounded text-white position-absolute top-0 m-4 py-1 px-3" style="left: 6rem;">
															<?php
															$st = $res['status'];
															if ($st == 0) {
																echo "Available";
															} else {
																echo "Aquired";
															}
															?>
														</div>
														<div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3 text-capitalize">
															<?php
															echo $res['type']; ?></div>
													</div>
													<div class="p-4 pb-0 name1">
														<h5 class="text-primary mb-3">Price: <?php echo $res['price']; ?> ₹</h5>
														<a class="d-block h5 mb-2 text-capitalize"><i class="fa fa-user text-primary me-2"></i>Owner: <?php echo $res3['username']; ?></a>
														<p class="text-capitalize"><i class="fas fa-map-marker-alt text-primary me-2"></i>
															City: <?php
															echo $res['city']; ?></p>
														<p class="text-capitalize"></i>Address: <?php echo $res['society'] . ', ' . $res['area'] . ', ' . $res['city']; ?></p>
													</div>
													<div class="d-flex border-top">
														<a href="./property.php?pid=<?php echo $pid ?>&uid=<?php echo $uid ?>" class="btn bg-primary rounded text-white m-2 py-2 px-3 border-0" style="margin-left: 3rem !important;">More Details</a>
														<small class="flex-fill text-center border-end py-2"></small>
														<small class="flex-fill text-center heart"><a href="./save1.php?pid=<?php echo $pid ?>"><i class="fa fa-heart text-primary myhear" title="save property"></i></a></small>

													</div>
												</div>
											</div>

										<?php } ?>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="booking">
					<h3 class="mb-5 text-center my-center">Booking List</h3>

					<table class="table">
						<thead>
							<tr>
								<th>Property No.</th>
								<th>City</th>
								<th>Society</th>
								<th>Rent/Sell</th>
								<!-- <th style="padding: 12px 1px !important;"></th> -->
								<th>Interested Users</th>
								<th class="text-center">User Profile</th>
								<th colspan="2" class="text-center">Approve Bookings</th>
								<!-- <th style="text-align:center;">-</th> -->
							</tr>
						</thead>
						<tbody>

							<?php
							$q2 = "SELECT pr_id FROM property WHERE u_id=" . $id;
							$r = mysqli_query($conn, $q2);
							$i = 50;
							if ($r) {
								while ($row3 = $r->fetch_assoc()) {
									$pr_id = $row3['pr_id'];
									$q3 = "SELECT * FROM bookings WHERE pr_id=" . $pr_id;
									$r2 = mysqli_query($conn, $q3);

									if ($r2) {
										while ($row4 = $r2->fetch_assoc()) {

											$q4 = "SELECT * FROM user WHERE u_id=" . $row4['u_id'];
											$r3 = mysqli_fetch_assoc(mysqli_query($conn, $q4));

											$q5 = "SELECT * FROM property WHERE pr_id=" . $row4['pr_id'];
											$r4 = mysqli_fetch_assoc(mysqli_query($conn, $q5));

							?>
											<tr>
												<td><?php echo $r4['pro_no']; ?></td>
												<td><?php echo $r4['city']; ?></td>
												<td><?php echo $r4['society']; ?></td>
												<td><?php echo $r4['rent_sell']; ?></td>
												<!-- <td style="padding: 12px 1px  !important;">=></td> -->

												<td><?php echo $r3['username']; ?></td>

												<td class="text-center"><a class="btn btn-primary" onclick="document.getElementById('<?php echo $i ?>').style.display='block'" title="View User Profile">View</a></td>
												<td class="text-center"><a class="btn btn-danger danger" title="Cancel Booking" href="./delete_booking.php?pid=<?php echo $pr_id; ?>&uid=<?php echo $row4['u_id']; ?>"><span class="material-symbols-outlined">
															close
														</span></a></td>
												<td class="text-center"><a class="btn btn-success" title="Approve Booking" href="./orders.php?pid=<?php echo $pr_id; ?>&uid=<?php echo $row4['u_id']; ?>"><span class="material-symbols-outlined">
															done
														</span></a></td>
											</tr>

											<div id="<?php echo $i; ?>" class="modal">

												<div class="modal-content animate" style="width: 30% !important;">
													<div class="imgcontainer" style="margin: 0;">
														<span onclick="document.getElementById('<?php echo $i ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
													</div>
													<div class="container">
														<div class="form" style="all: inherit;">
															<p class="form-title">User Profile</p>
															<p class="form-paragraph">
															</p>
															<div class="container-fluid">
																<div class="row">
																	<div class="col-xll-4 d-inline text-center">

																		<div class="img-circle text-center mb-1">
																			<img src="<?php if ($r3['photo'] != "") {
																							echo '../Uploads/Users/' . $r3['u_id'] . '/' . $r3['photo'];
																						} else {
																							echo '../Uploads/default_profile.png';
																						}
																						?>" alt="Image" class="shadow">
																		</div>
																		<h4 class="text-center"><?php echo $r3['username'] ?></h4>

																		<div class=" text-start mt-3 ps-3 pe-3">
																			<p class="mb-1 align-middle"><i class="fas fa-envelope me-2"></i><?php echo $r3['email'] ?></p>

																			<p class="mb-1 position-relative"><i class="fas fa-phone-alt me-2"></i><?php echo $r3['mobile'] ?>
																				<span class=" position-absolute start-50"><i class="fas fa-map-marker-alt me-2"></i><?php echo $r3['city'] ?>
																			</p></span>

																			<p class="mt-3 mb-1 align-middle">Address: <?php echo $r3['address'] ?></p>
																		</div>


																	</div>
																</div>
															</div>
															<div class="text-center mt-3 mybtn">
																<input type="ok" onclick="document.getElementById('<?php echo $i ?>').style.display='none'" class="btn btn-primary ok" name="" value="OK">
															</div>
														</div>
													</div>
												</div>
											</div>
							<?php

											$i++;
										}
									}
								}
							}

							?>

						</tbody>
					</table>

					<?php
					$mq2 = "SELECT pr_id FROM property WHERE u_id=" . $id;
					$mr = mysqli_query($conn, $q2);
					$re2 = mysqli_fetch_assoc($mr);
					$id2 = $re2['pr_id'];

					$q6 = "SELECT * FROM bookings WHERE pr_id=" . $id2;
					$r6 = mysqli_query($conn, $q6);

					if (mysqli_num_rows($r6) < 1) {
						echo "<h2 class='text-center mt-5'>--No Bookings--</h2>";
					}
					?>

				</div>

				<div class="tab-pane fade" id="registerprop">
					<h3 class="mb-5 text-center my-center">Register Property</h3>
					<form action="register_property.php" method="post" style="all: inherit;" enctype="multipart/form-data">


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="type">Property Type:<span style="color: red;">*</span></label>
									<input id="type" name="p_type" type="text" class="form-control" placeholder="House/Apartment" maxlength="20" autocomplete="on" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="pno">Property No:<span style="color: red;">*</span></label>
									<input id="pno" name="p_no" type="text" class="form-control" placeholder="7-16-47" maxlength="10" required>
								</div>
							</div>
							<div class="col-md-6 ros">
								<div class="form-group">
									<label for="rns">Property Option:<span style="color: red;">*</span></label>
									<select id="rns" class="form-select myselect" name="p_rns" required>
										<option value="Rent">Rent</option>
										<option value="Sell">Sell</option>
									</select>
								</div>
								</select>
							</div>
							<div class="col-md-6 ros">
								<div class="form-group">
									<label for="space">Property Space:</label>
									<input id="space" name="p_space" type="text" class="form-control" placeholder="1BHK/2BHK/3BHK" maxlength="10">
								</div>
								</select>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="price">Price:<span style="color: red;">*</span></label>
									<input id="price" name="p_price" type="text" pattern="[0-9].{0,}" title="Enter the price in number." class="form-control" placeholder="₹" maxlength="10" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">City:<span style="color: red;">*</span></label>
									<input id="city" name="p_city" type="text" class="form-control" placeholder="Patan/Ahmedabad/Surat" maxlength="15" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Area">Area:<span style="color: red;">*</span></label>
									<input id="Area" name="p_area" type="text" class="form-control" placeholder="Bukdi Chok" maxlength="30" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="society">Society:<span style="color: red;">*</span></label>
									<input id="society" name="p_society" type="text" class="form-control" placeholder="MotoTank Vado" maxlength="30" required>
								</div>
							</div>

							<div class="col-md-6 ros">
								<div class="form-group mybtn">
									<label>Add Photos:<span style="color: red;">*</span></label>
									&nbsp;
									<a id="pho" class="btn btn-primary photo" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i></a>

								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="desc">Description:</label>
									<textarea id="desc" name="p_description" style="resize:none" class="form-control myselect" rows="4" placeholder="About Property..." maxlength="255"></textarea>
								</div>
							</div>
						</div>
						<div class="mybtn">
							<input type="reset" class="btn btn-danger" value="Clear All">
							&nbsp;
							<input type="submit" class="btn btn-primary" name="register" value="REGISTER">
						</div>
						<div id="id01" class="modal">

							<div class="modal-content animate">
								<div class="imgcontainer">
									<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
								</div>
								<div class="container">
									<div class="form" style="all: inherit;">
										<p class="form-title">Upload your file</p>
										<p class="form-paragraph">
											File should be in (.jpg/.png/.jpeg) Formate
										</p>
										<div class="container-fluid">
											<div class="row">
												<div class="col-xll-4 d-inline text-center">

													<input class="btn files_input" type="file" name="upload[]" required>
													<input class="btn files_input" type="file" name="upload[]" required>
													<input class="btn files_input" type="file" name="upload[]">
													<input class="btn files_input" type="file" name="upload[]">
													<input class="btn files_input" type="file" name="upload[]">
													<input class="btn files_input" type="file" name="upload[]">
													<!-- </div <div id="preview"> -->

												</div>
											</div>
										</div>
										<div class="text-center mt-3 mybtn">
											<input type="reset" class="btn btn-danger" value="Remove All">
											&nbsp;
											<input type="ok" onclick="document.getElementById('id01').style.display='none'" class="btn btn-primary ok" id="ok" name="ok" value="Submit">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		//profile photo render
		file_input.onchange = evt => {
			const [file] = file_input.files
			if (file) {
				console.log("error");
				photo.src = URL.createObjectURL(file);
			} else {
				console.log("success");

				<?php if ($row['photo'] == "") { ?>photo.src = "../Uploads/default_profile.png";
				<?php } else { ?>photo.src = "<?php echo '../Uploads/Users/' . $_SESSION['u_id'] . '/' . $row['photo']; ?>";
			<?php } ?>

			}
		}
		document.getElementById("search").style.display = "none";

		function onLogout() {
			if (confirm("Are you sure, You want to Logout?") == 1) {

				window.top.location = '../login-signup/logout.php';

			}
		}
	</script>
</body>

</html>