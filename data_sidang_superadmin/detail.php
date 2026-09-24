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
                            <h3 class="card-title">Detail Kelas Matkul</h3>
                        </div>
                        <div class="card border-0 shadow-none bg-transparent">
                            <div class="card-body">
                                <?php
                                $id_sidang = $_GET['id_sidang'];
                                $cek_query_detail = mysqli_query($db, "SELECT s.*, a.tahun, a.semester, j.nama_jurusan, 
                                d1.nik AS nik_pm1, d1.nama AS nama_pm1, d2.nik AS nik_pm2, d2.nama AS nama_pm2,
                                d3.nik AS nik_pg1, d3.nama AS nama_pg1, d4.nik AS nik_pg2, d4.nama AS nama_pg2,
                                m.nim, m.nama AS nama_mhs, r.nama_ruangan, r.kode_ruangan 
                                FROM tbl_sidang s 
                                LEFT JOIN tbl_akademik a ON s.kode_akd = a.kode_akd 
                                LEFT JOIN tbl_jurusan j ON s.kode_jurusan = j.kode_jurusan 
                                LEFT JOIN tbl_dosen d1 ON s.nik_pembimbing_1 = d1.nik
                                LEFT JOIN tbl_dosen d2 ON s.nik_pembimbing_2 = d2.nik
                                LEFT JOIN tbl_dosen d3 ON s.nik_penguji_1 = d3.nik
                                LEFT JOIN tbl_dosen d4 ON s.nik_penguji_2 = d4.nik
                                LEFT JOIN tbl_mahasiswa m ON s.nim = m.nim 
                                LEFT JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan WHERE id = '$id_sidang'") or die(mysqli_error($db));
                                $data_sidang = mysqli_fetch_array($cek_query_detail);
                                $tahun = $data_sidang['tahun'];
                                $semester = $data_sidang['semester'];
                                $nama_ruangan = $data_sidang['nama_ruangan'];
                                $jurusan = $data_sidang['nama_jurusan'];
                                $jam_mulai = $data_sidang['jam_mulai'];
                                $jam_selesai = $data_sidang['jam_selesai'];
                                $tanggal = $data_sidang['tgl'];
                                $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
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
                                        <td>Nama Ruangan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $nama_ruangan; ?></td>
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
                                            <td width="30%">Tanggal</td>
                                            <td width="5%">:</td>
                                            <td class="font-weight-bold"><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Jam</td>
                                            <td width="5%">:</td>
                                            <td class="font-weight-bold"><?= date_format(date_create($jam_mulai), 'H:i'); ?>-<?= date_format(date_create($jam_selesai), 'H:i'); ?></td>
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
                            <a href="index.php" class="btn btn-sm btn-danger mb-3"><i class="fas fa-arrow-left"></i>Kembali</a>
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