<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, name, pass, email FROM admin";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
