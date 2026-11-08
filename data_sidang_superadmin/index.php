<?php
require_once '../database/koneksi.php';
$peran = $_SESSION['peran'];
if ($peran != 'S') {
  echo '<script>window.location.href="../logout.php"</script>';
}else {
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
        <aside class="main-sidebar sidebar-dark-maroon elevation-4">
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
                        <div class="card-header bg-teal">
                            <h3 class="card-title">Data Jadwal Sidang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fas fa-plus"></i>Tambah Data
                            </button>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-import">
                                <i class="fas fa-file-excel"></i>Import Data
                            </button>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Mahasiswa</th>
                                        <th>Pembimbing</th>
                                        <th>Penguji</th>
                                        <th>Ruang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cek_query = mysqli_query($db, "SELECT s.*,
                                    dp.nama AS nama_pembimbing, dg.nama AS nama_penguji,
                                    m.nim, m.nama AS nama_mhs, r.nama_ruangan, r.kode_ruangan 
                                    FROM tbl_sidang s 
                                    LEFT JOIN tbl_dosen dp ON s.nik_pembimbing = dp.nik
                                    LEFT JOIN tbl_dosen dg ON s.nik_penguji = dg.nik
                                    LEFT JOIN tbl_mahasiswa m ON s.nim = m.nim 
                                    LEFT JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan") or die(mysqli_error($db));
                                    $rv = mysqli_num_rows($cek_query);
                                    $no = 1;
                                    if ($rv > 0) {
                                        while ($data = mysqli_fetch_array($cek_query)) {
                                            $id_sidang = $data['id'];
                                            $nim = $data['nim'];
                                            $nama_mahasiswa = $data['nama_mhs'];
                                            $nik_dosen_pembimbing = $data['nik_pembimbing']; 
                                            $nik_dosen_penguji = $data['nik_penguji']; 
                                            $nama_dosen_pembimbing = $data['nama_pembimbing'];
                                            $nama_dosen_penguji = $data['nama_penguji'];
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
                                                <td><?= $nim; ?> - <?= $nama_mahasiswa ?></td>
                                                <td><?= $nik_dosen_pembimbing; ?> - <?= $nama_dosen_pembimbing ?></td>
                                                <td><?= $nik_dosen_penguji; ?> - <?= $nama_dosen_penguji ?></td>
                                                <td><?= $nama_ruangan; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                                                        data-id_sidang="<?= $id_sidang; ?>"
                                                        data-kode_ruangan="<?= $data['kode_ruangan'] ?>"
                                                        data-mahasiswa="<?= $nim; ?>"
                                                        data-pembimbing="<?= $data['nik_pembimbing']; ?>"
                                                        data-penguji="<?= $data['nik_penguji']; ?>"
                                                        data-tanggal="<?= $data['tgl']; ?>"
                                                        data-jam_mulai="<?= $jam_mulai; ?>"
                                                        data-jam_selesai="<?= $jam_selesai; ?>"
                                                        data-status="<?= $data['status']; ?>"
                                                        data-judul="<?= $data['judul']; ?>"
                                                        >
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="hapus.php?id_sidang=<?= $id_sidang; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    <a href="detail.php?id_sidang=<?= $id_sidang; ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                    <a href="presensi.php?id_sidang=<?= $id_sidang ?>" class="btn btn-sm btn-info"><i class="fas fa-qrcode"></i></a>
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
                            <label>Mahasiswa</label>
                            <input type="text" class="form-control" name="mahasiswa" id="tambah_mahasiswa" placeholder="Masukkan NIM mahasiswa" required>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" id="tambah_jurusan" placeholder="Otomatis terisi" readonly required>
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
                            <label>Dosen Pembimbing</label>
                            <select class="form-control" name="pembimbing" id="tambah_pembimbing" style="pointer-events: none;" required>
                                <option value="">-- Pilih Dosen Pembimbing--</option>
                                <?php
                                $query_pembimbing = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing = mysqli_num_rows($query_pembimbing);
                                if ($rv_pembimbing > 0) {
                                    while($data_pembimbing = mysqli_fetch_array($query_pembimbing)) {
                                        ?>
                                        <option value="<?= $data_pembimbing['nik'] ?>"><?= $data_pembimbing['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji</label>
                            <select class="form-control" name="penguji" required>
                                <option value="">-- Pilih Dosen Penguji--</option>
                                <?php
                                $query_penguji = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji1 = mysqli_num_rows($query_penguji);
                                if ($rv_penguji1 > 0) {
                                    while($data_penguji = mysqli_fetch_array($query_penguji)) {
                                        ?>
                                        <option value="<?= $data_penguji['nik'] ?>"><?= $data_penguji['nama'] ?></option>
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
                            <label for="exampleInputEmail1">Judul Sidang Mahasiswa</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul" name="judul" required>
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
                            <label>Mahasiswa</label>
                            <input type="text" class="form-control" name="mahasiswa" id="edit_mahasiswa" placeholder="Masukkan NIM mahasiswa" required>
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" id="edit_jurusan" placeholder="Otomatis terisi" readonly required>
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
                            <label>Dosen Pembimbing</label>
                            <select class="form-control" name="pembimbing" id="edit_pembimbing" style="pointer-events: none; background-color: #e9ecef;" required>
                                <option value="">-- Pilih Dosen Pembimbing--</option>
                                <?php
                                $query_pembimbing = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_pembimbing = mysqli_num_rows($query_pembimbing);
                                if ($rv_pembimbing > 0) {
                                    while($data_pembimbing = mysqli_fetch_array($query_pembimbing)) {
                                        ?>
                                        <option value="<?= $data_pembimbing['nik'] ?>"><?= $data_pembimbing['nama'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen Penguji</label>
                            <select class="form-control" name="penguji" required>
                                <option value="">-- Pilih Dosen Penguji--</option>
                                <?php
                                $query_penguji = mysqli_query($db, "SELECT nik, nama FROM tbl_dosen")or die(mysqli_error($db));
                                $rv_penguji = mysqli_num_rows($query_penguji);
                                if ($rv_penguji > 0) {
                                    while($data_penguji = mysqli_fetch_array($query_penguji)) {
                                        ?>
                                        <option value="<?= $data_penguji['nik'] ?>"><?= $data_penguji['nama'] ?></option>
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
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="berlangsung">Berlangsung</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Sidang Mahasiswa</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul" name="judul" required>
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
        $(document).ready(function() {
            
            function fetchInfoMahasiswa(nim, elementJurusan, elementPembimbing) {
                if(nim !== '') {
                    $.ajax({
                        url: 'get_info_mahasiswa.php',
                        type: 'POST',
                        data: { nim: nim },
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == 'success') {
                                $(elementJurusan).val(response.data.jurusan);
                                $(elementPembimbing).val(response.data.nik_pembimbing);
                            } else {
                                $(elementJurusan).val('');
                                $(elementPembimbing).val('');
                                alert('Data mahasiswa belum ada di tbl_info!');
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat mengambil data server.');
                        }
                    });
                } else {
                    $(elementJurusan).val('');
                    $(elementPembimbing).val('');
                }
            }

            $('#tambah_mahasiswa').on('change', function() {
                fetchInfoMahasiswa($(this).val(), '#tambah_jurusan', '#tambah_pembimbing');
            });

            $('#edit_mahasiswa').on('change', function() {
                fetchInfoMahasiswa($(this).val(), '#edit_jurusan', '#edit_pembimbing');
            });

            $('#modal-edit').on('show.bs.modal', function(e) {
                var id_sidang = $(e.relatedTarget).data('id_sidang');
                var kode_ruangan = $(e.relatedTarget).data('kode_ruangan');
                var mahasiswa = $(e.relatedTarget).data('mahasiswa');
                var pembimbing = $(e.relatedTarget).data('pembimbing');
                var penguji = $(e.relatedTarget).data('penguji');
                var tanggal = $(e.relatedTarget).data('tanggal');
                var jam_mulai = $(e.relatedTarget).data('jam_mulai');
                var jam_selesai = $(e.relatedTarget).data('jam_selesai');
                var status = $(e.relatedTarget).data('status');
                var judul = $(e.relatedTarget).data('judul');

                var modal = $(e.currentTarget);
                modal.find('input[name="id_sidang"]').val(id_sidang);
                modal.find('select[name="kode_ruangan"]').val(kode_ruangan);
                
                modal.find('input[name="mahasiswa"]').val(mahasiswa);
                
                modal.find('select[name="pembimbing"]').val(pembimbing);
                modal.find('select[name="penguji"]').val(penguji);
                modal.find('input[name="tanggal"]').val(tanggal);
                modal.find('input[name="jam_mulai"]').val(jam_mulai);
                modal.find('input[name="jam_selesai"]').val(jam_selesai);
                modal.find('select[name="status"]').val(status);
                modal.find('input[name="judul"]').val(judul);

                if(mahasiswa !== '') {
                    fetchInfoMahasiswa(mahasiswa, '#edit_jurusan', '#edit_pembimbing');
                }
            });
        });
    </script>
</body>
</html>
<?php
} 
?>