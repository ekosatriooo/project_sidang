<?php
require_once '../database/koneksi.php';
$halaman = "data_kelas_matkul";
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
                include '../sidebar_dosen.php';
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
                            <h3 class="card-title">Detail Kelas Matkul</h3>
                        </div>
                        <div class="card border-0 shadow-none bg-transparent">
                            <div class="card-body">
                                <?php
                                $id = $_GET['id'];
                                $cek_query_detail = mysqli_query($db, "SELECT km.id, km.kode_akd, km.kode_jurusan, km.nik, km.kode_matkul, km.nama_kelas, a.tahun, a.semester, j.nama_jurusan, m.nama_matkul, d.nik, d.nama FROM tbl_kelas_matkul km LEFT JOIN tbl_akademik a ON km.kode_akd = a.kode_akd LEFT JOIN tbl_jurusan j ON km.kode_jurusan = j.kode_jurusan LEFT JOIN tbl_matkul m ON km.kode_matkul = m.kode_matkul LEFT JOIN tbl_dosen d ON km.nik = d.nik WHERE km.id = '$id'") or die(mysqli_error($db));
                                $data_kelas = mysqli_fetch_array($cek_query_detail);
                                $matkul = $data_kelas['nama_matkul'];
                                $kode_makul = $data_kelas['kode_matkul'];
                                $nik = $data_kelas['nik'];
                                $nama_dosen = $data_kelas['nama'];
                                $jurusan = $data_kelas['nama_jurusan'];
                                $tahun = $data_kelas['tahun'];
                                $semester = $data_kelas['semester'];
                                $nama_kelas = $data_kelas['nama_kelas'];
                                ?>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm m-0">
                                    <tr>
                                        <td width="30%">Akademik</td>
                                        <td width="5%">:</td>
                                        <td class="font-weight-bold"><?= $tahun; ?>-<?= $semester == 'GL' ? 'Ganjil' : 'Genap'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kelas</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $nama_kelas; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $jurusan; ?></td>
                                    </tr>
                                </table>
                                    </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless table-sm m-0">
                                        <tr>
                                            <td width="30%">Mata Kuliah</td>
                                            <td width="5%">:</td>
                                            <td class="font-weight-bold"><?= $matkul; ?> - <?= $kode_makul; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Dosen</td>
                                            <td>:</td>
                                            <td class="font-weight-bold"><?= $nama_dosen; ?> - <?= $nik; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="index.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT p.id AS id_peserta, p.id_kelas, p.nim, m.nim, m.nama, km.id FROM tbl_peserta p LEFT JOIN tbl_mahasiswa m ON p.nim = m.nim LEFT JOIN tbl_kelas_matkul km ON p.id_kelas = km.id WHERE p.id_kelas = '$id'") or die(mysqli_error($db));
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $id_peserta = $data['id_peserta'];
                                            $nama = $data['nama'];
                                            $nim = $data['nim'];
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $nim; ?>-<?= $nama ?> </td>
                                                <td>
                                                    <center>
                                                        <a href="hapus_peserta.php?id_peserta=<?= $id_peserta ?>&id_kelas=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    </center>
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
                    <h4 class="modal-title">Tambah Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="proses_tambah_peserta.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_kelas" value="<?= $id ?>">
                            <label>Mahasiswa</label>
                            <select class="form-control" name="nim" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                <?php
                                $query_mhs = mysqli_query($db, "SELECT nim, nama FROM tbl_mahasiswa");
                                $rv = mysqli_num_rows($query_mhs);
                                if ($rv > 0) {
                                    while($data_mhs = mysqli_fetch_array($query_mhs)) {
                                        ?>
                                        <option value="<?= $data_mhs['nim'] ?>"><?= $data_mhs['nim'] ?> - <?= $data_mhs['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btn-tambah-peserta">Simpan</button>
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
          <h4 class="modal-title">Import Data Peserta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_import_peserta.php" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <center>
                        <label>Download Template :</label>
                        <a href="template/template_peserta.xls" class="btn btn-info btn-sm">Download</a>
                    </center>
                </div>
                <div class="col-6">
                    <center>
                        <label>Download Data Mahasiswa :</label>
                        <a href="../data_mahasiswa_superadmin/export_excel.php" class="btn btn-info btn-sm">Download</a>
                    </center>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" value="<?= $id ?>" name="id_kelas">
              <label for="exampleInputEmail1">Upload File</label>
              <input type="file" class="form-control" id="nama" placeholder="Masukkan Nama" name="file_peserta" required>
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

</body>

</html>