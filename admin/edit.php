<?php
require_once("header.php");
require_once("Book.php");


$book = new Book;

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET['id'];
    $result = $book->getOne($id);
}

$titleErr = $descriptionErr = $writerErr = $genreErr = $priceErr = "";
$title = $description = $writer = $genre = $price = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $valid = false;
        $titleErr = "title is required";
    } else {
        $title = init_input($_POST["title"]);
    }

    if (empty($_POST["description"])) {
        $valid = false;
        $descriptionErr = "description is required";
    } else {
        $description = init_input($_POST["description"]);
    }

    if (empty($_POST["writer"])) {
        $valid = false;
        $writerErr = "writer is empty";
    } else {
        $writer = init_input($_POST["writer"]);
    }

    if (empty($_POST["genre"])) {
        $valid = false;
        $genreErr = "genre is empty";
    } else {
        $genre = init_input($_POST["genre"]);
    }

    if (empty($_POST["price"])) {
        $valid = false;
        $priceErr = "price is required";
    } else {
        $price = init_input($_POST["price"]);
        if (!preg_match("/^[0-9]+$/i", $price)) {
            $valid = false;
            $priceErr = 'Invalid Number!';
            $error    = 1;
        }
    }
    if($valid){
        $id = $_POST['id'];
        $book->setTitle($title);
        $book->setDescription($description);
        $book->setWriter($writer);
        $book->setGenre($genre);
        $book->setPrice($price);
        $book->UpdateData($id);
        echo "<script>alert('records Update successfully')</script>";
        header("Refresh: 0.1;url=http://localhost/book/admin/index.php");
        exit();
    }
}

function init_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                    <a href="http://localhost/book" type="button" class="btn btn-primary float-right" target="_blank">View Books <i class="fas fa-eye" style="font-size: 12px;"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link">
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
                        <a href="edit-user.php" class="d-block">
                            <?php
                            echo "amin";
                            ?>
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <form action="search.php" method="post">
                        <input class="form-control form-control-sidebar" name="id" type="search" placeholder="Search" aria-label="Search" required>
                        <button class="btn btn-sidebar btn-block">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </form>
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
            <h1 class="m-0">Edit-Book</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
              <li class="breadcrumb-item active">Edit-Book</li>
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
                  Edit Book
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="container"dir="rtl">
                  <div class="card my-5">
                    <div class="card-header"><strong>Edit Book</strong> <a href="index.php" class="float-right btn btn-dark btn-sm">Books List<i class="fa fa-fw fa-globe"></i></a></div>
                      <div class="card-body">
                        <div class="col">
                          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" dir="ltr">
                              <input type="hidden" name="id" value="<?php echo $result['id']; ?>" >
                          <div class="form-group">
                              <label>Title</label>
                              <input type="text" name="title" class="form-control" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $result['title']; ?>">
                              <span style="color: red;"><?php echo $titleErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Description</label>
                                <input type="text" name="description" class="form-control" style="height: 100px" value="<?php echo isset($_POST['description']) ? $_POST['description'] : $result['description']; ?>">
                                <span style="color: red;"><?php echo $descriptionErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Writer</label>
                              <input type="text" name="writer" class="form-control" value="<?php echo isset($_POST['writer']) ? $_POST['writer'] : $result['writer']; ?>">
                                <span style="color: red;"><?php echo $writerErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Genre</label>
                              <input type="text" name="genre" class="form-control" value="<?php echo isset($_POST['genre']) ? $_POST['genre'] : $result['genre']; ?>">
                                <span style="color: red;"><?php echo $genreErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Praice</label>
                              <input type="text" name="price" class="form-control" value="<?php echo isset($_POST['price']) ? $_POST['price'] : $result['price']; ?>">
                                <span style="color: red;"><?php echo $priceErr;?></span>
                            </div>

                            <div class="form-group">
                              <button type="submit" name="edit" value="submit" id="submit" class="btn btn-primary">Edit Book</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
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
  <?php require_once("footer.php"); ?>