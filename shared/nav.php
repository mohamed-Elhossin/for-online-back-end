<?php session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('location:/odc/auth/login.php');
} ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION['admin'])) :   ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Department
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc/department/list.php">List All </a>
                        <a class="dropdown-item" href="/odc/department/add.php">Create New</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Emoloyees
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc/employees/list.php">List All</a>
                        <a class="dropdown-item" href="/odc/employees/add.php">Create New</a>
                    </div>
                </li>
                <a class="nav-link " href="/odc/admin/profile.php" role="button">
                    Profile
                </a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/odc/admin/list.php">List All</a>
                        <a class="dropdown-item" href="/odc/admin/add.php">Create New</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION['admin'])) : ?>
            <form class="form-inline my-2 my-lg-0">
                <button name="logout" class="btn btn-danger"> LogOut </button>
            </form>
        <?php else : ?>
            <a href="/odc/auth/login.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
        <?php endif; ?>

    </div>
</nav>