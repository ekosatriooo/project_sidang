<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'D') {
  echo '<script>window.location.href="../logout.php"</script>';
}else {
$halaman = "sidang_dosen";
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
                            <h3 class="card-title">Data Jadwal Sidang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            $nik_login_dosen = $_SESSION['user'];
                            ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Akademik</th>
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
                                    $cek_query = mysqli_query($db, "SELECT * FROM tbl_sidang WHERE nik_penguji_1 = '$nik_login_dosen' OR nik_penguji_2 = '$nik_login_dosen' OR nik_pembimbing_1 = '$nik_login_dosen' OR nik_pembimbing_2 = '$nik_login_dosen'") or die(mysqli_error($db));
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $id_sidang = $data['id'];
                                            $tanggal = $data['tgl'];
                                            $jam_mulai = $data['jam_mulai'];
                                            $jam_selesai = $data['jam_selesai'];
                                            $kode_akd     = $data['kode_akd'];
                                            $kode_jurusan = $data['kode_jurusan'];
                                            $kode_ruangan = $data['kode_ruangan'];
                                            $nim_mahasiswa = $data['nim'];
                                            $nik_pembimbing = $data['nik_pembimbing_1'];
                                            $nik_penguji = $data['nik_penguji_1'];
                                            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

                                            $cek_query_akd = mysqli_query($db, "SELECT semester, tahun FROM tbl_akademik WHERE kode_akd = '$kode_akd'")or die(mysqli_error($db));
                                            $data_akd = mysqli_fetch_array($cek_query_akd);
                                            $semester = $data_akd['semester'];
                                            $tahun = $data_akd['tahun'];

                                            $cek_query_mhs = mysqli_query($db, "SELECT nama FROM tbl_mahasiswa WHERE nim = '$nim_mahasiswa'")or die(mysqli_error($db));
                                            $data_mhs = mysqli_fetch_array($cek_query_mhs);
                                            $nama_mhs = $data_mhs['nama'];

                                            $cek_query_jrsn = mysqli_query($db, "SELECT nama_jurusan FROM tbl_jurusan WHERE kode_jurusan = '$kode_jurusan'")or die(mysqli_error($db));
                                            $data_jrsn = mysqli_fetch_array($cek_query_jrsn);
                                            $nama_jrsn = $data_jrsn['nama_jurusan'];

                                            $cek_query_ruangan = mysqli_query($db, "SELECT nama_ruangan FROM tbl_ruangan WHERE kode_ruangan = '$kode_ruangan'")or die(mysqli_error($db));
                                            $data_ruangan = mysqli_fetch_array($cek_query_ruangan);
                                            $nama_ruangan = $data_ruangan['nama_ruangan'];

                                            $cek_query_dosen_pembimbing = mysqli_query($db, "SELECT nama FROM tbl_dosen WHERE nik = '$nik_pembimbing'")or die(mysqli_error($db));
                                            $data_pembimbing = mysqli_fetch_array($cek_query_dosen_pembimbing);
                                            $nama_pembimbing = $data_pembimbing['nama'];

                                            $cek_query_dosen_penguji = mysqli_query($db, "SELECT nama FROM tbl_dosen WHERE nik = '$nik_penguji'")or die(mysqli_error($db));
                                            $data_penguji = mysqli_fetch_array($cek_query_dosen_penguji);
                                            $nama_penguji = $data_penguji['nama'];
                                            
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td>
                                                <td><?= date_format(date_create($jam_mulai), 'H:i'); ?>-<?= date_format(date_create($jam_selesai), 'H:i'); ?></td>
                                                <td><?= $tahun; ?>-<?= $semester == 'GL' ? 'Ganjil' : 'Genap'; ?> </td>
                                                <td><?= $nama_jrsn; ?></td>
                                                <td><?= $nim_mahasiswa ?> - <?= $nama_mhs ?></td>
                                                <td><?= $nik_pembimbing ?> - <?= $nama_pembimbing ?></td>
                                                <td><?= $nik_penguji ?> - <?= $nama_penguji ?></td>
                                                <td><?= $nama_ruangan ?></td>
                                                <td>
                                                    <a href="detail.php?id_sidang=<?= $id_sidang; ?>" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                                    <a href="presensi.php?id_sidang=<?= $id_sidang ?>" class="btn btn-sm btn-primary"><i class="fas fa-qrcode"></i></a>
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
<?php
} 
?>