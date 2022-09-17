<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

if (isset($_POST['send'])) {
    $name = $_POST['name'];

    $insert = "INSERT INTO `departments` VALUES (NULL,'$name')";
    $check =  mysqli_query($conn, $insert);
    testMessage($check, "Insert Employee");
}

?>

<h1 class="text-center"> Add Department</h1>


<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label>Department Name</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <button name="send" class="btn btn-info"> Send Data </button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>