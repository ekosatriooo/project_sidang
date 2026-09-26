<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah-peserta'])) {
    $id_sidang = trim(mysqli_real_escape_string($db, $_POST['id_sidang']));
    $nim = trim(mysqli_real_escape_string($db, $_POST['nim']));
    $status_kehadiran = "tidak_hadir";

    $query_cek = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE nim = '$nim' AND id_sidang = '$id_sidang'") or die(mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>
                alert("Mahasiswa sudah terdaftar di sidang");
                window.location.href="presensi.php?id_sidang='.$id_sidang.'";
              </script>';
    } else {
        $query_simpan = mysqli_query($db, "INSERT INTO tbl_presensi VALUES (null, '$nim', '$status_kehadiran', '$id_sidang')") or die(mysqli_error($db));
        
        if($query_simpan) {
            echo '<script>
                    alert("Berhasil menambahkan peserta");
                    window.location.href="presensi.php?id_sidang='.$id_sidang.'";
                  </script>';
        }
    }
}
?>