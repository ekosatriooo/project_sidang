<?php
require_once '../database/koneksi.php';

?>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id_sidang = $_GET['id_sidang'];
        $query_peserta = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE id_sidang = '$id_sidang'") or die(mysqli_error($db));
        $rv = mysqli_num_rows($query_peserta);
        if ($rv > 0) {
            $no = 1;
            while ($data_peserta = mysqli_fetch_array($query_peserta)) {
                $nim = $data_peserta['nim'];

                $query_mhs = mysqli_query($db, "SELECT nama FROM tbl_mahasiswa WHERE nim = '$nim'");
                $data_mhs = mysqli_fetch_array($query_mhs);
                $nama_mhs = $data_mhs['nama'];

                $query_presensi = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE id_sidang = '$id_sidang' AND nim = '$nim'");

                $data_presensi = mysqli_fetch_array($query_presensi);
                $id_presensi = $data_presensi['id'];
                $status_kehadiran = $data_presensi['status_kehadiran'];

        ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $nim ?> - <?= $nama_mhs ?></td>
                    <td>
                        <?php
                        $warna = 'danger';
                        if ($status_kehadiran == 'hadir') {
                            $warna = 'success';
                        } else {
                            $warna = 'danger';
                        }
                        ?>
                        <span class="badge badge-<?= $warna ?>"><?= $status_kehadiran == 'hadir' ? 'Hadir' : 'Tidak Hadir' ?></span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-edit"
                            data-id_presensi="<?= $id_presensi; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>