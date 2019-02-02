<?php
if (isset($_POST['create_user'])) {
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    move_uploaded_file($image_temp, "../images/users/$image");
    $password = mysqli_real_escape_string($connection, $password);
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

    $query = "INSERT INTO user(username,firstname,lastname,role,email,password,image) ";
    $query .= "VALUES('{$username}','{$firstname}','{$lastname}','{$role}','{$email}','{$password}','{$image}')";
    $add_user = mysqli_query($connection, $query);
    handle_query_error($add_user);
    header('Location: users.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname">
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>
</form>