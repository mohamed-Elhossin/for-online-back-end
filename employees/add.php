<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    // Image Code
    $image_Name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/" . $image_Name;
    if (move_uploaded_file($tmp_name, $location)) {
        echo "Upload Done";
    } else {
        echo "uplaod False";
    }

    $departmentId = $_POST['departmentId'];
    $insert = "INSERT INTO employees VALUES(null , '$name',$salary,'$phone','$city' ,'$location',$departmentId)";
    $check = mysqli_query($conn, $insert);
    testMessage($check, "Insert Employee");
}

$select = "SELECT * FROM departments";
$deps = mysqli_query($conn, $select);


auth(1,2);


?>
<!-- POST
[key =>"Value"] -->
<h1 class="text-center"> Add Employee </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label>Employee salary</label>
                    <input class="form-control" name="salary" type="text">
                </div>
                <div class="form-group">
                    <label>Employee phone</label>
                    <input class="form-control" name="phone" type="text">
                </div>
                <div class="form-group">
                    <label>Employee city</label>
                    <input class="form-control" name="city" type="text">
                </div>
                <div class="form-group">
                    <label>Profile Image</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="form-group">
                    <label>Department id</label>
                    <select name="departmentId" class="form-control">
                        <?php foreach ($deps as $data) { ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>
                        <?php  } ?>
                    </select>
                </div>
                <button name="send" class="btn btn-info"> Send Data </button>
            </form>
        </div>
    </div>
</div>



<?php include '../shared/footer.php'; ?>