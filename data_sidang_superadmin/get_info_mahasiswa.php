<?php
require_once '../database/koneksi.php';

if(isset($_POST['nim'])) {
    $nim = mysqli_real_escape_string($db, $_POST['nim']);
    $query = mysqli_query($db, "SELECT jurusan, nik_pembimbing FROM tbl_info WHERE nim = '$nim'") or die(mysqli_error($db));
    
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>