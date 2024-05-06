<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open">
                    <a href="" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img style="width: 32px;height:32px" src="<?php echo $admin_img; ?>" alt="..." class="img-circle profile_img">
                    </a>
                    <span><?php
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            } else {
                                echo $_COOKIE['username'];
                            }
                            ?></span>
                    <div class="dropdown-menu dropdown-submenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php $adminBaseUrl; ?>create_setting.php">
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="<?php $adminBaseUrl; ?>logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>


            </ul>
        </nav>
    </div>
</div>