<?php
require_once '../database/koneksi.php';
$halaman = "data_ruangan";
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
            <span class="badge badge-warning navbar-badge">15</span>
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

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../asset_adminlte/dist/img/LogoUniv.png" alt="LogoUniv" height="70" width="70">
  </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Sistem Manajemen</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <?php
        include '../sidebar_superadmin.php';
        ?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Ruangan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i>Tambah Data
              </button>
              <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modal-import">
                <i class="fas fa-file-excel"></i>Import Data
              </button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Gedung</th>
                    <th>Kuota</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query_jurusan = mysqli_query($db, "SELECT * FROM tbl_ruangan") or die(mysqli_error($db));
                  $rv = mysqli_num_rows($query_jurusan);
                  $no = 1;
                  while ($data = mysqli_fetch_array($query_jurusan)) {
                    $kode_ruangan = $data['kode_ruangan'];
                    $nama_ruangan = $data['nama_ruangan'];
                    $gedung = $data['gedung'];
                    $kuota = $data['kuota'];
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $kode_ruangan; ?></td>
                      <td><?= $nama_ruangan; ?></td>
                      <td><?= $gedung; ?></td>
                      <td><?= $kuota; ?></td>
                      <td><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                          data-kode_ruangan="<?= $kode_ruangan; ?>"
                          data-nama_ruangan="<?= $nama_ruangan ?>"
                          data-gedung="<?= $gedung ?>"
                          data-kuota="<?= $kuota ?>"
                          >
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="hapus.php?kode_ruangan=<?= $kode_ruangan; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
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

  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Ruangan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_tambah.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Kode Ruangan</label>
              <input type="text" class="form-control" id="kode_ruangan" placeholder="Masukkan Kode Ruangan" name="kode_ruangan" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Ruangan</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Ruangan" name="nama_ruangan" required>
            </div>
            <div class="form-group">
              <label>Gedung</label>
                <select class="form-control" name="gedung" required>
                  <option value="">-- Pilih Gedung --</option>
                  <option value="A">A</option>
                  <option value="D">D</option>
                </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Kuota</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Kuota" name="kuota" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="btn-tambah">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Ruangan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_edit.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Kode Ruangan</label>
              <input type="text" class="form-control" id="kode_ruangan" placeholder="Masukkan Kode Ruangan" name="kode_ruangan" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Ruangan</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Ruangan" name="nama_ruangan" required>
            </div>
            <div class="form-group">
              <label>Gedung</label>
                <select class="form-control" name="gedung" required>
                  <option value="">-- Pilih Gedung --</option>
                  <option value="A">A</option>
                  <option value="D">D</option>
                </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Kuota</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Kuota" name="kuota" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="btn-edit">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data Jurusan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_import.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <label>Download Template</label>
            <a href="template/template_jurusan.xls" class="btn btn-info btn-sm">Download</a>
            <div class="form-group">
              <label for="exampleInputEmail1">Upload File</label>
              <input type="file" class="form-control" id="nama" placeholder="Masukkan Nama" name="file_jurusan" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="btn-import">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <?php
  include '../script.php';
  ?>

  <script>
    $('#modal-edit').on('show.bs.modal', function(e) {
      var kode_ruangan = $(e.relatedTarget).data('kode_ruangan');
      var nama_ruangan = $(e.relatedTarget).data('nama_ruangan');
      var gedung = $(e.relatedTarget).data('gedung');
      var kuota = $(e.relatedTarget).data('kuota');

      $(e.currentTarget).find('input[name="kode_ruangan"]').val(kode_ruangan);
      $(e.currentTarget).find('input[name="nama_ruangan"]').val(nama_ruangan);
      $(e.currentTarget).find('select[name="gedung"]').val(gedung);
      $(e.currentTarget).find('input[name="kuota"]').val(kuota);
    })
  </script>
</body>

</html>