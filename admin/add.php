<?php
require_once("header.php");
require_once("Book.php");
$book = new Book;
$titleErr = $descriptionErr = $writerErr = $genreErr = $priceErr = "";
$title = $description = $writer = $genre = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
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
        $book->setTitle($title);
        $book->setDescription($description);
        $book->setWriter($writer);
        $book->setGenre($genre);
        $book->setPrice($price);

        $book->insertData();
        echo "<script>alert('records UPDATED successfully')</script>";
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

<?php require_once("sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add-Book</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
              <li class="breadcrumb-item active">Add-Book</li>
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
                  Add New Book
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="container"dir="rtl">
                  <div class="card my-5">
                    <div class="card-header"><strong>Add New Book</strong> <a href="index.php" class="float-right btn btn-dark btn-sm">Books List<i class="fa fa-fw fa-globe"></i></a></div>
                      <div class="card-body">
                        <div class="col">
                          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" dir="ltr">
                            <div class="form-group">
                              <label>Title</label>
                              <input type="text" name="title" class="form-control" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                                <span style="color: red;"><?php echo $titleErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Description</label>
                              <input type="text" name="description" class="form-control"
                                     value="<?php echo isset($_POST['description']) ? $_POST['description'] : '' ?>" style="height: 100px">
                                <span style="color: red;"><?php echo $descriptionErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Writer</label>
                              <input type="text" name="writer" class="form-control" value="<?php echo isset($_POST['writer']) ? $_POST['writer'] : '' ?>">
                                <span style="color: red;"><?php echo $writerErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Genre</label>
                              <input type="text" name="genre" class="form-control" value="<?php echo isset($_POST['genre']) ? $_POST['genre'] : '' ?>">
                                <span style="color: red;"><?php echo $genreErr;?></span>
                            </div>

                            <div class="form-group">
                              <label>Praice</label>
                              <input type="text" name="price" class="form-control" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>">
                                <span style="color: red;"><?php echo $priceErr;?></span>
                            </div>

                            <div class="form-group">
                              <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Create<i class="fa fa-fw fa-plus-circle"></i></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
              </div>
              <!-- /.card-body -->
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
