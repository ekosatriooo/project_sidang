<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="../home_dosen" class="nav-link <?php if ($halaman=='home'){echo 'active';}?>">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Home
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../data_kelas_matkul_dosen" class="nav-link <?php if ($halaman=='data_kelas_matkul'){echo 'active';}?>">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
          Data Kelas Matkul
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../ganti_password_dosen" class="nav-link <?php if ($halaman=='ganti_password'){echo 'active';}?>">
        <i class="nav-icon fas fa-lock"></i>
        <p>
          Ganti Password
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../logout.php" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Keluar
        </p>
      </a>
    </li>
</nav>