<?php
require_once "db_admin_conction.php";
session_start();

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($row['name'] == $username && $row['pass'] == $password) {
        $_SESSION["user"] = $row["name"];
        header("Refresh: 0.1;url=http://localhost/book/admin/index.php");
    } else {
        echo "<script>alert('The username or password is incorrect');</script>";
        header("Refresh: 0.1;url=http://localhost/book/admin/login_Admin.php");
    }
}

?>