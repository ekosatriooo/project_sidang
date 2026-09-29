<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'M') {
    echo '<script>window.location.href="../logout.php"</script>';
    exit;
} else {
    $halaman = "riwayat_nonton"; 
    $user = $_SESSION['user'];
    $query_jumlah = mysqli_query($db, "SELECT COUNT(id) AS total_hadir FROM tbl_presensi WHERE nim = '$user' AND status_kehadiran = 'hadir'") or die(mysqli_error($db));
    $data_jumlah = mysqli_fetch_assoc($query_jumlah);
    $total_hadir = $data_jumlah['total_hadir'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen | Riwayat Menonton</title>

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
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Hallo, <?= $_SESSION['nama']; ?> <i class="far fa-user"></i>
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
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light">Sistem Manajemen</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <?php
                include '../sidebar_mahasiswa.php';
                ?>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card mt-3">
                        <div class="card-header bg-navy">
                            <h3 class="card-title">Riwayat Menonton</h3>
                            <div class="card-tools">
                                <span class="badge badge-success" style="font-size: 14px;">
                                    <i class="fas fa-check-circle mr-1"></i> Total Menonton: <?= $total_hadir; ?> Kali
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="export_pdf.php" class="btn btn-sm btn-danger mb-3"><i class="fas fa-file-pdf mr-1"></i>Export Pdf</a>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Jenis Sidang</th>
                                        <th>Mahasiswa Penyaji</th>
                                        <th>Judul</th>
                                        <th>Ruang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE nim = '$user' ORDER BY tgl DESC") or die(mysqli_error($db));
                                    
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                                    
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $tanggal = $data['tgl'];
                                            if ($data['status_kehadiran'] == 'hadir') {
                                                $badge = '<span class="badge badge-success">Hadir</span>';
                                            } elseif ($data['status_kehadiran'] == 'tidak_hadir') {
                                                $badge = '<span class="badge badge-danger">Tidak Hadir</span>';
                                            } else {
                                                $badge = '<span class="badge badge-warning">Menunggu</span>';
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td>
                                                <td><?= date_format(date_create($data['jam_mulai']), 'H:i'); ?> - <?= date_format(date_create($data['jam_selesai']), 'H:i'); ?></td>
                                                <td><?= $data['jenis_sidang']; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['judul']; ?></td>
                                                <td><?= $data['nama_ruangan']; ?></td>
                                                <td><?= $badge; ?></td>
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
            <strong>Copyright &copy; 2026 <a href="#">Sistem Informasi Akademik</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
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