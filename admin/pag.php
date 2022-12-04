<?php

//   **** For Pagination ****
$conn = mysqli_connect('localhost', 'root', '');
if (! $conn) {
    die("Connection failed" . mysqli_connect_error());
}

else {
    mysqli_select_db($conn, 'books_db');
    $per_page_record = 10;

    // Look for a GET variable page if not found default is 1.
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    }
    else {
        $page=1;
    }
    $start_from = ($page-1) * $per_page_record;
    $query = "SELECT * FROM book LIMIT $start_from, $per_page_record";
    $rs_result = mysqli_query ($conn, $query);
}