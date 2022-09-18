<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

$select = "SELECT * FROM employees";
$employees = mysqli_query($conn, $select);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $select = "SELECT * FROM employees where id = $id";
    $employees = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($employees);
    $image = $row['image'];
    unlink($image);
    $delete = "delete from employees where id = $id";

    mysqli_query($conn, $delete);
    header("location:/odc/employees/list.php");
}
auth();
?>

<h1 class="text-center"> List Employees</h1>


<div class="container-fluid col-md-6 text-center">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th> #ID </th>
                    <th> Employee</th>
                    <th> Action</th>
                </tr>
                <?php foreach ($employees as $data) { ?>
                    <tr>
                        <td> <?= $data['id'] ?> </td>
                        <td> <?= $data['name'] ?> </td>
                        <td>
                            <div class="dropdown">
                                <i type="button" data-toggle="dropdown" aria-expanded="false" class="fa-solid btn btn-light fa-ellipsis-vertical"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-info" href="/odc/employees/show.php?show=<?= $data['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                                    <a class="dropdown-item text-primary" href="/odc/employees/update.php?edit=<?= $data['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="dropdown-item text-danger" href="/odc/employees/list.php?delete=<?= $data['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>