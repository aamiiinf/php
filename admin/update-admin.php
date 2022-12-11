<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_db";

$id = $_POST['id'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$email = $_POST['email'];

$fileDir= "image/";
$fileName= $fileDir. basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $fileName);

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//    set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "UPDATE admin SET name='$name',pass='$pass',email='$email', file='$fileName' WHERE $id";


// Prepare statement
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();

echo "<script>alert('records UPDATED successfully')</script>";
header("Refresh: 0.1;url=http://localhost/book/admin/index.php");


$conn = null;


