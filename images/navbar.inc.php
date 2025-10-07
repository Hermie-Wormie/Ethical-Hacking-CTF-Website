<?php session_start(); ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="images/BuzzBites.png" width="50" height="50" alt="BuzzBites Logo" class="d-inline-block align-top">
        </a>
        
        <!-- Hamburger Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Main Navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><span class="d-sm-none"><i class="bi bi-house-door me-2" aria-hidden="true"></i></span>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="restaurant.php"><span class="d-sm-none"><i class="bi bi-shop me-2" aria-hidden="true"></i></span>Restaurants</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reviewsDropdown" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-sm-none"><i class="bi bi-pencil-square me-2" aria-hidden="true"></i></span>Reviews
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reviewsDropdown">
                            <li><a class="dropdown-item" href="writereview.php"><i class="bi bi-plus-circle me-2" aria-hidden="true"></i>Write a Review</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php"><span class="d-sm-none"><i class="bi bi-info-circle me-2" aria-hidden="true"></i></span>About Us</a>
                </li>
            </ul>
            
            <!-- Authentication Section -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" 
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5" aria-hidden="true"></i>
                            <span class="visually-hidden">User profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2" aria-hidden="true"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="myreviews.php"><i class="bi bi-list-ul me-2" aria-hidden="true"></i>My Reviews</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="process/process_logout.php"><i class="bi bi-box-arrow-right me-2" aria-hidden="true"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link d-sm-none">
                            <i class="bi bi-person-circle me-1" aria-hidden="true"></i> Login
                        </a>
                        <a href="login.php" class="btn btn-outline-light d-none d-sm-inline-flex align-items-center">
                            <i class="bi bi-person-circle me-1" aria-hidden="true"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ms-1">
                        <a href="register.php" class="nav-link d-sm-none">
                            <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i> Register
                        </a>
                        <a href="register.php" class="btn btn-primary d-none d-sm-inline-flex align-items-center ms-2">
                            <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i> Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>