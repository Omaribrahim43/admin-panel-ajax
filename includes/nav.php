<?php include('functions/init.php'); ?>
<nav class="navbar bg-dark border-bottom border-body">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="Logo" width="40" class="d-inline-block align-text-top">
        </a>
        <?php
        if (logged_in()) { ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userAccountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    User Account
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userAccountDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        <?php
        } else { ?>
            <div class="btn-group" role="group">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        <?php } ?>
        <!-- User Account Dropdown -->
    </div>
</nav>