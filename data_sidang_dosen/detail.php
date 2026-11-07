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

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-maroon elevation-4">
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
                        <div class="card-header bg-teal">
                            <h3 class="card-title">Detail Jadwal Sidang</h3>
                        </div>
                        <div class="card border-0 shadow-none bg-transparent">
                            <div class="card-body">
                                <?php
                                $id_sidang = $_GET['id_sidang'];
                                $cek_query_detail = mysqli_query($db, "SELECT s.*, 
                                dp.nama AS nama_pembimbing, dg.nama AS nama_penguji,
                                m.nim, m.nama AS nama_mhs, r.nama_ruangan, r.kode_ruangan 
                                FROM tbl_sidang s 
                                LEFT JOIN tbl_dosen dp ON s.nik_pembimbing = dp.nik
                                LEFT JOIN tbl_dosen dg ON s.nik_penguji = dg.nik
                                LEFT JOIN tbl_mahasiswa m ON s.nim = m.nim 
                                LEFT JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan WHERE id = '$id_sidang'") or die(mysqli_error($db));
                                $data_sidang = mysqli_fetch_array($cek_query_detail);
                                $nama_ruangan = $data_sidang['nama_ruangan'];
                                $nim = $data_sidang['nim'];
                                $nama_mahasiswa = $data_sidang['nama_mhs'];
                                $nik_dosen_pembimbing = $data_sidang['nik_pembimbing'];
                                $nama_dosen_pembimbing = $data_sidang['nama_pembimbing'];
                                $nik_dosen_penguji = $data_sidang['nik_penguji'];
                                $nama_dosen_penguji = $data_sidang['nama_penguji'];
                                $judul_sidang = $data_sidang['judul'];
                                $jam_mulai = $data_sidang['jam_mulai'];
                                $jam_selesai = $data_sidang['jam_selesai'];
                                $tanggal = $data_sidang['tgl'];
                                $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                                ?>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm m-0">
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $nama_mahasiswa; ?>-<?= $nim ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ruang</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $nama_ruangan; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $judul_sidang; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dosen Pembimbing</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $nama_dosen_pembimbing; ?> - <?= $nik_dosen_pembimbing; ?></td>
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
                                            <td>Dosen Penguji</td>
                                            <td>:</td>
                                            <td class="font-weight-bold"><?= $nama_dosen_penguji; ?> - <?= $nik_dosen_penguji; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="index.php" class="btn btn-sm btn-danger mb-3"><i class="fas fa-arrow-left"></i>Kembali</a>
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