<?php
require_once("header.php");
$searchInput = $_GET['search'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM book WHERE `title` LIKE '%" . $searchInput . "%' OR `description` LIKE '%" . $searchInput . "%'";
$result = $conn->query($sql);
session_start();

if( !isset($_SESSION["user"]) ){
    header("Refresh: 0.1;url=http://localhost/book/admin/login_Admin.php");
    exit;
} else {

if ($result->num_rows > 0) {
    ?>
    <style>
        #ax {
            height: 35px;
            width: 35px;
        }
    </style>
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Book List
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm">

            </ul>
        </div>
    </div>
    <div class="card-body">

    <span>search result:</span>
    <ul class="todo-list" data-widget="todo-list">
    <li>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<a href='/single.php?action=view&id=" . $row["id"] . "'><img id='ax' src='image/" . $row["file"] . "'></a>"
            . "<b> Title: </b>" . $row["title"]
            . "<br/>" . "<b>Description: </b>" . $row["description"]
            . "<br/>" . "<b>Writer: </b>" . $row["writer"]
            . "<br/>" . "<b>Genre: </b>" . $row["genre"]
            . "<br/>" . "<b>Price: </b>" . $row["price"]
            . "<br/>" . "<a class='pr-2' href='edit.php?action=edit&id=" . $row["id"] . "'>Edit </a>"
            . "<a href='/single.php?action=view&id=" . $row["id"] . "'>View</a><br /><hr />";
    }
} else {
    echo "<p>Nothing found</p>";
} ?>
    </li>
    </ul>
    </div>
<?php
$conn->close();
require_once("footer.php");
}