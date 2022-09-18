<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

$select = "SELECT * FROM departments";
$departments = mysqli_query($conn, $select);
auth();
?>

<h1 class="text-center"> List Department</h1>


<div class="container col-6 text-center">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th> #ID </th>
                    <th>Department</th>
                </tr>
                <?php foreach ($departments as $data) { ?>
                    <tr>
                        <td> <?= $data['id'] ?> </td>
                        <td> <?= $data['name'] ?> </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>