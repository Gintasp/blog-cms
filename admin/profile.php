<?php
include "inc/header.php";
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'inc/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit profile
                    </h1>

                    <?php
                    if (isset($_POST['update_profile'])) {
                        $username = escape($_POST['username']);
                        $firstname = escape($_POST['firstname']);
                        $lastname = escape($_POST['lastname']);
                        $email = escape($_POST['email']);

                        $query = "UPDATE user SET username='{$username}',firstname='{$firstname}',lastname='{$lastname}', ";
                        $query .= "email='{$email}' WHERE id={$_SESSION['user_id']}";
                        $edit_profile = mysqli_query($connection, $query);
                        handle_query_error($edit_profile);

                        if (!empty($_POST['password'])) {
                            $password = escape($_POST['password']);
                            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

                            $query = mysqli_query($connection, "UPDATE user SET password='$password' WHERE id={$_SESSION['user_id']}");
                            handle_query_error($query);
                        }

                        header('Location: index.php');
                    }

                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $query = mysqli_query($connection, "SELECT * FROM user WHERE id=$user_id");
                        handle_query_error($query);

                        while ($row = mysqli_fetch_assoc($query)) {
                            $username_old = $row['username'];
                            $firstname_old = $row['firstname'];
                            $lastname_old = $row['lastname'];
                            $email_old = $row['email'];
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   value="<?php echo $username_old; ?>">
                        </div>

                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" id="firstname"
                                   value="<?php echo $firstname_old; ?>">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                   value="<?php echo $lastname_old; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   value="<?php echo $email_old; ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include 'inc/footer.php'; ?>
