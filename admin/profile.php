<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

$id = $_SESSION['adminID'];


$select = "SELECT * FROM admins where id =$id  ";
$admin = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($admin);
?>

<h1 class="text-center">Your Profile</h1>


<div class="container col-3">
    <div class="card">
        <img src="/odc/admin/upload/<?= $row['image'] ?>" alt="">
        <div class="card-body">
            <h1> Name : <?= $row['userName'] ?> </h1>
            <h1> Role : <?= $row['role'] ?> </h1>
            <button class="btn btn-info">Edit</button>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>