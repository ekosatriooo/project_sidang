<?php
require_once '../database/koneksi.php';
$halaman = "data_dosen";
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

    <!-- Preloader -->
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
              <h3 class="card-title">Data Dosen</h3>
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
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Kontak</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query_ambil_data = mysqli_query($db, "SELECT * FROM tbl_dosen") or die(mysqli_error($db));
                  $rv = mysqli_num_rows($query_ambil_data);
                  if ($rv > 0) {
                    $no = 1;
                    while ($data = mysqli_fetch_array($query_ambil_data)) {
                      $nik = $data['nik'];
                      $nama = $data['nama'];
                      $kontak = $data['kontak'];
                      $email = $data['email'];
                      $kelamin = $data['kelamin'];
                      $img = $data['img'];
                  ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $nik; ?></td>
                        <td><?= $kontak; ?></td>
                        <td><?= $email ?></td>
                        <td><?= ($kelamin == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td>
                          <?php
                        if ($kelamin == 'L') {
                          ?>
                          <button type="button" data-toggle="modal" data-target="#modal-foto" class="btn btn-default"
                          data-nik="<?= $nik; ?>">
                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/dsn-lk.jpg' ?>"  alt="foto mhs laki-laki" style="width:70px">
                          </button>
                          <?php
                        }else {
                          ?>
                          <button type="button" data-toggle="modal" data-target="#modal-foto" class="btn btn-default"
                          data-nik="<?= $nik; ?>">
                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/dsn-perempuan.jpg' ?>" alt="foto mhs perempuan" style="width:70px">
                          </button>
                          <?php
                        }
                        ?>
                        </td>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                          data-nik="<?= $nik; ?>"
                          data-nama="<?= $nama; ?>"
                          data-kontak="<?= $kontak; ?>"
                          data-email="<?= $email; ?>"
                          data-kelamin="<?= $kelamin; ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          <a href="hapus.php?nik=<?= $nik; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                  <?php
                    }
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
          <h4 class="modal-title">Tambah Data Dosen</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_tambah.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nik</label>
              <input type="number" class="form-control" id="nik" placeholder="Masukkan Nik" name="nik" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Kontak</label>
              <input type="text" class="form-control" id="kontak" placeholder="Masukkan Kontak" name="kontak" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Masukkan Email" name="email" required>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
          <h4 class="modal-title">Edit Data Dosen</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_edit.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nik</label>
              <input type="number" class="form-control" id="nik" placeholder="Masukkan Nik" name="nik" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Kontak</label>
              <input type="text" class="form-control" id="kontak" placeholder="Masukkan Kontak" name="kontak" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Masukkan Email" name="email" required>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
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

  <div class="modal fade" id="modal-foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Foto Mahasiswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_edit_foto.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload Foto</label>
              <input type="hidden" name="nik" hidden>
              <input type="file" class="form-control" accept="image/*" name="foto" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="btn-edit-foto">Simpan</button>
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
          <h4 class="modal-title">Import Data Dosen</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_import.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <label>Download Template</label>
            <a href="template/template_dosen.xls" class="btn btn-info btn-sm">Download</a>
            <div class="form-group">
              <label for="exampleInputEmail1">Upload File</label>
              <input type="file" class="form-control" id="nama" placeholder="Masukkan Nama" name="file_dosen" required>
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
  $('#modal-edit').on('show.bs.modal', function(e){
  var nik = $(e.relatedTarget).data('nik');
  var nama = $(e.relatedTarget).data('nama');
  var kontak = $(e.relatedTarget).data('kontak');
  var email = $(e.relatedTarget).data('email');
  var kelamin = $(e.relatedTarget).data('kelamin');

  $(e.currentTarget).find('input[name="nik"]').val(nik);
  $(e.currentTarget).find('input[name="nama"]').val(nama);
  $(e.currentTarget).find('input[name="kontak"]').val(kontak);
  $(e.currentTarget).find('input[name="email"]').val(email);
  $(e.currentTarget).find('select[name="kelamin"]').val(kelamin);
  })

  $('#modal-foto').on('show.bs.modal', function(e){
    var nik = $(e.relatedTarget).data('nik');

    $(e.currentTarget).find('input[name="nik"]').val(nik);
  })
</script>
</body>

</html>