<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_db";

$id = $_POST['id'];
$pass = $_POST['pass'];

if (!empty($_FILES['file']['name'])) {
    $fileDir = "image/avatar/";
    $fileName = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $fileDir.$fileName);

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE admin SET pass='$pass', file='$fileName' WHERE `id` =  $id";
} else {
    $fileDir = "image/avatar/";
    $fileName = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $fileDir.$fileName);

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE admin SET pass='$pass' WHERE `id` =  $id";
}


// Prepare statement
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();

echo "<script>alert('records UPDATED successfully')</script>";
header("Refresh: 0.1;url=http://localhost/book/admin/index.php");


$conn = null;


