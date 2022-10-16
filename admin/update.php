<?php
require_once "book.php";
?>



<?php

$book = new Book;
if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $writer = $_POST['writer'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    $book->setTitle($title);
    $book->setDescription($description);
    $book->setWriter($writer);
    $book->setGenre($genre);
    $book->setPrice($price);

    if($book->UpdateData($id)) {
        header("location:index.php?update");
    }
}

?>

