<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pengajuan - Accounting</title>

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
    <img class="animation__shake" src="<?= base_url() ?>img/bpr.png" alt="Logo" height="100" width="150">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">BPR System</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-default btn-flat"><i class="fas fa-sign-out-alt"></i> Keluar</a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="<?= base_url() ?>img/bpr.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BPR System</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
      <a href="<?= base_url('manager') ?>" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Beranda</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('manager/lokasi') ?>" class="nav-link">
        <i class="nav-icon fas fa-solid fa-hotel"></i>
        <p>Data Lokasi</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('manager/kategori') ?>" class="nav-link">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>Data Kategori Barang</p>
      </a>
    </li>
    <li class="nav-item">
              <a href="<?= base_url('manager/barang') ?>" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>Data Barang</p>
              </a>
            </li>
    <li class="nav-item">
        <a href="<?= base_url('manager/pengajuan') ?>" class="nav-link">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>Pengajuan</p>
        </a>
      </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengajuan</h1>
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
                <h3 class="card-title">Daftar Pengajuan Barang</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <select id="filterStatus" class="form-control float-right">
                        <option value="">Semua Status</option>
                        <option value="1">Menunggu Approval Accounting</option>
                        <option value="2">Menunggu Approval Direktur</option>
                        <option value="3">Selesai</option>
                        <option value="4">Revisi Accounting</option>
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
                  <table id="tablePengajuan" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($d as $row): ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $row['kode_barang'] ?? '-' ?></td>
                        <td><?= $row['nama_barang'] ?? '-' ?></td>
                        <td><?= $row['nama_kategori_barang'] ?? '-' ?></td>
                        <td><?= $row['lokasi_nama'] ?? '-' ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tgl_pengajuan'])) ?></td>
                        <td><?= strlen($row['catatan'] ?? '') > 50 ? substr($row['catatan'] ?? '-', 0, 50) . '...' : ($row['catatan'] ?? '-') ?></td>
                        <td>
                            <?php 
                            $status = $row['status_pengajuan'] ?? 1;
                            if ($status == 1): 
                                $badge_class = 'bg-warning';
                                $status_text = 'Menunggu Approval Accounting';
                            elseif ($status == 2): 
                                $badge_class = 'bg-info';
                                $status_text = 'Menunggu Approval Direktur';
                            elseif ($status == 3): 
                                $badge_class = 'bg-success';
                                $status_text = 'Selesai';
                            elseif ($status == 4): 
                                $badge_class = 'bg-danger';
                                $status_text = 'Revisi Accounting';
                            else: 
                                $badge_class = 'bg-secondary';
                                $status_text = 'Tidak Diketahui';
                            endif; 
                            ?>
                            <span class="badge <?= $badge_class ?> px-3 py-2" style="font-size: 12px;">
                                <?= $status_text ?>
                            </span>
                        </td>
                        <td class="text-center">
                          <?php if ($status == 1 || $status == 4): ?>
                            <button class="btn btn-warning btn-sm btn-proses" 
                                    data-id="<?= $row['id'] ?>"
                                    data-kode_barang="<?= $row['kode_barang'] ?>"
                                    data-nama_barang="<?= $row['nama_barang'] ?>"
                                    data-harga_barang="<?= $row['harga'] ?? 0 ?>" 
                                    data-harga_pengajuan="<?= $row['harga_pengajuan'] ?? 0 ?>" 
                                    data-kategori="<?= $row['nama_kategori_barang'] ?>"
                                    data-lokasi="<?= $row['lokasi_nama'] ?>"
                                    data-tgl_pengajuan="<?= date('d-m-Y H:i', strtotime($row['tgl_pengajuan'])) ?>"
                                    data-catatan_awal="<?= htmlspecialchars($row['catatan'] ?? '') ?>"
                                    data-status="<?= $status ?>"
                                    data-status_text="<?= $status_text ?>">
                              <i class="fas fa-paper-plane"></i> Proses
                            </button>
                          <?php else: ?>
                            <button class="btn btn-info btn-sm btn-detail" 
                                    data-id="<?= $row['id'] ?>"
                                    data-kode_barang="<?= $row['kode_barang'] ?>"
                                    data-nama_barang="<?= $row['nama_barang'] ?>"
                                    data-kategori="<?= $row['nama_kategori_barang'] ?>"
                                    data-lokasi="<?= $row['lokasi_nama'] ?>"
                                    data-tgl_pengajuan="<?= date('d-m-Y H:i', strtotime($row['tgl_pengajuan'])) ?>"
                                    data-catatan="<?= htmlspecialchars($row['catatan'] ?? '') ?>"
                                    data-status="<?= $status ?>"
                                    data-status_text="<?= $status_text ?>">
                              <i class="fas fa-eye"></i> Detail
                            </button>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong>BPR System</strong>
  </footer>
