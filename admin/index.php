<?php
require_once("header.php");
require_once("Book.php");
require_once("pag.php");
require_once("function.php");
require_once("db_admin_conction.php");

$tbl_name = "book";
$color_1 = '1';
$color_2 = '2';
$color = $color_1;
@$users = $_POST['users'];
@$check = $_POST['check'];

if($check == 1){
    $del_param = null;
    $count_users = count((array)$users);

    for($i = 0; $i < $count_users; $i++){
        $del_param .= "id=$users[$i]";
        if($i + 1 < $count_users){
            $del_param .= " OR ";
        }
    }

    if($count_users > 0){
        $query = mysqli_query($conn, "DELETE FROM $tbl_name WHERE $del_param");
    }
}

$book = new Book;

session_start();

if( !isset($_SESSION["user"]) ){

    header("Refresh: 0.1;url=http://localhost/book/admin/login_Admin.php");
    exit;
} else {
?>

<?php require_once("sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <style>.d_none {display: none;}</style>
        <!-- Content Header (Page header) -->
        <?php echo content_header("Dashboard"); ?>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">

                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    Book List
                                </h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class='page-item px-5'>
                                            <a href="delete.php?action=all" onclick="return confirm('Do you want to delete all book?');">Remove All Book</a>
                                        </li>
                                        <?php
                                        $query = "SELECT COUNT(*) FROM book";
                                        $rs_result = mysqli_query($conn, $query);
                                        $row = mysqli_fetch_row($rs_result);
                                        $total_records = $row[0];
                                        echo "</br>";
                                        // Number of pages required.
                                        $total_pages = ceil($total_records / $per_page_record);
                                        $pagLink = "";
                                        if($page>=2){
                                            echo "<li class='page-item px-1'><a href='index.php?page=".($page-1)."'>  Prev </a></li>";
                                        }
                                        for ($i=1; $i<=$total_pages; $i++) {
                                            if ($i == $page) {
                                                $pagLink .= "<li class='page-item px-1'><a class = 'active' href='index.php?page="
                                                    .$i."'>".$i." </a></li>";
                                            }
                                            else  {
                                                $pagLink .= "<li class='page-item px-1'><a href='index.php?page=".$i."'>   
                                                ".$i." </a></li>";
                                            }
                                        };
                                        echo $pagLink;
                                        if($page<$total_pages){
                                            echo "<li class='page-item px-1'><a href='index.php?page=".($page+1)."'>  Next </a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <?php
                            echo '<form action="#" method="post">' . "\n";
                            echo '<div class="d-flex justify-content-end px-3">';
                            echo '<input name="check" type="hidden" value="1">' . "\n";
                            echo '<input type="submit" value="Remove selected items" class="btn btn-light" onclick="return confirm(`Are you sure to delete the selected items?`);">' . "\n";
                            echo '</div>';
                            ?>
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">
                                    <?php foreach($book->readAll() as $key=>$value): ?>
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <img src="image/<?php echo $value['file']; ?>" height="100" width="100">
                                            </span>
                                            <!-- todo text -->
                                            <span class="text"> <?php echo $value['title']; ?></span>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <a href="/single.php?action=view&id=<?php echo $value['id'] ?>"><i class="fas fa-eye"></i></a>
                                                <a href="edit.php?action=edit&id=<?php echo $value['id'] ?>"><i class="fas fa-edit"></i></a>
                                                <a href="delete.php?action=delete&id=<?php echo $value['id'] ?>"><i class="fa fa-trash" onclick="return confirm('Do you want to delete the book?');"></i></a>
                                                <?php
                                                echo "\n" . '<input name="users[]" type="checkbox" value="' . $value['id'] . '"> ' . "\n" . "\n";
                                                if($color == $color_1){
                                                    $color = $color_2;
                                                } else{
                                                    $color = $color_1;
                                                }?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php echo '</form>' . "\n"; ?>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="add.php" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Book</a>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script>
        function go2Page()
        {
            var page = document.getElementById("page").value;
            page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));
            window.location.href = 'index.php?page='+page;
        }
    </script>


<?php require_once("footer.php");} ?>