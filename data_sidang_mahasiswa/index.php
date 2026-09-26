<?php
require_once '../database/koneksi.php';
$halaman = "sidang";
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
                include '../sidebar_mahasiswa.php';
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
                            <h3 class="card-title">Data Jadwal Sidang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Jurusan</th>
                                        <th>Mahasiswa</th>
                                        <th>Pembimbing</th>
                                        <th>Penguji</th>
                                        <th>Ruang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT s.*, j.nama_jurusan,
                                    d1.nama AS nama_pm1, d2.nama AS nama_pg1,
                                    m.nim, m.nama AS nama_mhs, r.nama_ruangan, r.kode_ruangan 
                                    FROM tbl_sidang s 
                                    LEFT JOIN tbl_jurusan j ON s.kode_jurusan = j.kode_jurusan 
                                    LEFT JOIN tbl_dosen d1 ON s.nik_pembimbing_1 = d1.nik
                                    LEFT JOIN tbl_dosen d2 ON s.nik_penguji_1 = d2.nik
                                    LEFT JOIN tbl_mahasiswa m ON s.nim = m.nim 
                                    LEFT JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan") or die(mysqli_error($db));
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $id_sidang = $data['id'];
                                            $nim = $data['nim'];
                                            $nama_mahasiswa = $data['nama_mhs'];
                                            $nik_dosen_pembimbing = $data['nik_pembimbing_1']; 
                                            $nik_dosen_penguji = $data['nik_penguji_1']; 
                                            $nama_dosen_pembimbing = $data['nama_pm1'];
                                            $nama_dosen_penguji = $data['nama_pg1'];
                                            $jurusan = $data['nama_jurusan'];
                                            $nama_ruangan = $data['nama_ruangan'];
                                            $jam_mulai = $data['jam_mulai'];
                                            $jam_selesai = $data['jam_selesai'];
                                            $tanggal = $data['tgl'];
                                            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td>
                                                <td><?= date_format(date_create($jam_mulai), 'H:i'); ?>-<?= date_format(date_create($jam_selesai), 'H:i'); ?></td>
                                                <td><?= $jurusan; ?></td>
                                                <td><?= $nim; ?> - <?= $nama_mahasiswa ?></td>
                                                <td><?= $nik_dosen_pembimbing; ?> - <?= $nama_dosen_pembimbing ?></td>
                                                <td><?= $nik_dosen_penguji; ?> - <?= $nama_dosen_penguji ?></td>
                                                <td><?= $nama_ruangan; ?></td>
                                                <td>
                                                    <a href="presensi.php?id_sidang=<?= $id_sidang ?>" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-sign-in-alt mr-1"></i> Ikuti Sidang
                                                    </a>
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

    <?php
    include '../script.php';
    ?>
</body>

</html>