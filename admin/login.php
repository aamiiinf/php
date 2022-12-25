<?php
require_once "db_admin_conction.php";

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($row['name'] == $username && $row['pass'] == $password) {
        header("Refresh: 0.1;url=http://localhost/book/admin/index.php");
    } else {
        header("Refresh: 0.1;url=http://localhost/book/admin/404.php");
    }
}

?>