<?php error_reporting(0);?>
<header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					<div class="navbar-header">
						<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
							<i class="ti-align-justify"></i>
						</a>
						<a class="navbar-brand" href="#">
							<h2 style="padding-top:20% ">DentaCare</h2>
						</a>
						<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
							<i class="ti-align-justify"></i>
						</a>
						<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<i class="ti-view-grid"></i>
						</a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-right">
							<!-- start: MESSAGES DROPDOWN -->
								<li  style="padding-top:2% ">
								<h2>DentaCare</h2>
							</li>
						
						
							<li class="dropdown current-user">
    <a href class="dropdown-toggle" data-toggle="dropdown">
        <?php
        // Get the user's profile picture
        $query = mysqli_query($con, "SELECT fullName, profile_picture FROM users WHERE id='" . $_SESSION['id'] . "'");
$row = mysqli_fetch_array($query);
$_SESSION['profile_picture'] = $row['profile_picture']; // Update session
$profilePicture = !empty($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'assets/images/default-user.png';

        ?>
       <img src="<?php echo $profilePicture . '?' . time(); ?>" style="width:40px; height:40px;">
            <?php echo $row['fullName']; ?> <i class="ti-angle-down"></i></span>
    </a>
    <ul class="dropdown-menu dropdown-dark">
        <li>
            <a href="edit-profile.php">My Profile</a>
        </li>
        <li>
            <a href="change-password.php">Change Password</a>
        </li>
        <li>
            <a href="logout.php">Log Out</a>
        </li>
    </ul>
</li>

							<!-- end: USER OPTIONS DROPDOWN -->
						</ul>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
						<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<div class="arrow-left"></div>
							<div class="arrow-right"></div>
						</div>
						<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
					</div>
				
					
					<!-- end: NAVBAR COLLAPSE -->
				</header>
				
				<!-- Include jQuery and Bootstrap JavaScript files -->
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>