</div>

<!-- Modal Proses Pengajuan (untuk Accounting) -->
<div class="modal fade" id="modalProses" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fas fa-paper-plane"></i> <span id="modalProsesTitle">Proses Pengajuan</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('manager/proses_pengajuan'); ?>
            <div class="modal-body">
                <input type="hidden" name="id_pengajuan" id="proses_id_pengajuan">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong>Detail Barang:</strong><br>
                            <table width="100%">
                                <tr><td width="30%">Kode Barang</td><td>: <span id="proses_kode_barang">-</span></td></tr>
                                <tr><td>Nama Barang</td><td>: <span id="proses_nama_barang">-</span></td></tr>
                                <tr><td>Harga Barang</td><td>: <span id="proses_harga_barang">-</span></td></tr>
                                <tr><td>Harga Pengajuan Sebelumnya</td><td>: <span id="proses_harga_pengajuan_sebelumnya">-</span></td></tr>
                                <tr><td>Kategori</td><td>: <span id="proses_kategori">-</span></td></tr>
                                <tr><td>Lokasi</td><td>: <span id="proses_lokasi">-</span></td></tr>
                                <tr><td>Tanggal Pengajuan</td><td>: <span id="proses_tgl_pengajuan">-</span></td></tr>
                                <tr><td>Status Saat Ini</td><td>: <span id="proses_status">-</span></td></tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Catatan Awal</label>
                    <textarea id="proses_catatan_awal" class="form-control" rows="3" readonly style="background-color: #f5f5f5;"></textarea>
                </div>

                <div class="form-group">
                    <label>Harga Pengajuan <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="harga_pengajuan" id="proses_harga_pengajuan" class="form-control" placeholder="Masukkan harga pengajuan..." required>
                    </div>
                    <small class="text-muted">Masukkan harga pengajuan dalam format Rupiah (contoh: 1000000 atau 1.000.000)</small>
                </div>

                <div class="form-group">
                    <label>Catatan Accounting <span class="text-danger">*</span></label>
                    <textarea name="catatan_manager" id="proses_catatan_manager" class="form-control" rows="4" placeholder="Masukkan catatan/approval dari Accounting..." required></textarea>
                    <small class="text-muted">Catatan ini akan menggantikan catatan awal setelah diproses</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-check-circle"></i> Setujui & Lanjutkan
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Detail Pengajuan (untuk melihat detail) -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="fas fa-info-circle"></i> Detail Pengajuan</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Kode Barang</th>
                <td id="detailKodeBarang">-</td>
              </tr>
              <tr>
                <th>Nama Barang</th>
                <td id="detailNamaBarang">-</td>
              </tr>
              <tr>
                <th>Kategori</th>
                <td id="detailKategori">-</td>
              </tr>
              <tr>
                <th>Lokasi</th>
                <td id="detailLokasi">-</td>
              </tr>
              <tr>
                <th>Tanggal Pengajuan</th>
                <td id="detailTglPengajuan">-</td>
              </tr>
              <tr>
                <th>Status</th>
                <td id="detailStatus">-</td>
              </tr>
              <tr>
                <th>Catatan</th>
                <td id="detailCatatan">-</td>
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

