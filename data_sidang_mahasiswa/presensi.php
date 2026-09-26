<?php
require_once '../database/koneksi.php';
$halaman = "sidang";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presensi Sidang | Mahasiswa</title>

    <?php
    include '../library.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
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

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-maroon elevation-4">
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">Sistem Manajemen</span>
            </a>

            <div class="sidebar">
                <?php
                // MENGGUNAKAN SIDEBAR MAHASISWA
                include '../sidebar_mahasiswa.php';
                ?>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Informasi & Presensi Sidang</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $id_sidang = $_GET['id_sidang'];
                            $nama_login = $_SESSION['nama']; 

                            $cari_nim = mysqli_query($db, "SELECT nim FROM tbl_mahasiswa WHERE nama = '$nama_login'");
                            $data_nim = mysqli_fetch_array($cari_nim);

                            $nim_login = isset($data_nim['nim']) ? $data_nim['nim'] : '';

                            $cek_query_detail = mysqli_query($db, "SELECT s.*, j.nama_jurusan, 
                            d1.nama AS nama_pm1, d2.nama AS nama_pm2,
                            d3.nama AS nama_pg1, d4.nama AS nama_pg2,
                            m.nim, m.nama AS nama_mhs, m.kelamin AS kelamin_mhs, m.img AS img_mhs, r.nama_ruangan 
                            FROM tbl_sidang s 
                            LEFT JOIN tbl_jurusan j ON s.kode_jurusan = j.kode_jurusan 
                            LEFT JOIN tbl_dosen d1 ON s.nik_pembimbing_1 = d1.nik
                            LEFT JOIN tbl_dosen d2 ON s.nik_pembimbing_2 = d2.nik
                            LEFT JOIN tbl_dosen d3 ON s.nik_penguji_1 = d3.nik
                            LEFT JOIN tbl_dosen d4 ON s.nik_penguji_2 = d4.nik
                            LEFT JOIN tbl_mahasiswa m ON s.nim = m.nim 
                            LEFT JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan WHERE id = '$id_sidang'") or die(mysqli_error($db));
                            $data_sidang = mysqli_fetch_array($cek_query_detail);
                            
                            $nama_ruangan = $data_sidang['nama_ruangan'];
                            $jurusan = $data_sidang['nama_jurusan'];
                            $nim_sidang = $data_sidang['nim'];
                            $nama_mahasiswa_sidang = $data_sidang['nama_mhs'];
                            $judul_sidang = $data_sidang['judul'];
                            $jam_mulai = $data_sidang['jam_mulai'];
                            $jam_selesai = $data_sidang['jam_selesai'];
                            $tanggal = $data_sidang['tgl'];
                            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                            $status_sidang = $data_sidang['status'];

                            // Ambil status presensi mahasiswa yang sedang login
                            $cek_presensi = mysqli_query($db, "SELECT status_kehadiran FROM tbl_presensi WHERE id_sidang = '$id_sidang' AND nim = '$nim_login'");
                            $data_presensi = mysqli_fetch_array($cek_presensi);
                            $status_kehadiran_saya = isset($data_presensi['status_kehadiran']) ? $data_presensi['status_kehadiran'] : 'belum_absen';
                            ?>

                            <div class="row"> 
                                <!-- BAGIAN 1: DETAIL SIDANG -->
                                <div class="col-md-6 mb-4">
                                    <h5>Detail Sidang</h5>
                                    <table class="table table-borderless table-sm m-0">
                                        <tr>
                                            <td width="30%">Judul</td>
                                            <td width="5%">:</td>
                                            <td class="font-weight-bold"><?= $judul_sidang ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mahasiswa</td>
                                            <td>:</td>
                                            <td class="font-weight-bold"><?= $nama_mahasiswa_sidang; ?> (<?= $nim_sidang ?>)</td>
                                        </tr>
                                        <tr>
                                            <td>Ruangan</td>
                                            <td>:</td>
                                            <td class="font-weight-bold"><?= $nama_ruangan; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Waktu</td>
                                            <td>:</td>
                                            <td class="font-weight-bold">
                                                <?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?> <br>
                                                (<?= date_format(date_create($jam_mulai), 'H:i'); ?> - <?= date_format(date_create($jam_selesai), 'H:i'); ?>)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status Sidang</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($status_sidang == 'dijadwalkan') { ?>
                                                    <span class="badge badge-secondary">Dijadwalkan</span>
                                                <?php } elseif ($status_sidang == 'berlangsung') { ?>
                                                    <span class="badge badge-warning">Berlangsung</span>
                                                <?php } elseif ($status_sidang == 'selesai') { ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-light">Belum Diset</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- BAGIAN 2: PANEL PRESENSI MAHASISWA -->
                                <div class="col-md-6 text-center border-left">
                                    <h5 class="mb-3">Status Kehadiran Anda</h5>
                                    
                                    <?php if ($status_kehadiran_saya == 'hadir') { ?>
                                        <!-- Tampilan jika sudah absen -->
                                        <div class="alert alert-success d-inline-block px-4 py-3">
                                            <h4 class="m-0"><i class="fas fa-check-circle mr-2"></i> HADIR</h4>
                                            <p class="m-0 mt-1" style="font-size: 14px;">Kehadiran Anda telah terekam di sistem.</p>
                                        </div>
                                        
                                    <?php } else { ?>
                                        <!-- Tampilan jika belum absen -->
                                        <div class="alert alert-warning d-inline-block px-4 py-3 mb-4">
                                            <h4 class="m-0"><i class="fas fa-exclamation-triangle mr-2"></i> BELUM ABSEN</h4>
                                        </div>
                                        
                                        <!-- Tempat/Tombol untuk Scan QR -->
                                        <?php if ($status_sidang == 'berlangsung') { ?>
                                            <p class="text-muted">Arahkan kamera perangkat Anda ke QR Code yang ditampilkan oleh Dosen/Admin di depan ruangan.</p>
                                            
                                            <!-- Tombol simulasi scanner (Nantinya diganti script HTML5-QRCode) -->
                                            <button class="btn btn-lg btn-info" onclick="alert('Fitur Kamera Scanner akan terintegrasi di sini.')">
                                                <i class="fas fa-camera mr-2"></i> Buka Kamera Scanner
                                            </button>
                                        <?php } else { ?>
                                            <p class="text-danger font-italic mt-2">Absensi hanya dapat dilakukan saat status sidang <b>Berlangsung</b>.</p>
                                        <?php } ?>
                                        
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="index.php" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <?php include '../script.php'; ?>
</body>
</html>