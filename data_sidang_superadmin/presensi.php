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
                            <h3 class="card-title">Presensi Matkul</h3>
                        </div>
                        <div class="card border-0 shadow-none bg-transparent">
                            <div class="card-body">
                                <?php
                                $id_sidang = $_GET['id_sidang'];
                                $cek_query_detail = mysqli_query($db, "SELECT s.*, a.tahun, a.semester, j.nama_jurusan, 
                                d1.nama AS nama_pm1, d2.nama AS nama_pm2,
                                d3.nama AS nama_pg1, d4.nama AS nama_pg2,
                                m.nim, m.nama AS nama_mhs, m.kelamin AS kelamin_mhs, m.img AS img_mhs, r.nama_ruangan, r.kode_ruangan 
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
                                $nim = $data_sidang['nim'];
                                $nama_mahasiswa = $data_sidang['nama_mhs'];
                                $nik_dosen_pembimbing1 = $data_sidang['nik_pembimbing_1'];
                                $nama_dosen_pembimbing1 = $data_sidang['nama_pm1'];
                                $nik_dosen_pembimbing2 = $data_sidang['nik_pembimbing_2'];
                                $nama_dosen_pembimbing2 = $data_sidang['nama_pm2'];
                                $nik_dosen_penguji1 = $data_sidang['nik_penguji_1'];
                                $nama_dosen_penguji1 = $data_sidang['nama_pg1'];
                                $nik_dosen_penguji2 = $data_sidang['nik_penguji_2'];
                                $nama_dosen_penguji2 = $data_sidang['nama_pg2'];
                                $judul_sidang = $data_sidang['judul'];
                                $jam_mulai = $data_sidang['jam_mulai'];
                                $jam_selesai = $data_sidang['jam_selesai'];
                                $tanggal = $data_sidang['tgl'];
                                $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                                $kelamin = $data_sidang['kelamin_mhs'];
                                $img = $data_sidang['img_mhs'];
                                $status_sidang = $data_sidang['status'];
                                ?>
                                <div class="row"> 
                                    <div class="col-md-4 text-center mb-4">
                                        <?php
                                        if ($kelamin == 'L') {
                                        ?>
                                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/mhs-lk.jpg' ?>"  alt="foto mhs laki-laki" style="width:200px">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/mhs-perempuan.jpg' ?>" alt="foto mhs perempuan" style="width:200px">
                                        <?php
                                        }
                                        ?>
                                        
                                        <div class="mt-3">
                                            <?php if ($status_sidang == 'dijadwalkan') { ?>
                                                <a href="ubah_status_sidang.php?id_sidang=<?= $id_sidang ?>&status_baru=berlangsung" class="btn btn-sm btn-secondary" onclick="return confirm('Apakah Anda yakin ingin memulai sidang ini?')">
                                                    Dijadwalkan
                                                </a>
                                            <?php } elseif ($status_sidang == 'berlangsung') { ?>
                                                <a href="ubah_status_sidang.php?id_sidang=<?= $id_sidang ?>&status_baru=selesai" class="btn btn-sm btn-warning" onclick="return confirm('Apakah sidang sudah selesai?')">
                                                    Berlangsung
                                                </a>
                                            <?php } elseif ($status_sidang == 'selesai') { ?>
                                                <span class="badge badge-success p-2" style="font-size: 14px;"><i class="fas fa-check-circle mr-1"></i> Sidang Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge badge-light p-2">Belum Diset</span>
                                            <?php } ?>
                                    </div>
                                </div>
                                    
                                    <div class="col-12 col-md-4 mb-4 ">
                                        <table class="table table-borderless table-sm m-0">
                                            <tr>
                                                <td width="30%">Judul</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $judul_sidang ?></td>
                                            </tr>
                                            <tr>
                                                <td>Mahasiswa</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $nama_mahasiswa; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NIM</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $nim; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ruangan</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $nama_ruangan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jurusan</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $jurusan; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Dosen Penguji 1</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $nik_dosen_pembimbing1; ?> - <?= $nama_dosen_pembimbing1; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Dosen Penguji 2</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $nik_dosen_pembimbing2; ?> - <?= $nama_dosen_pembimbing2; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Tanggal</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $hari[date_format(date_create($tanggal), 'w')] . date_format(date_create($tanggal), ', d F Y') ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-12 col-md-4 text-center mb-4">
                                        <?php
                                        include('../asset_adminlte/phpqrcode/qrlib.php');
                                        // how to save PNG codes to server
                                        $isi_qr = $id_sidang;
                                        
                                        $fileName = 'file-qr-'.($isi_qr).'.png';
                                        
                                        $alamat_tujuan = 'qr/'.$fileName;
                                        
                                        // generating
                                        QRcode::png($isi_qr, $alamat_tujuan);
                                        ?>
                                        <img src="<?= $alamat_tujuan ?>"  alt="QR Code Pertemuan" style="width:200px">
                                        <?php 
                                        if ($status_sidang == '1') {
                                            ?>
                                            <p id="waktu"></p> 
                                            <?php 
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="index.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <a href=""></a>
                            <div id="tabel_presensi"></div>
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

    <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Kehadiran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses_edit_presensi.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="id_presensi" hidden>
            <div class="form-group">
              <label>Status Kehadiran</label>
              <select class="form-control" name="kehadiran" required>
                <option value="">-- Pilih Status Kehadiran --</option>
                <option value="hadir">Hadir</option>
                <option value="tidak_hadir">Tidak Hadir</option>
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


    <?php
    include '../script.php';
    ?>

    <script>
  $('#modal-edit').on('show.bs.modal', function(e){
  var id_presensi = $(e.relatedTarget).data('id_presensi');

  $(e.currentTarget).find('input[name="id_presensi"]').val(id_presensi);
  })
</script>

<script>
var countDownDate = new Date().getTime()+(60*1*1000);

var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = countDownDate - now;

  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("waktu").innerHTML = minutes + "m " + seconds + "s ";

  if (distance < 0) {
    clearInterval(x);
    
  }
}, 1000);
</script>

<script>
    function refresh_kehadiran() {
        $('#tabel_presensi').load('tabel_presensi.php?id_sidang=<?= $id_sidang ?>');
        setTimeout(refresh_kehadiran, 5000);
    }

    refresh_kehadiran();
</script>

</body>

</html>