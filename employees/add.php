<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';

$errors = [];
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $departmentId = $_POST['departmentId'];
    $email = $_POST['email'];
    // Image Code
    $image_Name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];
    $location = "./upload/" . $image_Name;

    $lengthOfName = strlen($name);
    $lengthOfNameS = strlen(strip_tags($name));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter Example@examle.com";
    }
    if ($lengthOfName != $lengthOfNameS) {
        $errors[] = "Cant Enter Char < . > / ) (";
    }
    if (
        $image_type == "image/jpeg" || $image_type == "image/png" ||
        $image_type == "image/jpg"
    ) {
        if (($image_size / 1024) / 1024 > 2) {
            $errors[] = "Cant Upload File More than 2:MB";
        } else {
            move_uploaded_file($tmp_name, $location);
        }
    } else {
        $errors[] = "Youe must Enter File (png , jpg, jpeg)";
    }
    if (trim($name) == "") {
        $errors[] =  "Please Ente Name less than 3: 20";
    }
    if (trim($salary) == "") {
        $errors[] =  "Please Enter Your Salary";
    }
    if (empty($errors)) {
        $insert = "INSERT INTO employees VALUES(null , '$name',$salary,'$location',$departmentId)";
        $check = mysqli_query($conn, $insert);
        testMessage($check, "Insert Employee");
    }
}

$select = "SELECT * FROM departments";
$deps = mysqli_query($conn, $select);


function validation($input)
{
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    return $input;
}

auth(1, 2);


print_r($_FILES);
?>
<!-- POST
[key =>"Value"] -->
<h1 class="text-center"> Add Employee </h1>

<?php if (!empty($errors)) :  ?>
    <div class="alert alert-danger mx-auto w-50">
        <ul>
            <?php foreach ($errors as $data) : ?>
                <li> <?= $data ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input id="inputName" class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label>Employee salary</label>
                    <input class="form-control" name="salary" type="text">
                </div>
                <div class="form-group">
                    <label>Employee email</label>
                    <input class="form-control" name="email" type="text">
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
                <button id="btn" name="send" class="btn btn-info"> Send Data </button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>