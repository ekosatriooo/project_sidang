<?php
require_once '../database/koneksi.php';
$halaman = "data_sidang";
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
                            <h3 class="card-title">Data Jadwal Sidang</h3>
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
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Akademik</th>
                                        <th>Jurusan</th>
                                        <th>Mahasiswa</th>
                                        <th>Pembimbing</th>
                                        <th>Penguji</th>
                                        <th>Nama Ruangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT s.*, a.tahun, a.semester, j.nama_jurusan, 
                                    d1.nik AS nik_pm1, d1.nama AS nama_pm1, d2.nik AS nik_pg1, d2.nama AS nama_pg1,
                                    m.nim, m.nama AS nama_mhs, r.nama_ruangan, r.kode_ruangan 
                                    FROM tbl_sidang s 
                                    LEFT JOIN tbl_akademik a ON s.kode_akd = a.kode_akd 
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
                                            $nik_dosen_pembimbing = $data['nik_pm1']; 
                                            $nik_dosen_penguji = $data['nik_pg1']; 
                                            $nama_dosen_pembimbing = $data['nama_pm1'];
                                            $nama_dosen_penguji = $data['nama_pg1'];
                                            $jurusan = $data['nama_jurusan'];
                                            $tahun = $data['tahun'];
                                            $semester = $data['semester'];
                                            $nama_ruangan = $data['nama_ruangan'];
                                            $jam_mulai = $data['jam_mulai'];
                                            $jam_selesai = $data['jam_selesai'];
                                            $tanggal = $data['tgl'];
                                    ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= date_format(date_create($tanggal), 'l, d F Y') ?></td>
                                                <td><?= date_format(date_create($jam_mulai), 'H:i'); ?>-<?= date_format(date_create($jam_selesai), 'H:i'); ?></td>
                                                <td><?= $tahun; ?>-<?= $semester == 'GL' ? 'Ganjil' : 'Genap'; ?> </td>
                                                <td><?= $jurusan; ?></td>
                                                <td><?= $nim; ?> - <?= $nama_mahasiswa ?></td>
                                                <td><?= $nik_dosen_pembimbing; ?> - <?= $nama_dosen_pembimbing ?></td>
                                                <td><?= $nik_dosen_penguji; ?> - <?= $nama_dosen_penguji ?></td>
                                                <td><?= $nama_ruangan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                                                        data-id_sidang="<?= $id_sidang; ?>"
                                                        data-kode_akd="<?= $data['kode_akd']; ?>"
                                                        data-kode_jurusan="<?= $data['kode_jurusan']; ?>"
                                                        data-kode_ruangan="<?= $data['kode_ruangan'] ?>"
                                                        data-mahasiswa="<?= $nim; ?>"
                                                        data-pembimbing1="<?= $data['nik_pembimbing_1']; ?>"
                                                        data-pembimbing2="<?= $data['nik_pembimbing_2']; ?>"
                                                        data-penguji1="<?= $data['nik_penguji_1']; ?>"
                                                        data-penguji2="<?= $data['nik_penguji_2']; ?>"
                                                        data-tanggal="<?= $data['tgl']; ?>"
                                                        data-jam_mulai="<?= $jam_mulai; ?>"
                                                        data-jam_selesai="<?= $jam_selesai; ?>"
                                                        data-jenis_sidang="<?= $data['jenis_sidang']; ?>"
                                                        data-status="<?= $data['status']; ?>"
                                                        data-catatan="<?= $data['catatan']; ?>"
                                                        >
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="hapus.php?id_sidang=<?= $id_sidang; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    <a href="detail.php?id_sidang=<?= $id_sidang; ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
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
                            <label>Kode Akademik</label>
                            <select class="form-control" name="kode_akd" required>
                                <option value="">-- Pilih Akademik --</option>
                                <?php
                                $query_akd = mysqli_query($db, "SELECT kode_akd, tahun, semester FROM tbl_akademik")or die(mysqli_error($db));
                                $rv_akd = mysqli_num_rows($query_akd);
                                if ($rv_akd > 0) {
                                    while($data_akd = mysqli_fetch_array($query_akd)) {
                                        ?>
                                        <option value="<?= $data_akd['kode_akd'] ?>"><?= $data_akd['tahun'] ?> - <?= $data_akd['semester'] == 'GL' ? 'Ganjil' : 'Genap' ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="kode_jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <?php
                                $query_jrsn = mysqli_query($db, "SELECT kode_jurusan, nama_jurusan FROM tbl_jurusan")or die(mysqli_error($db));
                                $rv_jrsn = mysqli_num_rows($query_jrsn);
                                if ($rv_jrsn > 0) {
                                    while($data_jrsn = mysqli_fetch_array($query_jrsn)) {
                                        ?>
                                        <option value="<?= $data_jrsn['kode_jurusan'] ?>"><?= $data_jrsn['nama_jurusan'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <select class="form-control" name="kode_ruangan" required>
                                <option value="">-- Pilih Ruangan --</option>
                                <?php
                                $query_ruangan = mysqli_query($db, "SELECT kode_ruangan, nama_ruangan FROM tbl_ruangan")or die(mysqli_error($db));
                                $rv_ruangan = mysqli_num_rows($query_ruangan);
                                if ($rv_ruangan > 0) {
                                    while($data_ruangan = mysqli_fetch_array($query_ruangan)) {
                                        ?>
                                        <option value="<?= $data_ruangan['kode_ruangan'] ?>"><?= $data_ruangan['nama_ruangan'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
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
                                        <option value="<?= $data_mahasiswa['nim'] ?>"><?= $data_mahasiswa['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 1</label>
                            <select class="form-control" name="pembimbing1" required>
                                <option value="">-- Pilih Dosen Pembimbing 1--</option>
                                <?php
                                $query_pembimbing1 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing1 = mysqli_num_rows($query_pembimbing1);
                                if ($rv_pembimbing1 > 0) {
                                    while($data_pembimbing1 = mysqli_fetch_array($query_pembimbing1)) {
                                        ?>
                                        <option value="<?= $data_pembimbing1['nik'] ?>"><?= $data_pembimbing1['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 2</label>
                            <select class="form-control" name="pembimbing2" required>
                                <option value="">-- Pilih Dosen Pembimbing 2--</option>
                                <?php
                                $query_pembimbing2 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing2 = mysqli_num_rows($query_pembimbing2);
                                if ($rv_pembimbing2 > 0) {
                                    while($data_pembimbing2 = mysqli_fetch_array($query_pembimbing2)) {
                                        ?>
                                        <option value="<?= $data_pembimbing2['nik'] ?>"><?= $data_pembimbing2['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji 1</label>
                            <select class="form-control" name="penguji1" required>
                                <option value="">-- Pilih Dosen Penguji 1--</option>
                                <?php
                                $query_penguji1 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji1 = mysqli_num_rows($query_penguji1);
                                if ($rv_penguji1 > 0) {
                                    while($data_penguji1 = mysqli_fetch_array($query_penguji1)) {
                                        ?>
                                        <option value="<?= $data_penguji1['nik'] ?>"><?= $data_penguji1['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji 2</label>
                            <select class="form-control" name="penguji2" required>
                                <option value="">-- Pilih Dosen Penguji 2--</option>
                                <?php
                                $query_penguji2 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji2 = mysqli_num_rows($query_penguji2);
                                if ($rv_penguji2 > 0) {
                                    while($data_penguji2 = mysqli_fetch_array($query_penguji2)) {
                                        ?>
                                        <option value="<?= $data_penguji2['nik'] ?>"><?= $data_penguji2['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                        </div>
                        <div class="form-group">
                        <label>Jenis Sidang</label>
                        <select class="form-control" name="sidang" required>
                            <option value="">-- Pilih Jenis Sidang --</option>
                            <option value="PKL">PKL</option>
                            <option value="Sempro">Sempro</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="berlangsung">Berlangsung</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Catatan</label>
                            <input type="text" class="form-control" id="catatan" placeholder="Masukkan Catatan" name="catatan" required>
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
                        <input type="hidden" name="id_sidang" hidden>
                        <div class="form-group">
                            <label>Kode Akademik</label>
                            <select class="form-control" name="kode_akd" required>
                                <option value="">-- Pilih Akademik --</option>
                                <?php
                                $query_akd = mysqli_query($db, "SELECT kode_akd, tahun, semester FROM tbl_akademik")or die(mysqli_error($db));
                                $rv_akd = mysqli_num_rows($query_akd);
                                if ($rv_akd > 0) {
                                    while($data_akd = mysqli_fetch_array($query_akd)) {
                                        ?>
                                        <option value="<?= $data_akd['kode_akd'] ?>"><?= $data_akd['tahun'] ?> - <?= $data_akd['semester'] == 'GL' ? 'Ganjil' : 'Genap' ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="kode_jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <?php
                                $query_jrsn = mysqli_query($db, "SELECT kode_jurusan, nama_jurusan FROM tbl_jurusan")or die(mysqli_error($db));
                                $rv_jrsn = mysqli_num_rows($query_jrsn);
                                if ($rv_jrsn > 0) {
                                    while($data_jrsn = mysqli_fetch_array($query_jrsn)) {
                                        ?>
                                        <option value="<?= $data_jrsn['kode_jurusan'] ?>"><?= $data_jrsn['nama_jurusan'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <select class="form-control" name="kode_ruangan" required>
                                <option value="">-- Pilih Ruangan --</option>
                                <?php
                                $query_ruangan = mysqli_query($db, "SELECT kode_ruangan, nama_ruangan FROM tbl_ruangan")or die(mysqli_error($db));
                                $rv_ruangan = mysqli_num_rows($query_ruangan);
                                if ($rv_ruangan > 0) {
                                    while($data_ruangan = mysqli_fetch_array($query_ruangan)) {
                                        ?>
                                        <option value="<?= $data_ruangan['kode_ruangan'] ?>"><?= $data_ruangan['nama_ruangan'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
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
                                        <option value="<?= $data_mahasiswa['nim'] ?>"><?= $data_mahasiswa['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 1</label>
                            <select class="form-control" name="pembimbing1" required>
                                <option value="">-- Pilih Dosen Pembimbing 1--</option>
                                <?php
                                $query_pembimbing1 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing1 = mysqli_num_rows($query_pembimbing1);
                                if ($rv_pembimbing1 > 0) {
                                    while($data_pembimbing1 = mysqli_fetch_array($query_pembimbing1)) {
                                        ?>
                                        <option value="<?= $data_pembimbing1['nik'] ?>"><?= $data_pembimbing1['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Pembimbing 2</label>
                            <select class="form-control" name="pembimbing2" required>
                                <option value="">-- Pilih Dosen Pembimbing 2--</option>
                                <?php
                                $query_pembimbing2 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing2 = mysqli_num_rows($query_pembimbing2);
                                if ($rv_pembimbing2 > 0) {
                                    while($data_pembimbing2 = mysqli_fetch_array($query_pembimbing2)) {
                                        ?>
                                        <option value="<?= $data_pembimbing2['nik'] ?>"><?= $data_pembimbing2['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji 1</label>
                            <select class="form-control" name="penguji1" required>
                                <option value="">-- Pilih Dosen Penguji 1--</option>
                                <?php
                                $query_penguji1 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji1 = mysqli_num_rows($query_penguji1);
                                if ($rv_penguji1 > 0) {
                                    while($data_penguji1 = mysqli_fetch_array($query_penguji1)) {
                                        ?>
                                        <option value="<?= $data_penguji1['nik'] ?>"><?= $data_penguji1['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji 2</label>
                            <select class="form-control" name="penguji2" required>
                                <option value="">-- Pilih Dosen Penguji 2--</option>
                                <?php
                                $query_penguji2 = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji2 = mysqli_num_rows($query_penguji2);
                                if ($rv_penguji2 > 0) {
                                    while($data_penguji2 = mysqli_fetch_array($query_penguji2)) {
                                        ?>
                                        <option value="<?= $data_penguji2['nik'] ?>"><?= $data_penguji2['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" step="1" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" step="1" required>
                        </div>
                        <div class="form-group">
                        <label>Jenis Sidang</label>
                        <select class="form-control" name="sidang" required>
                            <option value="">-- Pilih Jenis Sidang --</option>
                            <option value="PKL">PKL</option>
                            <option value="Sempro">Sempro</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="berlangsung">Berlangsung</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Catatan</label>
                            <input type="text" class="form-control" id="catatan" placeholder="Masukkan Catatan" name="catatan" required>
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
            var id_sidang = $(e.relatedTarget).data('id_sidang');
            var kode_akd = $(e.relatedTarget).data('kode_akd');
            var kode_jurusan = $(e.relatedTarget).data('kode_jurusan');
            var kode_ruangan = $(e.relatedTarget).data('kode_ruangan');
            var mahasiswa = $(e.relatedTarget).data('mahasiswa');
            var pembimbing1 = $(e.relatedTarget).data('pembimbing1');
            var pembimbing2 = $(e.relatedTarget).data('pembimbing2');
            var penguji1 = $(e.relatedTarget).data('penguji1');
            var penguji2 = $(e.relatedTarget).data('penguji2');
            var tanggal = $(e.relatedTarget).data('tanggal');
            var jam_mulai = $(e.relatedTarget).data('jam_mulai');
            var jam_selesai = $(e.relatedTarget).data('jam_selesai');
            var jenis_sidang = $(e.relatedTarget).data('jenis_sidang');
            var status = $(e.relatedTarget).data('status');
            var catatan = $(e.relatedTarget).data('catatan');


            var modal = $(e.currentTarget);
            modal.find('input[name="id_sidang"]').val(id_sidang);
            modal.find('select[name="kode_akd"]').val(kode_akd);
            modal.find('select[name="kode_jurusan"]').val(kode_jurusan);
            modal.find('select[name="kode_ruangan"]').val(kode_ruangan);
            modal.find('select[name="mahasiswa"]').val(mahasiswa);
            modal.find('select[name="pembimbing1"]').val(pembimbing1);
            modal.find('select[name="pembimbing2"]').val(pembimbing2);
            modal.find('select[name="penguji1"]').val(penguji1);
            modal.find('select[name="penguji2"]').val(penguji2);
            modal.find('input[name="tanggal"]').val(tanggal);
            modal.find('input[name="jam_mulai"]').val(jam_mulai);
            modal.find('input[name="jam_selesai"]').val(jam_selesai);
            modal.find('select[name="sidang"]').val(jenis_sidang);
            modal.find('select[name="status"]').val(status);
            modal.find('input[name="catatan"]').val(catatan);
        });
    </script>
</body>

</html>