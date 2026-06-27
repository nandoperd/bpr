<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Barang</title>

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
  <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <a href="<?= base_url('direktur') ?>" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Beranda</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('direktur/lokasi') ?>" class="nav-link">
        <i class="nav-icon fas fa-solid fa-hotel"></i>
        <p>Data Lokasi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('direktur/kategori') ?>" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>Data Kategori Barang</p>
      </a>
    </li>
    <li class="nav-item">
              <a href="<?= base_url('direktur/barang') ?>" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>Data Barang</p>
              </a>
            </li>
    <li class="nav-item">
        <a href="<?= base_url('direktur/pengajuan') ?>" class="nav-link">
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
                <h1>Data Barang</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Barang</h3>
                                <div class="card-tools">
                                    <!-- Dropdown Filter Kondisi -->
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <select id="filterKondisi" class="form-control float-right">
                                            <option value="">Semua Kondisi</option>
                                            <option value="3">Sangat Baik</option>
                                            <option value="2">Baik</option>
                                            <option value="1">Perlu Perbaikan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" id="clearFilter" class="btn btn-default">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Kondisi</th>
                                                <th>Foto</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($d as $key => $value) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td><?= $value['kode_barang'] ?></td>
                                                    <td><?= $value['nama_barang'] ?></td>
                                                    <td>Rp <?= number_format($value['harga'], 0, ',', '.') ?></td>
                                                    <td><?= date('d-m-Y', strtotime($value['tgl_brg_masuk'])) ?></td>
                                                    <td class="kondisi-cell">
                                                      <?php 
                                                      // Langsung gunakan nilai dari kolom 'kondisi' di database
                                                      $kondisi = $value['kondisi']; // nilai: 1, 2, atau 3
                                                      
                                                      if ($kondisi == 3): 
                                                          $badge_class = 'bg-success';
                                                          $kondisi_text = 'Sangat Baik';
                                                      elseif ($kondisi == 2): 
                                                          $badge_class = 'bg-primary';
                                                          $kondisi_text = 'Baik';
                                                      elseif ($kondisi == 1): 
                                                          $badge_class = 'bg-warning';
                                                          $kondisi_text = 'Perlu Perbaikan';
                                                      else: 
                                                          $badge_class = 'bg-secondary';
                                                          $kondisi_text = 'Belum Diproses';
                                                      endif; 
                                                      ?>
                                                      <span class="badge <?= $badge_class ?>" data-kondisi="<?= $kondisi ?>">
                                                          <?= $kondisi_text ?>
                                                      </span>
                                                  </td>
                                                    <td><img src="<?= base_url('foto/' . $value['foto']) ?>" class="img-circle" width="35px" height="35px"></td>
                                                    <td class="text-center">
                                                        <!-- <a class="btn btn-warning btn-sm" href="<?= base_url('barang/edit/' . $value['id'])?>"><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id']  ?>"><i class="fa fa-trash"></i></button>
                                                        <a class="btn btn-primary btn-sm" href="<?= base_url('barang/processDataMining/' . $value['id'])?>"><i class="fas fa-arrow-alt-circle-right"></i></a> -->
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal" 
                                                                data-id="<?= $value['id'] ?>"
                                                                data-kode_barang="<?= $value['kode_barang'] ?>"
                                                                data-nama_barang="<?= $value['nama_barang'] ?>"
                                                                data-harga="<?= number_format($value['harga'], 0, ',', '.') ?>"
                                                                data-tgl_brg_masuk="<?= date('d-m-Y', strtotime($value['tgl_brg_masuk'])) ?>"
                                                                data-skor="<?= $value['skor'] ?? 0 ?>"
                                                                data-kondisi="<?= $value['kondisi'] ?? 0 ?>"
                                                                data-status="<?= $value['status'] ?? 0 ?>"
                                                                data-foto="<?= $value['foto'] ?>"
                                                                data-kategori="<?= $value['kategori_nama'] ?? '-' ?>"
                                                                data-lokasi="<?= $value['lokasi_nama'] ?? '-' ?>">
                                                            <i class="fas fa-eye"></i> Detail</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
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

