<?php
require_once '../database/koneksi.php';
$id_sidang = $_GET['id_sidang'];
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($db, "SELECT p.nim, m.nama AS nama_mhs, p.status_kehadiran 
        FROM tbl_presensi p 
        JOIN tbl_mahasiswa m ON p.nim = m.nim 
        JOIN tbl_sidang s ON p.id_sidang = s.id
        WHERE p.id_sidang = '$id_sidang' AND p.nim != s.nim") or die(mysqli_error($db));

        if (mysqli_num_rows($query) > 0) {
            $no = 1;
            while ($data = mysqli_fetch_array($query)) {
                $nim = $data['nim'];
                $nama_mhs = $data['nama_mhs'];
                $status_kehadiran = $data['status_kehadiran'];
        ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $nim ?> - <?= $nama_mhs ?></td>
                    <td>
                        <?php
                        if (empty($status_kehadiran)) {
                            $warna = 'secondary';
                            $teks_status = 'Belum Absen';
                        } elseif ($status_kehadiran == 'hadir') {
                            $warna = 'success';
                            $teks_status = 'Hadir';
                        } else {
                            $warna = 'danger';
                            $teks_status = 'Tidak Hadir';
                        }
                        ?>
                        <span class="badge badge-<?= $warna ?>"><i class="fas <?= $status_kehadiran == 'hadir' ? 'fa-check' : 'fa-times' ?> mr-1"></i> <?= $teks_status ?></span>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>Belum ada peserta yang hadir.</td></tr>";
        }
        ?>
    </tbody>
</table>