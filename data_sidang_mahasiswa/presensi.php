<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'M') {
  echo '<script>window.location.href="../logout.php"</script>';
}else {
$halaman = "sidang";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Presensi Sidang</title>

    <?php include '../library.php'; ?>
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
                        <a href="../logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar Sistem
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-maroon elevation-4">
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light">Sistem Manajemen</span>
            </a>
            <div class="sidebar">
                <?php include '../sidebar_mahasiswa.php'; ?>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid pt-3">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title text-white"><i class="fas fa-users mr-2"></i> Room Sidang Berlangsung</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $id_sidang = $_GET['id_sidang'];
                            $cek_query_detail = mysqli_query($db, "SELECT s.*, a.tahun, a.semester, j.nama_jurusan, 
                            d1.nama AS nama_pm1, d2.nama AS nama_pm2,
                            d3.nama AS nama_pg1, d4.nama AS nama_pg2,
                            m.nim, m.nama AS nama_mhs, m.kelamin AS kelamin_mhs, m.img AS img_mhs, r.nama_ruangan 
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
                            $nama_ruangan = $data_sidang['nama_ruangan'];
                            $jurusan = $data_sidang['nama_jurusan'];
                            $nim = $data_sidang['nim'];
                            $nama_mahasiswa = $data_sidang['nama_mhs'];
                            $judul_sidang = $data_sidang['judul'];
                            $tanggal = $data_sidang['tgl'];
                            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                            $kelamin = $data_sidang['kelamin_mhs'];
                            $img = $data_sidang['img_mhs'];
                            $status_sidang = $data_sidang['status'];
                            ?>

                            <div class="row border-bottom pb-4 mb-4"> 
                                <div class="col-md-3 text-center">
                                    <img src="<?= ($img != null) ? $img : ($kelamin == 'L' ? '../asset_adminlte/img/mhs-lk.jpg' : '../asset_adminlte/img/mhs-perempuan.jpg') ?>" class="img-circle elevation-2" alt="Foto Mahasiswa" style="width:150px; height:150px; object-fit:cover;">
                                    <div class="mt-3">
                                        <?php if ($status_sidang == 'berlangsung') { ?>
                                            <span class="badge badge-warning p-2"><i class="fas fa-spinner fa-spin mr-1"></i> Sedang Berlangsung</span>
                                        <?php } elseif ($status_sidang == 'selesai') { ?>
                                            <span class="badge badge-success p-2"><i class="fas fa-check-circle mr-1"></i> Sidang Selesai</span>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary p-2">Dijadwalkan</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                    
                                <div class="col-md-9">
                                    <table class="table table-borderless table-sm m-0">
                                        <tr><td width="20%">Judul</td><td width="3%">:</td><td class="font-weight-bold"><?= $judul_sidang ?></td></tr>
                                        <tr><td>Mahasiswa Penyaji</td><td>:</td><td class="font-weight-bold text-primary"><?= $nama_mahasiswa; ?> (<?= $nim; ?>)</td></tr>
                                        <tr><td>Ruangan</td><td>:</td><td class="font-weight-bold"><?= $nama_ruangan; ?></td></tr>
                                        <tr><td>Jurusan</td><td>:</td><td class="font-weight-bold"><?= $jurusan; ?></td></tr>
                                        <tr><td>Tanggal</td><td>:</td><td class="font-weight-bold"><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td></tr>
                                    </table>
                                </div>
                            </div>

                            <a href="index.php" class="btn btn-sm btn-danger mb-3"><i class="fas fa-arrow-left mr-1"></i> Keluar Room</a>
                            
                            <!-- Area Load Tabel AJAX -->
                            <div id="tabel_presensi">
                                <div class="text-center py-4 text-muted"><i class="fas fa-circle-notch fa-spin fa-2x"></i><br>Memuat daftar peserta...</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 AdminLTE.io.</strong> All rights reserved.
        </footer>
    </div>

    <?php include '../script.php'; ?>

    <script>
        function refresh_kehadiran() {
            $('#tabel_presensi').load('tabel_presensi_mahasiswa.php?id_sidang=<?= $id_sidang ?>');
            setTimeout(refresh_kehadiran, 5000);
        }
        refresh_kehadiran();
    </script>
</body>
</html>
<?php
} 
?>