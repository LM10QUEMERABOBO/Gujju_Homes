<div class="nav1">
          <ul>
            <li><a href="./admin_profile.php" class="logo2" id="logo">
                <img src="<?php if ($row['photo'] != "") {
                            echo '../Uploads/Admins/' . $_SESSION['u_id'] . '/' . $row['photo'];
                          } else {
                            echo '../Uploads/default_profile.png';
                          }
                          ?>">
                <span class="nav-admin"><?php echo $row['username'] ?></span>
              </a></li>

            <li><a href="./dashboard.php" class="Dashboard" id="dashboard">
                <i class="fas fa-menorah"></i>
                <span class="nav-item">Dashboard</span>
              </a></li>

            <li><a href="./Manage_Properties.php" id="manage">
                <i class="fas fa-home"></i>
                <span class="nav-item">Manage Properties</span>
              </a></li>

            <li><a href="./user_list.php" id="user">
                <i class="fas fa-user"></i>
                <span class="nav-item">Manage Users</span>
              </a></li>

            <li><a href="./Emails.php" id="email">
                <i class="fas fa-envelope"></i>
                <span class="nav-item">Mails</span>
              </a></li>

              <li><a onclick="onLogout()">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Logout &nbsp;</span>
              </a></li>
              <!-- <button class="buttons signup btn-head" onclick="onLogout()">Logout &nbsp;<i class="fa fa-sign-out"></i></button> -->
          </ul>
        </div>