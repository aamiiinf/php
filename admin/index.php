<?php
require_once("header.php");
require_once("Book.php");

$book = new Book;
if(isset($_POST['submit'])) {
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

    $book->insertData();
}

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


    ?>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="http://localhost:8000/" type="button" class="btn btn-primary float-right" target="_blank">View <i class="fas fa-eye" style="font-size: 12px;"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PSCR Books</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Amin Foladi PSCR</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
            <?php foreach($book->readAll() as $key=>$value):
                ?>

                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-book"></i>
                    </span>
                    <!-- todo text -->
                      <span class="text"> <?php echo $value['title']; ?></span>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                    <a href="/admin/edit.php?action=edit&id=<?php echo $value['id'] ?>"><i class="fas fa-edit"></i></a>
                    </div>
                  </li>
            <?php  endforeach; ?>

                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="/admin/add.php" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Book</a>
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