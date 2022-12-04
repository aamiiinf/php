<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_db";

$id = $_POST['id'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$email = $_POST['email'];


    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 //    set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE admin SET name='$name',pass='$pass',email='$email' WHERE $id";


// Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo "<script>alert('records UPDATED successfully')</script>";
    header("Refresh: 0.1;url=http://localhost/book/admin/index.php");



$conn = null;

