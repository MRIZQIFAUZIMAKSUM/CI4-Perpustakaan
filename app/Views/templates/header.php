<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <title>Aplikasi Perpustakaan</title>
</head>
<body>
    <?php
      $uri = service('uri');
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>/">Perpustakaan</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if (session()->get('isLoggedIn')): ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
            <a class="nav-link"  href="<?= base_url() ?>/dashboard">Dashboard</a>
          </li>
          <!-- Dropdown Buku -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarBuku" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Buku
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarBuku">
              <?php if(session()->get('role')=="admin"): ?>
              <a class="dropdown-item" href="<?= base_url() ?>/katalog/add">Tambah Katalog</a>
           <?php else:
                echo "";
            endif;
              ?>
              <a class="dropdown-item" href="<?= base_url() ?>/katalog/list">Katalog Buku</a>
              <a class="dropdown-item" href="<?= base_url() ?>/katalog/pinjam_buku">Pinjam Buku</a>
              <a class="dropdown-item" href="<?= base_url() ?>/katalog/kembali_buku">Kembalikan Buku</a>
              <a class="dropdown-item" href="<?= base_url() ?>/katalog/daftar_pinjaman">Daftar Pinjaman</a>
            </div>
          </li>
          <!-- Dropdown Anggota -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarAnggota" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Anggota
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarAnggota">
             <?php if(session()->get('role')=="admin"): ?>
              <a class="dropdown-item" href="<?= base_url() ?>/members/add">Daftar siswa</a>
              <a class="dropdown-item" href="<?= base_url() ?>/members/add_admin">Daftar admin</a>
           <?php else:
                echo "";
            endif;
              ?>
                <?php if(session()->get('role')=="admin"): ?>
              <a class="dropdown-item" href="<?= base_url() ?>/members/list">List Anggota</a>
           <?php else:
                echo "";
            endif;
              ?>
              <a class="dropdown-item" href="<?= base_url() ?>/members/denda">Denda</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item active">
            <a class="nav-link"  href="<?= base_url() ?>/dashboard"> <?php if(session()->get('role')=="admin"):
              echo "Admin";
            else:
                echo "User";
            endif;
              ?></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= session()->get('username')?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarProfile">
              <a class="dropdown-item" href="<?= base_url() ?>/profile">Edit Profile</a>
              <a class="dropdown-item" href="<?= base_url() ?>/logout">Logout</a>
            </div>
          </li>
        </ul>
      <?php else: ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
            <a class="nav-link" href="<?= base_url() ?>/login">Login</a>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
            <a class="nav-link" href="<?= base_url() ?>/register">Register</a>
          </li>
        </ul>
        <?php endif; ?>
      </div>
      </div>
    </nav>