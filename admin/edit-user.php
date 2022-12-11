<?php
require_once("header.php");
require_once "db_admin_conction.php";
?>

<?php require_once("sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit-Admin</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                                <li class="breadcrumb-item active">Edit-Admin</li>
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
                                        <i class="ion ion-person mr-1"></i>
                                        Edit Admin
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="container"dir="rtl">
                                        <div class="card my-5">
                                            <div class="card-header"><strong>Edit Admin</strong></div>
                                            <div class="card-body">
                                                <div class="col">
                                                    <form method="post" action="update-admin.php" dir="ltr" enctype="multipart/form-data">

                                                        <div class="form-group">
                                                            <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                                                            <label>Username</label>
                                                            <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input type="text" name="pass" class="form-control" value="<?php echo $row['pass'] ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Picture</label>
                                                            <input type="file" name="file" class="form-control" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <button type="submit" name="edit" value="submit" id="submit" class="btn btn-primary">Edit Admin</button>
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
?>