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
                            <h3 class="card-title">Presensi Matkul</h3>
                        </div>
                        <div class="card border-0 shadow-none bg-transparent">
                            <div class="card-body">
                                <?php
                                $id_pertemuan = $_GET['id'];
                                $query_pertemuan = mysqli_query($db, "SELECT * FROM tbl_pertemuan WHERE id = '$id_pertemuan'")or die(mysqli_error($db));
                                $data_pertemuan = mysqli_fetch_array($query_pertemuan);
                                $id_kelas = $data_pertemuan['id_kelas'];
                                $judul_pertemuan = $data_pertemuan['judul_pertemuan'];
                                $tanggal = $data_pertemuan['tanggal'];
                                $tanggal_baru = date_create($tanggal);
                                $status_pertemuan = $data_pertemuan['status_pertemuan'];
                                $cek_query_detail = mysqli_query($db, "SELECT km.id, km.kode_akd, km.kode_jurusan, km.nik, km.kode_matkul, km.nama_kelas, a.tahun, a.semester, j.nama_jurusan, m.nama_matkul, d.nik, d.nama, d.img, d.kelamin FROM tbl_kelas_matkul km LEFT JOIN tbl_akademik a ON km.kode_akd = a.kode_akd LEFT JOIN tbl_jurusan j ON km.kode_jurusan = j.kode_jurusan LEFT JOIN tbl_matkul m ON km.kode_matkul = m.kode_matkul LEFT JOIN tbl_dosen d ON km.nik = d.nik WHERE km.id = '$id_kelas'") or die(mysqli_error($db));
                                $data_kelas = mysqli_fetch_array($cek_query_detail);
                                $matkul = $data_kelas['nama_matkul'];
                                $kode_makul = $data_kelas['kode_matkul'];
                                $nik = $data_kelas['nik'];
                                $nama_dosen = $data_kelas['nama'];
                                $jurusan = $data_kelas['nama_jurusan'];
                                $tahun = $data_kelas['tahun'];
                                $semester = $data_kelas['semester'];
                                $nama_kelas = $data_kelas['nama_kelas'];
                                $img = $data_kelas['img'];
                                $kelamin= $data_kelas['kelamin']
                                ?>
                                <div class="row"> 
                                    <div class="col-md-4 text-center mb-4">
                                        <?php
                                        if ($kelamin == 'L') {
                                        ?>
                                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/dsn-lk.jpg' ?>"  alt="foto mhs laki-laki" style="width:200px">
                                        <?php
                                        }else {
                                        ?>
                                            <img src="<?= ($img != null) ? $img : '../asset_adminlte/img/dsn-perempuan.jpg' ?>" alt="foto mhs perempuan" style="width:200px">
                                        <?php
                                        }
                                        ?>
                                        <div class="mt-3 mx-auto" style="width: 200px;">
                                            <?php if ($status_pertemuan == '0') { ?>
                                                <a href="buka.php?id=<?= $id_pertemuan; ?>" class="btn btn-sm btn-success btn-block" onclick="return confirm('Yakin ingin membuka absen?')">
                                                    <i class="fas fa-door-open"></i> Buka Absen
                                                </a>
                                            <?php } else { ?>
                                                <a href="tutup.php?id=<?= $id_pertemuan; ?>" class="btn btn-sm btn-warning btn-block" onclick="return confirm('Yakin ingin menutup absen?')">
                                                    <i class="fas fa-door-closed"></i> Tutup Absen
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4 mb-4 ">
                                        <table class="table table-borderless table-sm m-0">
                                            <tr>
                                                <td width="30%">Akademik</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $tahun; ?>-<?= $semester == 'GL' ? 'Ganjil' : 'Genap'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Dosen</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $nama_dosen; ?> - <?= $nik; ?></td>
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
                                            <tr>
                                                <td width="30%">Mata Kuliah</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $matkul; ?> - <?= $kode_makul; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Judul Materi</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= $judul_pertemuan; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Tanggal</td>
                                                <td width="5%">:</td>
                                                <td class="font-weight-bold"><?= date_format($tanggal_baru,  "l, d F Y") ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-12 col-md-4 text-center mb-4">
                                        <?php
                                        include('../asset_adminlte/phpqrcode/qrlib.php');
                                        // how to save PNG codes to server
                                        $isi_qr = $id_pertemuan;
                                        
                                        // we need to generate filename somehow, 
                                        // with md5 or with database ID used to obtains $codeContents...
                                        $fileName = 'file-qr-'.($isi_qr).'.png';
                                        
                                        $alamat_tujuan = 'qr/'.$fileName;
                                        
                                        // generating
                                        QRcode::png($isi_qr, $alamat_tujuan);
                                        ?>
                                        <img src="<?= $alamat_tujuan ?>"  alt="QR Code Pertemuan" style="width:200px">
                                        <?php 
                                        if ($status_pertemuan == '1') {
                                            ?>
                                            <p id="waktu"></p> 
                                            <?php 
                                        }
                                        ?>
                                    </div>
                                </div> <!-- AKHIR DARI ROW -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="pertemuan.php?id=<?= $id_kelas; ?>" class="btn btn-sm btn-danger mb-3">Kembali</a>
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
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alfa">Alfa</option>
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
// Set the date we're counting down to
var countDownDate = new Date().getTime()+(60*1*1000);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("waktu").innerHTML = minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    // document.getElementById("waktu").innerHTML = "Presensi Ditutup";
    window.location.href="tutup.php?id=<?= $id_pertemuan; ?>";
  }
}, 1000);
</script>

<script>
    function refresh_kehadiran() {
        $('#tabel_presensi').load('tabel_presensi.php?id_kelas=<?= $id_kelas ?>&id_pertemuan=<?= $id_pertemuan ?>');
        setTimeout(refresh_kehadiran, 5000);
    }

    refresh_kehadiran();
</script>

</body>

</html>