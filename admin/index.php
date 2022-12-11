<?php
require_once("header.php");
require_once("Book.php");

$book = new Book;

require_once("pag.php");

    ?>

<?php require_once("sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                        <!--<input id="page" type="number" min="1" max="--><?php //echo $total_pages?><!--"-->
                        <!--placeholder="--><?php //echo $page."/".$total_pages; ?><!--" required>-->
                        <!--<button onClick="go2Page();">Go</button>-->
                    </ul>
                </div>
              </div>
              <!-- /.card-header -->
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
                    </div>
                  </li>
            <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="add.php" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Book</a>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->

          <!-- right col -->
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

<?php require_once("footer.php"); ?>