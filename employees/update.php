<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $selectt = "SELECT * from `employees` where id =$id";
    $employee = mysqli_query($conn, $selectt);
    $row =  mysqli_fetch_assoc($employee);

    if (isset($_POST['upadte'])) {
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        // Image Code

        if (empty($_FILES['image']['name'])) {
            $image_Name = $row['image'];
        } else {
            $image_Name = time() . $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = "./upload/" . $image_Name;
            if (move_uploaded_file($tmp_name, $location)) {
                echo "Upload Done";
            } else {
                echo "uplaod False";
            }
        }


        $departmentId = $_POST['departmentId'];
        $update = "UPDATE employees SET name = '$name' , salary= $salary , phone ='$phone',city ='$city' , image ='$image_Name' ,departmentId =$departmentId where id =$id    ";
        $check = mysqli_query($conn, $update);
        testMessage($check, "Update Employee");
    }
}


$select = "SELECT * FROM departments";
$deps = mysqli_query($conn, $select);

auth();

?>
<!-- POST
[key =>"Value"] -->
<h1 class="text-center"> Upadate Employee : </h1>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Employee Name * : </label>
                    <input class="form-control" required value="<?= $row['name'] ?>" name="name" type="text">
                </div>
                <div class="form-group">
                    <label>Employee salary</label>
                    <input class="form-control" value="<?= $row['salary'] ?>" name="salary" type="text">
                </div>
                <div class="form-group">
                    <label>Employee phone</label>
                    <input class="form-control" value="<?= $row['phone'] ?>" name="phone" type="text">
                </div>
                <div class="form-group">
                    <label>Employee city</label>
                    <input class="form-control" value="<?= $row['city'] ?>" name="city" type="text">
                </div>
                <div class="form-group">
                    <label>Profile Image : <img src="/odc/employees/upload/<?= $row['image'] ?>" width="20"></label>
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
                <button name="upadte" class="btn btn-primary"> upadte Data </button>
            </form>
        </div>
    </div>
</div>



<?php include '../shared/footer.php'; ?>