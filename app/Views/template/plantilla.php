
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/fontawesome-free/css/all.min.css"; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"; ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/icheck-bootstrap/icheck-bootstrap.min.css"; ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/jqvmap/jqvmap.min.css"; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL."dist/css/adminlte.min.css"; ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/overlayScrollbars/css/OverlayScrollbars.min.css"; ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/daterangepicker/daterangepicker.css"; ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= BASEURL."plugins/summernote/summernote-bs4.min.css"; ?>">
  <link rel="icon" href="<?= BASEURL."dist/img/favicon.png"?>" type="image/gif">
  <style type="text/css">
      label.error {
          color:red;
          font-family: Andale Mono, monospace;
      }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= BASEURL."dist/img/logo.jpg"; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= BASEURL; ?>" class="d-block">SOLUTORIA</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= site_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i><p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                CRUD
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">4</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('crud/create') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><b>C</b>reate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('crud/read') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><b>R</b>ead</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('crud/update') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><b>U</b>pdate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('crud/delete') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><b>D</b>elete</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $this->renderSection('content'); ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://www.linkedin.com/in/alex-oyarz%C3%BAn-figueroa/">Alex Oyarzun</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?= $this->renderSection('scripts'); ?>

</body>
</html>