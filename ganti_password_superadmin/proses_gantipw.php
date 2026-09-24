<?php
require_once '../database/koneksi.php';

if(isset($_POST['btn-ganti'])) {
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $pw_baru = trim(mysqli_real_escape_string($db, $_POST['pwbaru']));
    $cpw = trim(mysqli_real_escape_string($db, $_POST['cpassword']));

    if ($pw_baru == $cpw) {
        $pw_enkripsi = sha1($pw_baru);
        $query_gantipw = mysqli_query($db, "UPDATE tbl_pengguna SET sandi = '$pw_enkripsi' WHERE username = '$username'") or die(mysqli_error($db));
        echo '<script>alert ("Ganti password telah berhasil")</script>';
        echo '<script>window.location.href="../logout.php"</script>';
    }else {
        echo '<script>alert ("Password baru dan konfirmasi password tidak sama")</script>';
        echo '<script>window.location.href="index.php"</script>';
    }
}
?>