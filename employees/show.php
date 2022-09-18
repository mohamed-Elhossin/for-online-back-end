<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $select = "SELECT * FROM `employeesjoindepartment` where empId =$id";
    $employee = mysqli_query($conn, $select);
    $row =  mysqli_fetch_assoc($employee);
}

auth();
?>

<h6 class="text-center"> Show Employee : <?= $row['empName'] ?> </h6>

<div class="container-fluid col-md-3 text-center">
    <div class="card">
        <img src="/odc/employees/<?= $row['image'] ?>" class="card-img-top" alt="">
        <div class="card-body">
            <p> Name : <?= $row['empName'] ?></p>
            <p> salary : <?= $row['salary'] ?></p>
            <p> phone : <?= $row['phone'] ?></p>
            <p> city : <?= $row['city'] ?></p>
            <p> department : <?= $row['depName'] ?></p>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>