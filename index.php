<?php
require_once 'database/koneksi.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="asset_login/fonts/icomoon/style.css">

  <link rel="stylesheet" href="asset_login/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="asset_login/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="asset_login/css/style.css">

  <title>Login</title>
</head>

<body>

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('asset_login/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3><strong>Sistem Manajemen</strong></h3>
            <form action="" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="username" id="username" name="pengguna" required>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="password" id="password" name="sandi" required>
              </div>
              <input type="submit" value="Log In" class="btn btn-block btn-primary" name="btn-login">

            </form>
            <?php
            if (isset($_POST['btn-login'])) { // trigger button login ketika ditekan
              $pengguna = trim(mysqli_real_escape_string($db, $_POST['pengguna']));
              $sandi = sha1(trim(mysqli_real_escape_string($db, $_POST['sandi'])));

              $query_cek_pengguna = mysqli_query($db, "SELECT * FROM tbl_pengguna WHERE username = '$pengguna' AND sandi = '$sandi'") or die(mysqli_error($db));
              $rv = mysqli_num_rows($query_cek_pengguna);
              if ($rv == 1) {
                $data = mysqli_fetch_assoc($query_cek_pengguna);
                $user = $data['username'];
                $peran = $data['peran'];
                $nama = $data['nama'];
                $pin = $data['pin'];

                $_SESSION['user'] = $user;
                $_SESSION['peran'] = $peran;
                $_SESSION['nama'] = $nama;
                $_SESSION['pin'] = $pin;
                if ($peran == 'S') {
                  echo '<script>window.location.href="2fa"</script>';
                } elseif ($peran == 'D') {
                  echo '<script>window.location.href="2fa"</script>';
                } else {
                  echo '<script>window.location.href="2fa"</script>';
                }
              } else {
                echo '<script>alert ("Pengguna Tidak Ditemukan")</script>';
                echo '<script>window.location.href="../sidang"</script>';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="asset_login/js/jquery-3.3.1.min.js"></script>
  <script src="asset_login/js/popper.min.js"></script>
  <script src="asset_login/js/bootstrap.min.js"></script>
  <script src="asset_login/js/main.js"></script>
</body>

</html>