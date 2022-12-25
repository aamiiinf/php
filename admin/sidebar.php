<?php
require_once "db_admin_conction.php";

?>
<style>
    .user-panel img {
        height: 35px;
        width: 35px;
    }
</style>
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
            <img src="image/avatar/<?php echo $row['file']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="edit-user.php" class="d-block">
              <?php echo $row['name']; ?>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
            <form action="search.php" method="get">
                <input class="form-control form-control-sidebar" name="search" type="text" placeholder="Search" aria-label="Search" required>
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


