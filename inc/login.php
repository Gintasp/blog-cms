<?php
include "db.php";
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
}

$query = mysqli_query($connection, "SELECT * FROM user WHERE username='{$username}'");
if (!$query) {
    die("Query failed. " . mysqli_error($connection));
}

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
    header("Location: ../admin/index.php");
} else {
    header("Location: ../index.php");
}