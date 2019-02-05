<?php
include "db.php";
include "../admin/inc/functions.php";
session_start();

if (isset($_POST['login'])) {
    login_user($_POST['username'], $_POST['password']);
}

