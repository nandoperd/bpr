<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Data Barang</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Animasi Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>img/bpr.png" alt="Lokasi" height="100" width="150">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">BPR System</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar -->
      <li class="nav-item">
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-default btn-flat"><i class="fas fa-sign-out-alt"></i> Keluar</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url() ?>img/bpr.png" alt="Lokasi" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BPR System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= base_url('admin') ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Beranda</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('lokasi') ?>" class="nav-link">
            <i class="nav-icon fas fa-solid fa-hotel"></i>
            <p>Data Lokasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>Master Data<i class="right fas fa-angle-right"></i></p>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('kategori') ?>" class="nav-link">
                  <i class="nav-icon fas fa-sitemap"></i>
                  <p>Data Kategori Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('barang') ?>" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Data Barang</p>
                </a>
              </li>
            </ul>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('pengajuan') ?>" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>Pengajuan</p>
          </a>
        </li>
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>Edit Data Barang</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="<?= base_url('barang') ?>">Barang</a></li>
                              <li class="breadcrumb-item active">Edit</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Main content -->
          <section class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h3 class="card-title">Form Edit Data Barang</h3>
                              </div>
                              <div class="card-body">
                                  <?php
                                  if (session()->getFlashdata('pesan')) {
                                      echo '<div class="alert alert-success" role="alert">';
                                      echo session()->getFlashdata('pesan');
                                      echo '</div>';
                                  }
                                  if (session()->getFlashdata('errors')) {
                                      echo '<div class="alert alert-danger" role="alert">';
                                      echo '<ul>';
                                      foreach (session()->getFlashdata('errors') as $error) {
                                          echo '<li>' . $error . '</li>';
                                      }
                                      echo '</ul>';
                                      echo '</div>';
                                  }
                                  ?>
                                  
                                  <?php echo form_open('barang/update/' . $d['id'], ['enctype' => 'multipart/form-data']); ?>

                                  <!-- Baris 1: Kategori & Lokasi -->
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Kategori Barang</label>
                                              <select name="id_kategori_barang" class="form-control select2" style="width: 100%;" required>
                                                  <option value="">--Pilih kategori Barang--</option>
                                                  <?php foreach ($kategori as $key => $value) { ?>
                                                      <option value="<?= $value['id'] ?>" <?= ($d['id_kategori_barang'] == $value['id']) ? 'selected' : '' ?>>
                                                          <?= $value['nama_kategori_barang'] ?>
                                                      </option>
                                                  <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Lokasi</label>
                                              <select name="id_lokasi" class="form-control select2" style="width: 100%;" required>
                                                  <option value="">--Pilih lokasi--</option>
                                                  <?php foreach ($lokasi as $key => $value) { ?>
                                                      <option value="<?= $value['id'] ?>" <?= ($d['id_lokasi'] == $value['id']) ? 'selected' : '' ?>>
                                                          <?= $value['nama'] ?>
                                                      </option>
                                                  <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- Baris 2: Nama Barang & Kode Barang -->
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input name="nama_barang" class="form-control" placeholder="Nama Barang.." value="<?= $d['nama_barang'] ?>" required>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Kode Barang</label>
                                              <input name="kode_barang" class="form-control" placeholder="Kode Barang.." value="<?= $d['kode_barang'] ?>" required>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- Baris 3: Harga & Nilai Barang -->
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Harga Barang (Rp)</label>
                                              <input type="number" name="harga" class="form-control" placeholder="Masukkan harga barang.." step="1" min="0" value="<?= $d['harga'] ?>" required>
                                              <small class="text-muted">Contoh: 1000000</small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Nilai Barang (1-100)</label>
                                              <input type="number" name="nilai_barang" class="form-control" placeholder="Masukkan nilai 1-100.." min="1" max="100" step="1" value="<?= $d['nilai_barang'] ?>" required>
                                              <small class="text-muted">Nilai antara 1 - 100</small>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- Baris 4: Tanggal Masuk & Foto -->
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Tanggal Masuk Barang</label>
                                              <input type="date" name="tgl_brg_masuk" class="form-control" value="<?= $d['tgl_brg_masuk'] ?>" required>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Foto Barang</label>
                                              <?php if ($d['foto']): ?>
                                                  <div class="mb-2">
                                                      <img src="<?= base_url('foto/' . $d['foto']) ?>" alt="Foto Barang" style="max-width: 100px; max-height: 100px;">
                                                      <br>
                                                      <small class="text-muted">Foto saat ini</small>
                                                  </div>
                                              <?php endif; ?>
                                              <input type="file" name="foto" class="form-control-file">
                                              <small class="text-muted">Format: JPG, PNG, JPEG (Max 2MB). Kosongkan jika tidak ingin mengubah foto</small>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="form-footer mt-3">
                                      <button type="submit" class="btn btn-success">Update</button>
                                      <a href="<?= base_url('barang') ?>" class="btn btn-danger">Kembali</a>
                                  </div>

                                  <?php echo form_close(); ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <!-- <div class="float-right d-none d-sm-block">
          <b>Version</b> 3.2.0
        </div> -->
        <strong>BPR System</strong>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

<!-- scripts -->
<!-- jQuery -->
<script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- membuat tampilan agar bisa hilang hitungan detik -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>

</body>
</html>