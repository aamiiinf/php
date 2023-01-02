<?php
require_once("header.php");
require_once "db_admin_conction.php";
require_once("function.php");
session_start();

if( !isset($_SESSION["user"]) ){

    header("Refresh: 0.1;url=http://localhost/book/admin/login_Admin.php");
    exit;
} else {

    ?>

    <?php require_once("sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php echo content_header("Edit Admin"); ?>
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
                                    <i class="ion ion-person mr-1"></i>
                                    Edit Admin
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="container" dir="rtl">
                                    <div class="card my-5">
                                        <div class="card-header"><strong>Edit Admin</strong></div>
                                        <div class="card-body">
                                            <div class="col">
                                                <form method="post" action="update-admin.php" dir="ltr"
                                                      enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <input type="hidden" name="id" class="form-control"
                                                               value="<?php echo $row['id'] ?>">
                                                        <label>Username</label>
                                                        <input type="text" name="name" class="form-control"
                                                               value="<?php echo $row['name'] ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                               value="<?php echo $row['email'] ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="pass" class="form-control"
                                                               value="<?php echo $row['pass'] ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Picture</label>
                                                        <input type="file" name="file" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" name="edit" value="submit" id="submit"
                                                                class="btn btn-primary">Edit Admin
                                                        </button>
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

    <?php
    require_once("footer.php");
    mysqli_close($conn);
}
?>