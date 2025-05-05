<header>
    <div class="header">
        <a href="./home.php" class="logo"><img class="images home-logo" src="../img/MainLogo.png" alt="Logo"></a>
        <div class="head-btn">
            <a href="./profile.php" title="profile" class="logo4">
            <span class="user-txt signup"><span><?php echo $row['username']; ?></span></span>

                <img src="<?php if ($row['photo'] != "") {
                                echo '../Uploads/Users/' . $_SESSION['u_id'] . '/' . $row['photo'];
                            } else {
                                echo '../Uploads/default_profile.png';
                            }
                            ?>"></a>
            <i class="fa fa-sign-out logout signup" onclick="onLogout()" title="logout"></i>
        </div>
    </div>
</header>
<!-- Navbar -->
<nav>
    <div class="navmenu">
        <!-- Nav List -->
        <ul class="navmenubar ul">
            <li><a href="./home.php" id="homes"><i class="fa fa-home"></i>&nbsp;Home</a></li>
            <li class="aboutus"><a href="../home/about.php" id="about">About</a></li>
            <li class="contactus"><a href="../home/contact.php" id="contact">Contact</a></li>
            <li class="filter"><a href="../home/filter.php" id="filter">Advance Search</a></li>

        </ul>
    </div>
    <div class="menu">
        <a href="#search1" style="color: unset;" title="search property" id="search">
            <i class="fa fa-search" aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" style="color: unset;" onclick="opencloseNav()">
            <i class="fa fa-bars" id="bars" aria-hidden="true"></i>

        </a>
    </div>
</nav>
<!-- Home -->
<div class="afterNav">
    <div id="mySidenav" class="sidenav">
        <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
        <a href="../home/about.php">About</a>
        <a href="../home/contact.php">Contact</a>
        <a href="../home/filter.php">Advance Search</a>
        <a href="#" onclick="onLogout()">Logout &nbsp;<i class="fa fa-sign-out"></i></a>

    </div>