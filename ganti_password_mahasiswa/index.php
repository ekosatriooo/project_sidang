<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'M') {
  echo '<script>window.location.href="../logout.php"</script>';
}else {
$halaman = "ganti_password";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 3</title>

<?php
include '../library.php';
?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          Hallo, <?= $_SESSION['nama']; ?> <i class="far fa-user"></i>
          <span class="badge badg
          e-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-book mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar Sistem
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Sistem Manajemen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <?php
      include '../sidebar_mahasiswa.php';
      ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <div class="card-header">
        <h3 class="card-title">Ganti Password</h3>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="proses_gantipw.php" method="post">
                <div class="card-body">
                    <?php
                    $username = $_SESSION['user'];
                    $nama = $_SESSION['nama'];
                     ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" value="<?= $username ?>" class="form-control" id="username" placeholder="Masukkan Nama" name="username" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" value="<?= $nama ?>" class="form-control" id="nama" placeholder="Nama" name="nama" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password Baru</label>
                    <input type="password" class="form-control" id="kontak" placeholder="Masukkan Password Baru" name="pwbaru" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="email" placeholder="Konfirmasi Password Baru" name="cpassword" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btn-ganti">Simpan</button>
                </div>
              </form>
            </div>
      <div class="container-fluid">
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php
include '../script.php'; 
?>
</body>
</html>
<?php
} 
?>;