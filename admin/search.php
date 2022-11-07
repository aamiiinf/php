<?php
require_once("header.php");
$title = (int)$_POST['id'];
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

$sql = "SELECT title,description,writer,genre,price FROM book WHERE title  =$title";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
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
        <ul class="todo-list" data-widget="todo-list">
            <li>
                <!-- drag handle -->
                <span class="handle">
                      <i class="fas fa-book"></i>
                </span>
<!--                <span class="text"> --><?php //echo $row['title']; ?><!--</span>-->
                    <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<br/>" . "<b>title: </b>" . $row["title"]
                                . "<br/>" . "<b>description: </b>" . $row["description"]
                                . "<br/>" . "<b>description: </b>" . $row["writer"]
                                . "<br/>" . "<b>description: </b>" . $row["genre"]
                                . "<br/>" . "<b>description: </b>" . $row["price"] ;
                        }
                    } else {
                        echo "0 results";
                    }?>
            </li>
        </ul>
    </div>
<?php
$conn->close();
require_once("footer.php");