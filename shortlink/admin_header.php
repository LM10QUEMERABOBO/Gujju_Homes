<header>
  <div class="header" style="background: var(--main-color);">
    <a href="./dashboard.php" class="logo"><img class="images home-logo" src="../img/FootLogo.png" alt="Logo"></a>
    <div class="head-btn">
      <!-- <button class="buttons signup btn-head" onclick="onLogout()">Logout &nbsp;<i class="fa fa-sign-out"></i></button> -->
      <span class="admin-txt"><span>Admin-<?php echo $row['username']; ?></span></span><a href="./admin_profile.php" class="logo3">
        <img src="<?php if ($row['photo'] != "") {
                    echo '../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $row['photo'];
                  } else {
                    echo '../Uploads/default_profile.png';
                  }
                  ?>" alt=""></a>
        <i class="fa fa-sign-out logout" onclick="onLogout()" title="logout"></i>

    </div>
  </div>
</header>
<!-- Navbar -->