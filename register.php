<?php
include "inc/header.php";
include "inc/navigation.php";

if (isset($_POST['submit'])) {
    $username = trim(escape($_POST['username']));
    $password = trim(escape($_POST['password']));
    $email = trim(escape($_POST['email']));

    $validation_errors = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    if (strlen($username) < 4) {
        $validation_errors['username'] = 'Username has to be at least 4 characters long.';
    }
    if (!username_valid($username)) {
        $validation_errors['username'] = 'Username already taken.';
    }
    if (!email_valid($email)) {
        $validation_errors['email'] = 'Email already exists.';
    }
    if (strlen($password) < 6) {
        $validation_errors['password'] = 'Password must be at least 6 characters long.';
    }

    if (!empty($username) && !empty($password) && !empty($email)) {
        foreach ($validation_errors as $key => $value) {
            if (empty($value)) {
                unset($validation_errors[$key]);
            }
        }

        if (empty($error)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

            $query = mysqli_query($connection, "INSERT INTO user(username,password,email,role) VALUES('{$username}','{$password_hash}','{$email}','user')");
            handle_query_error($query);

            login_user($username, $password);
        }
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
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username"
                                       value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                                <p><?php echo isset($validation_errors['username']) ? $validation_errors['username'] : ''; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com"
                                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                <p><?php echo isset($validation_errors['email']) ? $validation_errors['email'] : ''; ?></p>

                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password"
                                       value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                                <p><?php echo isset($validation_errors['password']) ? $validation_errors['password'] : ''; ?></p>
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
