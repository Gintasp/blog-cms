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