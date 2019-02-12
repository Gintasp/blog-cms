<?php
session_start();

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['role'] = null;
$_POST['username'] = null;
$_POST['password'] = null;
$_SESSION['user_id'] = null;
header("Location: ../index.php");