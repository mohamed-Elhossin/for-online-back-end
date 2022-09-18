<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';


if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $newPassword = sha1($password);
    $select = "SELECT * FROM `admins` WHERE `userName` = '$name' and `password`= '$newPassword'  ";
    $s = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($s);
    $count =   mysqli_num_rows($s);
    if ($count == 1) {
        $_SESSION['adminRole'] = $row['role'];
        $_SESSION['admin'] = $name;
        $_SESSION['adminID'] = $row['id'];
        header("location: /odc/");
    } else {
        echo "False admin";
    }
}



?>

<h1 class="text-center"> Login Page</h1>


<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label>User Name</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label>User Password</label>
                    <input class="form-control" name="password" type="text">
                </div>
                <button name="login" class="btn btn-info"> Loign </button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>