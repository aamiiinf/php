<?php

require_once "book.php";

$book = new Book;

if(isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    if($book->deleteData($id)) {
        echo "<script>alert('Removed successfully')</script>";
        header("Refresh: 0.1;url=http://localhost/BOOK/admin/index.php");
    }
}

if(isset($_GET['action']) && $_GET['action'] == "all") {
    $book->deleteAll();
    echo "<script>alert('All removed successfully')</script>";
    header("Refresh: 0.1;url=http://localhost/BOOK/admin/index.php");
}