<!-- scripts -->
<script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    // Inisialisasi DataTable
    var table = $("#tablePengajuan").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "pageLength": 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
      },
      "order": [[5, 'desc']] // Urutkan berdasarkan tanggal pengajuan
    });
    
    table.buttons().container().appendTo('#tablePengajuan_wrapper .col-md-6:eq(0)');
    
    // Filter status
    // Filter status
    $('#filterStatus').on('change', function() {
        var status = $(this).val();
        if (status === "") {
            table.column(7).search('').draw();
        } else if (status === "1") {
            table.column(7).search('Menunggu Approval Accounting').draw();
        } else if (status === "2") {
            table.column(7).search('Menunggu Approval Direktur').draw();
        } else if (status === "3") {
            table.column(7).search('Selesai').draw();
        } else if (status === "4") {
            table.column(7).search('Revisi Accounting').draw();  // Tambahkan ini
        }
    });
    
    // Reset filter
    $('#clearFilter').on('click', function() {
      $('#filterStatus').val('');
      table.column(7).search('').draw();
    });
    
    // Modal Proses (untuk Accounting)
    // Modal Proses (untuk Accounting)
    $('.btn-proses').on('click', function() {
        var button = $(this);
        var status = button.data('status');
        
        $('#proses_id_pengajuan').val(button.data('id'));
        $('#proses_kode_barang').text(button.data('kode_barang') || '-');
        $('#proses_nama_barang').text(button.data('nama_barang') || '-');
        
        var hargaBarang = button.data('harga_barang') || 0;
        $('#proses_harga_barang').text('Rp ' + new Intl.NumberFormat('id-ID').format(hargaBarang));

        // Format harga pengajuan sebelumnya
        var hargaPengajuanSebelumnya = button.data('harga_pengajuan') || 0;
        if (hargaPengajuanSebelumnya > 0) {
            $('#proses_harga_pengajuan_sebelumnya').text('Rp ' + new Intl.NumberFormat('id-ID').format(hargaPengajuanSebelumnya));
        } else {
            $('#proses_harga_pengajuan_sebelumnya').text('-');
        }
        
        $('#proses_kategori').text(button.data('kategori') || '-');
        $('#proses_lokasi').text(button.data('lokasi') || '-');
        $('#proses_tgl_pengajuan').text(button.data('tgl_pengajuan') || '-');
        
        // Tampilkan status yang sesuai
        if (status == 4) {
            $('#proses_status').html('<span class="badge bg-danger">Revisi Accounting</span>');
            $('#modalProsesTitle').text('Proses Revisi Pengajuan');
            $('#proses_catatan_manager').attr('placeholder', 'Masukkan catatan revisi dari Accounting...');
        } else {
            $('#proses_status').html('<span class="badge bg-warning">Menunggu Approval Accounting</span>');
            $('#modalProsesTitle').text('Proses Pengajuan');
            $('#proses_catatan_manager').attr('placeholder', 'Masukkan catatan/approval dari Accounting...');
        }
        
        $('#proses_catatan_awal').val(button.data('catatan_awal') || '-');
        $('#proses_catatan_manager').val('');
        $('#proses_harga_pengajuan').val('');
        
        $('#modalProses').modal('show');
    });
    
    // Modal Detail
    $('.btn-detail').on('click', function() {
      var button = $(this);
      
      $('#detailKodeBarang').text(button.data('kode_barang') || '-');
      $('#detailNamaBarang').text(button.data('nama_barang') || '-');
      $('#detailKategori').text(button.data('kategori') || '-');
      $('#detailLokasi').text(button.data('lokasi') || '-');
      $('#detailTglPengajuan').text(button.data('tgl_pengajuan') || '-');
      $('#detailCatatan').text(button.data('catatan') || '-');
      
      var statusText = button.data('status_text') || 'Tidak Diketahui';
      var statusClass = '';
      if (button.data('status') == 1) statusClass = 'badge-warning';
      else if (button.data('status') == 2) statusClass = 'badge-info';
      else if (button.data('status') == 3) statusClass = 'badge-success';
      else statusClass = 'badge-secondary';
      
      $('#detailStatus').html('<span class="badge ' + statusClass + ' px-3 py-2">' + statusText + '</span>');
      
      $('#modalDetail').modal('show');
    });
  });
</script>

<!-- Notifikasi -->
<script>
<?php if (session()->getFlashdata('sukses')): ?>
  $(document).ready(function() {
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('sukses') ?>', confirmButtonColor: '#3085d6', timer: 3000 });
  });
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  $(document).ready(function() {
    Swal.fire({ icon: 'error', title: 'Gagal!', text: '<?= session()->getFlashdata('error') ?>', confirmButtonColor: '#d33' });
  });
<?php endif; ?>
</script>

</body>
</html>