<!-- Modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title font-weight-bold ml-auto">Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php
            echo form_open('barang/add', ['enctype' => 'multipart/form-data']);
            ?>

            <!-- Baris 1: Kategori & Lokasi -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="id_kategori_barang" class="form-control select2" style="width: 100%;">
                            <option value="">--Pilih kategori Barang--</option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['nama_kategori_barang'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select name="id_lokasi" class="form-control select2" style="width: 100%;">
                            <option value="">--Pilih lokasi--</option>
                            <?php foreach ($lokasi as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
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
                        <input name="nama_barang" class="form-control" placeholder="Nama Barang.." required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input name="kode_barang" class="form-control" placeholder="Kode Barang.." required>
                    </div>
                </div>
            </div>

            <!-- Baris 3: Harga & Nilai Barang -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga Barang (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="Masukkan harga barang.." step="1" min="0" required>
                        <small class="text-muted">Contoh: 1000000</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nilai Barang (1-100)</label>
                        <input type="number" name="nilai_barang" class="form-control" placeholder="Masukkan nilai 1-100.." min="1" max="100" step="1" required>
                        <small class="text-muted">Nilai antara 1 - 100</small>
                    </div>
                </div>
            </div>

            <!-- Baris 4: Tanggal Masuk & Foto -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Masuk Barang</label>
                        <input type="date" name="tgl_brg_masuk" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Foto Barang</label>
                        <input type="file" name="foto" class="form-control-file" required>
                        <small class="text-muted">Format: JPG, PNG, JPEG (Max 2MB)</small>
                    </div>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal add -->

<!-- modal delete -->
<?php foreach ($d as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        Apakah anda yakin ingin menghapus data <b><?= $value['nama_barang'] ?>?</b>

                    </div>
                    <div class="modal-footer">
                      <a href="<?= base_url('barang/delete/' . $value['id']) ?>" class="btn btn-success">Hapus</a>
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php } ?>

<!-- Modal Info Barang -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="infoModalLabel">
                    <i class="fas fa-info-circle"></i> Detail Informasi Barang
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <!-- Foto Barang -->
                        <img id="infoFoto" src="" class="img-fluid img-thumbnail" style="max-height: 200px; width: auto;">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="35%">Kode Barang</th>
                                <td id="infoKodeBarang">-</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td id="infoNamaBarang">-</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td id="infoKategori">-</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td id="infoLokasi">-</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td id="infoHarga">-</td>
                            </tr>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <td id="infoTanggal">-</td>
                            </tr>
                            <tr>
                                <th>Skor</th>
                                <td id="infoSkor">
                                    <span id="infoSkorValue">-</span>
                                    <div class="progress mt-2" style="height: 8px;">
                                        <div id="infoSkorBar" class="progress-bar" style="width: 0%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td id="infoKondisi">-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan hasil data mining -->
<div class="modal fade" id="resultMiningModal" tabindex="-1" role="dialog" aria-labelledby="resultMiningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="resultMiningModalLabel">
                    <i class="fas fa-chart-line"></i> Hasil Data Mining
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (session()->getFlashdata('mining_result')): ?>
                    <?php $result = session()->getFlashdata('mining_result'); ?>
                    
                    <?php 
                    // Proses mapping kondisi di view
                    $kondisi_text = [
                        1 => 'Perlu Perbaikan',
                        2 => 'Baik',
                        3 => 'Sangat Baik'
                    ];
                    
                    $badge_class = [
                        1 => 'badge-warning',
                        2 => 'badge-info',
                        3 => 'badge-success'
                    ];
                    
                    $kondisi_display = $kondisi_text[$result['kondisi']] ?? 'Belum Diproses';
                    $badge_display = $badge_class[$result['kondisi']] ?? 'badge-secondary';
                    ?>
                    
                    <div class="alert alert-info">
                        <strong>Proses Data Mining Berhasil!</strong>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Barang</th>
                            <td><?= $result['nama_barang'] ?></td>
                        </tr>
                        <tr>
                            <th>Kode Barang</th>
                            <td><?= $result['kode_barang'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Barang Masuk</th>
                            <td><?= date('d-m-Y', strtotime($result['tgl_brg_masuk'])) ?></td>
                        </tr>
                        <tr>
                            <th>Selisih Tahun</th>
                            <td><?= $result['selisih_tahun'] ?> tahun</td>
                        </tr>
                        <tr>
                            <th>Skor</th>
                            <td>
                                <strong><?= $result['skor'] ?></strong>
                                <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar 
                                        <?php 
                                        if($result['skor'] >= 86) echo 'bg-success';
                                        elseif($result['skor'] >= 70) echo 'bg-info';
                                        else echo 'bg-warning';
                                        ?>" 
                                        style="width: <?= $result['skor'] ?>%">
                                    </div>
                                </div>
                             </td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>
                                <span class="badge <?= $badge_display ?> p-2" style="font-size: 14px;">
                                    <?= $kondisi_display ?>
                                </span>
                             </td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Input Catatan Pengajuan -->
<div class="modal fade" id="modalCatatanPengajuan" tabindex="-1" role="dialog" aria-labelledby="modalCatatanPengajuanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="modalCatatanPengajuanLabel">
                    <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('pengajuan/kirim'); ?>
            <div class="modal-body">
                <input type="hidden" name="id_barang" id="pengajuan_id_barang">
                
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="4" placeholder="Masukkan catatan perbaikan yang diperlukan..." required></textarea>
                    <!-- <small class="text-muted">Contoh: Kerusakan pada tombol power, layar retak, dll.</small> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

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

<script>
  $(function () {
    // Hancurkan DataTable jika sudah ada
    if ($.fn.DataTable.isDataTable('#example1')) {
      $('#example1').DataTable().destroy();
    }
    
    // Inisialisasi DataTable
    var table = $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "pageLength": 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
      }
    });
    
    // Tambahkan buttons ke container
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    // Hapus filter existing jika ada
    if ($.fn.dataTable.ext.search.length > 0) {
      $.fn.dataTable.ext.search.pop();
    }
    
    // Filter berdasarkan dropdown menggunakan data-kondisi
    $('#filterKondisi').on('change', function() {
      var kondisiValue = $(this).val();
      
      // Hapus filter sebelumnya (pop terakhir)
      if ($.fn.dataTable.ext.search.length > 0) {
        $.fn.dataTable.ext.search.pop();
      }
      
      if (kondisiValue === "") {
        // Tampilkan semua data
        table.draw();
      } else {
        // Tambahkan filter baru
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
          var row = table.row(dataIndex).node();
          var kondisiSpan = $(row).find('.kondisi-cell span');
          var kondisi = kondisiSpan.data('kondisi');
          return kondisi == kondisiValue;
        });
        table.draw();
      }
    });
    
    // Reset filter
    $('#clearFilter').on('click', function() {
      $('#filterKondisi').val('');
      // Hapus semua filter custom
      $.fn.dataTable.ext.search = [];
      table.draw();
    });
  });
