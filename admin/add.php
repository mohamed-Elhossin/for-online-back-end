<?php
include '../genral/env.php';
include '../genral/functions.php';
include '../shared/head.php';
include '../shared/nav.php';


if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $newPassword = sha1($password);
    $role = $_POST['role'];
    $image_Name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/" . $image_Name;

    if (move_uploaded_file($tmp_name, $location)) {
        echo "Upload Done";
    } else {
        echo "uplaod False";
    }

    $insert = "INSERT INTO admins VALUES (null , '$name','$newPassword','$image_Name',$role)";
    $i =  mysqli_query($conn, $insert);
    testMessage($i, "Insert Admin");
}

$select = "SELECT * FROM roles";
$roles = mysqli_query($conn, $select);


auth(1);
?>

<h1 class="text-center"> Add Admin Page</h1>


<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>User Name</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label>User Password</label>
                    <input class="form-control" name="password" type="text">
                </div>
                <div class="form-group">
                    <label>User Profile</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="form-group">
                    <label>User Role</label>
                    <select name="role" id="" class="form-control">
                        <?php foreach ($roles as $data) : ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['descriptoin'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="add" class="btn btn-info"> Add New </button>
            </form>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>