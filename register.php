<?php
include "inc/header.php";
include "inc/navigation.php";

$error_msg = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($username) && !empty($password) && !empty($email)) {
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);

        $query = mysqli_query($connection, "SELECT rand_salt FROM user");
        handle_query_error($query);
        $salt = mysqli_fetch_array($query)['rand_salt'];

        $password = crypt($password, $salt);

        $query = mysqli_query($connection, "INSERT INTO user(username,password,email,role) VALUES('{$username}','{$password}','{$email}','user')");
        handle_query_error($query);
        $error_msg = 'Registered successfully.';
    } else {
        $error_msg = 'Fields cannot be blank.';
    }
}
?>
    <div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="" method="post" id="login-form"
                              autocomplete="off">
                            <h6 class="text-center"><?php echo $error_msg; ?>
                            </h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                            </div>
                            <input type="submit" name="submit" id="btn-login"
                                   class="btn btn-custom btn-lg btn-block"
                                   value="Register">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
<?php include "inc/footer.php";
