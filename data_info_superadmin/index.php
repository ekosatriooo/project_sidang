<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'S') {
  echo '<script>window.location.href="../logout.php"</script>';
}else {
$halaman = "data_info";
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
                        <span class="badge badge-warning navbar-badge"></span>
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
                        </div>
                </li>
            </ul>
        </nav>

        <!-- /.navbar -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="../asset_adminlte/dist/img/LogoUniv.png" alt="LogoUniv" height="70" width="70">
        </div>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-maroon elevation-4">
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
                        <div class="card-header bg-teal">
                            <h3 class="card-title">Data Info Mahasiswa PKL</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fas fa-plus"></i>Tambah Data
                            </button>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-import">
                                <i class="fas fa-file-excel"></i>Import Data
                            </button>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Jurusan</th>
                                        <th>Pembimbing</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT i.*,
                                    dp.nama AS nama_pembimbing,
                                    m.nim, m.nama AS nama_mhs 
                                    FROM tbl_info i 
                                    LEFT JOIN tbl_dosen dp ON i.nik_pembimbing = dp.nik
                                    LEFT JOIN tbl_mahasiswa m ON i.nim = m.nim") or die(mysqli_error($db));
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $id_info = $data['id'];
                                            $nim = $data['nim'];
                                            $nama_mahasiswa = $data['nama_mhs'];
                                            $nik_dosen_pembimbing = $data['nik_pembimbing'];
                                            $jurusan = $data['jurusan'];
                                            $nama_dosen_pembimbing = $data['nama_pembimbing'];
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $nim; ?> - <?= $nama_mahasiswa ?></td>
                                                <td><?= $jurusan ?></td>
                                                <td><?= $nik_dosen_pembimbing; ?> - <?= $nama_dosen_pembimbing ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                                                        data-id_info="<?= $id_info; ?>"
                                                        data-mahasiswa="<?= $nim; ?>"
                                                        data-jurusan="<?= $data['jurusan']; ?>"
                                                        data-pembimbing="<?= $data['nik_pembimbing']; ?>"
                                                        >
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="hapus.php?id_info=<?= $id_info; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
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
                    <h4 class="modal-title">Tambah Data Sidang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="proses_tambah.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Mahasiswa</label>
                            <select class="form-control" name="mahasiswa" required>
                                <option value="">-- Pilih Mahasiswa--</option>
                                <?php
                                $query_mahasiswa = mysqli_query($db, "SELECT nim, nama FROM tbl_mahasiswa")or die(mysqli_error($db));
                                $rv_mahasiswa = mysqli_num_rows($query_mahasiswa);
                                if ($rv_mahasiswa > 0) {
                                    while($data_mahasiswa = mysqli_fetch_array($query_mahasiswa)) {
                                        ?>
                                        <option value="<?= $data_mahasiswa['nim'] ?>"><?= $data_mahasiswa['nim'] ?> - <?= $data_mahasiswa['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukkan Jurusan" name="jurusan" required>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing</label>
                            <select class="form-control" name="pembimbing" required>
                                <option value="">-- Pilih Dosen Pembimbing--</option>
                                <?php
                                $query_pembimbing = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing = mysqli_num_rows($query_pembimbing);
                                if ($rv_pembimbing > 0) {
                                    while($data_pembimbing = mysqli_fetch_array($query_pembimbing)) {
                                        ?>
                                        <option value="<?= $data_pembimbing['nik'] ?>"><?= $data_pembimbing['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
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
                    <h4 class="modal-title">Edit Data Kelas Matkul</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="proses_edit.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_info" hidden>
                        <div class="form-group">
                            <label>Mahasiswa</label>
                            <select class="form-control" name="mahasiswa" required>
                                <option value="">-- Pilih Mahasiswa--</option>
                                <?php
                                $query_mahasiswa = mysqli_query($db, "SELECT nim, nama FROM tbl_mahasiswa")or die(mysqli_error($db));
                                $rv_mahasiswa = mysqli_num_rows($query_mahasiswa);
                                if ($rv_mahasiswa > 0) {
                                    while($data_mahasiswa = mysqli_fetch_array($query_mahasiswa)) {
                                        ?>
                                        <option value="<?= $data_mahasiswa['nim'] ?>"><?= $data_mahasiswa['nim'] ?> - <?= $data_mahasiswa['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jurusan</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukkan Jurusan" name="jurusan" required>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing</label>
                            <select class="form-control" name="pembimbing" required>
                                <option value="">-- Pilih Dosen Pembimbing--</option>
                                <?php
                                $query_pembimbing = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing = mysqli_num_rows($query_pembimbing);
                                if ($rv_pembimbing > 0) {
                                    while($data_pembimbing = mysqli_fetch_array($query_pembimbing)) {
                                        ?>
                                        <option value="<?= $data_pembimbing['nik'] ?>"><?= $data_pembimbing['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
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


    <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data Kelas Matkul</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_import.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <label>Download Template</label>
            <a href="template/template_kelas_matkul.xls" class="btn btn-info btn-sm">Download</a>
            <div class="form-group">
              <label for="exampleInputEmail1">Upload File</label>
              <input type="file" class="form-control" id="nama" placeholder="Masukkan Nama" name="file_kelas_matkul" required>
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
            var id_info = $(e.relatedTarget).data('id_info');
            var mahasiswa = $(e.relatedTarget).data('mahasiswa');
            var jurusan = $(e.relatedTarget).data('jurusan');
            var pembimbing = $(e.relatedTarget).data('pembimbing');


            var modal = $(e.currentTarget);
            modal.find('input[name="id_info"]').val(id_info);
            modal.find('select[name="mahasiswa"]').val(mahasiswa);
            modal.find('select[name="pembimbing"]').val(pembimbing);
            modal.find('input[name="jurusan"]').val(jurusan);
        });
    </script>
</body>
</html>
<?php
} 
?>