</script>

<!-- membuat tampilan agar bisa hilang hitungan detik -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<!-- Script untuk menampilkan modal otomatis -->
<script>
    <?php if (session()->getFlashdata('mining_result')): ?>
        $(document).ready(function() {
            $('#resultMiningModal').modal('show');
        });
    <?php endif; ?>
</script>

<script>
// Script untuk modal info barang
$(document).ready(function() {
    $('#infoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var modal = $(this);
        
        // Ambil data dari atribut tombol
        var id = button.data('id');
        var kodeBarang = button.data('kode_barang');
        var namaBarang = button.data('nama_barang');
        var harga = button.data('harga');
        var tanggal = button.data('tgl_brg_masuk');
        var skor = button.data('skor');
        var kondisi = button.data('kondisi');
        var status = button.data('status');
        var foto = button.data('foto');
        var kategori = button.data('kategori');
        var lokasi = button.data('lokasi');
        
        // Mapping kondisi
        var kondisi_text = {
            1: 'Perlu Perbaikan',
            2: 'Baik',
            3: 'Sangat Baik'
        };
        
        var badge_class = {
            1: 'badge-warning',
            2: 'badge-info',
            3: 'badge-success'
        };
        
        var kondisiDisplay = kondisi_text[kondisi] || 'Belum Diproses';
        var badgeDisplay = badge_class[kondisi] || 'badge-secondary';
        
        // Tentukan warna progress bar berdasarkan skor
        var barColor = 'bg-warning';
        if (skor >= 86) barColor = 'bg-success';
        else if (skor >= 70) barColor = 'bg-info';
        
        // Isi data ke modal
        modal.find('#infoKodeBarang').text(kodeBarang || '-');
        modal.find('#infoNamaBarang').text(namaBarang || '-');
        modal.find('#infoKategori').text(kategori || '-');
        modal.find('#infoLokasi').text(lokasi || '-');
        modal.find('#infoHarga').text(harga ? 'Rp ' + harga : '-');
        modal.find('#infoTanggal').text(tanggal || '-');
        modal.find('#infoSkorValue').text(skor || '0');
        modal.find('#infoSkorBar').css('width', (skor || 0) + '%').removeClass('bg-success bg-info bg-warning').addClass(barColor);
        modal.find('#infoKondisi').html('<span class="badge ' + badgeDisplay + ' p-2" style="font-size: 14px;">' + kondisiDisplay + '</span>');
        
        // Set foto
        if (foto && foto !== '') {
            modal.find('#infoFoto').attr('src', '<?= base_url() ?>foto/' + foto);
        } else {
            modal.find('#infoFoto').attr('src', '<?= base_url() ?>img/no-image.png');
        }
        
        // Atur tombol Kirim Pengajuan (hanya muncul jika kondisi == 1)
        if (kondisi == 1 && status == 2) {
            modal.find('#btnKirimPengajuan')
                .off('click')
                .on('click', function(e) {
                    e.preventDefault();
                    
                    // Tutup modal info terlebih dahulu
                    $('#infoModal').modal('hide');
                    
                    // Siapkan data untuk modal catatan
                    $('#pengajuan_id_barang').val(id);
                    $('#pengajuan_nama_barang').text(namaBarang);
                    $('#pengajuan_kode_barang').text(kodeBarang);
                    $('#pengajuan_lokasi').text(lokasi);
                    
                    // Tampilkan modal catatan
                    setTimeout(function() {
                        $('#modalCatatanPengajuan').modal('show');
                    }, 500);
                })
                .show();
        } else {
            modal.find('#btnKirimPengajuan').hide();
        }
    });
});
</script>

<script>
// Notifikasi sukses/gagal
<?php if (session()->getFlashdata('sukses')): ?>
    $(document).ready(function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('sukses') ?>',
            confirmButtonColor: '#3085d6',
            timer: 3000,
            showConfirmButton: true
        });
    });
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    $(document).ready(function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonColor: '#d33'
        });
    });
<?php endif; ?>
</script>

</body>
</html>