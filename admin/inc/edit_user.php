<?php
if (isset($_POST['update_user'])) {
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $email = $_POST['email'];

    move_uploaded_file($image_temp, "../images/users/$image");

    $query = "UPDATE user SET username='{$username}',firstname='{$firstname}',lastname='{$lastname}',role='{$role}', ";
    $query .= "email='{$email}',image='{$image}' WHERE id={$_GET['u_id']}";
    $edit_user = mysqli_query($connection, $query);
    handle_query_error($edit_user);

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $query = mysqli_query($connection, "UPDATE user SET password='{$password}' WHERE id={$_GET['u_id']}");
        handle_query_error($query);
    }

    header('Location: users.php');
}

if (isset($_GET['u_id'])) {
    $user_id = $_GET['u_id'];
    $query = mysqli_query($connection, "SELECT * FROM user WHERE id=$user_id");
    handle_query_error($query);

    while ($row = mysqli_fetch_assoc($query)) {
        $image_old = $row['image'];
        $username_old = $row['username'];
        $firstname_old = $row['firstname'];
        $lastname_old = $row['lastname'];
        $role_old = $row['role'];
        $email_old = $row['email'];
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo $username_old; ?>">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $firstname_old; ?>">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lastname_old; ?>">
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" value="<?php echo $image_old; ?>">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role">
            <option value="admin" <?php if ($role_old === 'admin') echo 'selected'; ?>>Admin</option>
            <option value="user" <?php if ($role_old === 'user') echo 'selected'; ?>>User</option>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $email_old; ?>">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
</form>