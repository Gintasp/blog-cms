<?php
function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $title = $_POST['cat_title'];
        if ($title === "" || empty($title)) {
            echo "This field should not be empty.";
        } else {
            $query = mysqli_query($connection, "INSERT INTO category(title) VALUES('{$title}')");
            if (!$query) {
                die("Query failed. " . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM category");
    if (!$query) {
        die("Query failed. " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><a href="categories.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
            <td><a href="categories.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
        </tr>
    <?php }
}

function delete_category()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = mysqli_query($connection, "DELETE FROM category WHERE id={$id}");
        if (!$query) {
            die("Query failed. " . mysqli_error($connection));
        }
        header("Location: categories.php");
    }
}

function handle_query_error($query)
{
    global $connection;
    if (!$query) {
        die('Query failed. ' . mysqli_error($connection));
    }
}

function users_online()
{
    if (isset($_GET['online'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include '../../inc/db.php';

            $session = session_id();
            $time = time();
            $time_out = $time - 60;
            $query = mysqli_query($connection, "SELECT * FROM online WHERE session='$session'");
            handle_query_error($query);
            $count_user = mysqli_num_rows($query);

            if ($count_user == NULL) {
                mysqli_query($connection, "INSERT INTO online(session,time) VALUES('{$session}','{$time}')");
            } else {
                mysqli_query($connection, "UPDATE online SET time='$time' WHERE session='$session'");
            }

            $query = mysqli_query($connection, "SELECT * FROM online WHERE time>'$time_out'");
            handle_query_error($query);

            echo $count_user = mysqli_num_rows($query);
        }
    }
}

users_online();

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function count_rows($table)
{
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM " . $table);
    handle_query_error($query);
    $count = mysqli_num_rows($query);
    return $count;
}

function select_where($table, $field, $value)
{
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM $table WHERE LOWER($field) = '$value'");
    handle_query_error($query);
    return $query;
}

function check_admin()
{
    if ($_SESSION['role'] !== 'admin') {
        header("Location: ../index.php");
    }
}

function username_valid($username)
{
    global $connection;
    $query = mysqli_query($connection, "SELECT role FROM user WHERE username = '$username'");
    handle_query_error($query);
    return mysqli_num_rows($query) === 0;
}

function email_valid($email)
{
    global $connection;
    $query = mysqli_query($connection, "SELECT email FROM user WHERE email = '$email'");
    handle_query_error($query);
    return mysqli_num_rows($query) === 0;
}

function login_user($username, $password)
{
    global $connection;
    $username = trim(escape($username));
    $password = trim(escape($password));

    $query = mysqli_query($connection, "SELECT * FROM user WHERE username='{$username}'");
    handle_query_error($query);

    while ($row = mysqli_fetch_array($query)) {
        $db_id = $row['id'];
        $db_firstname = $row['firstname'];
        $db_lastname = $row['lastname'];
        $db_role = $row['role'];
        $db_username = $row['username'];
        $db_password = $row['password'];
    }

    if (password_verify($password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;
        $_SESSION['user_id'] = $db_id;
        header("Location: /cms/admin/index.php");
    } else {
        header("Location: /cms/index.php");
    }
}

function check_method($method = null)
{
    return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
}

function is_logged_in()
{
    return isset($_SESSION['role']);
}

function check_login($redirect)
{
    if (!is_logged_in()) {
        header("Location: " . $redirect);
    }
}

function already_liked($post_id = '')
{
    global $connection;
    if (!isset($_SESSION['user_id'])) return false;
    $query = mysqli_query($connection, "SELECT * FROM likes WHERE user_id={$_SESSION['user_id']} AND post_id=$post_id");
    handle_query_error($query);

    return mysqli_num_rows($query) == 1;
}