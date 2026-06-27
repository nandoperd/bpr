# BPR System

## Config

App.php -> Setting $baseURL

Constants.php -> //setting jika nanti sistem ditaruh di website
$base = isset($_SERVER['HTTPS']) ? "https://" : "http://" . $_SERVER['HTTP_HOST'] .
    str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

Database.php -> Setting database dan koneksi

Filters.php -> Setting hak akses menu role

Routes.php -> Setting route (Auto)

## Auth

Auth -> ModelAuth -> views/home

db auth dibuat terpisah 3 tabel : admin, manager, direktur

Untuk membuat password hash pakai file public/hash.php dan buat passwordnya lalu buka [http://localhost/bpr/public/hash.php]
Username Existing : Admin, Accounting, Direktur

## Admin

Admin melakukan input data lokasi, kategori, dan barang

Map Data Lokasi : tabel data_lokasi, Lokasi -> ModelLokasi -> views/lokasi
Map Data Kategori : tabel data_kategori, Kategori -> ModelKategori -> views/kategori

Map Data Barang : tabel data_barang, Barang -> ModelBarang -> views/barang
Logic di tabel data_barang : 
- status (flag untuk barang yang belum diproses datamining(1), sudah diproses datamining(2), diajukan pengajuan(3), approved accounting(4), selesai pengajuan(5))
pada status tsb, 1 dan 2 masih bisa melakukan edit, hapus, dan proses datamining pada barang, sisanya tidak bisa karena sudah masuk ke pengajuan
- kondisi (1 : Perlu perbaikan, 2 : Baik, 3 : Sangat Baik) didapat dari proses datamining


## Data Mining

Inti dari program ini ada pada proses ini, logicnya adalah :
pada data barang yang sudah diinput, dilakukan proses datamining dengan rumus : 
nilai_barang - waktu tgl_brg_masuk dihitung sampai waktu saat ini, tiap tahun berkurang 5 -> hasilnya adalah skor
efeknya : 
- status update jadi 2 (Sudah diproses datamining)
- kondisi diupdate dengan ketentuan berikut ->  skor : 1-69 : Perlu perbaikan, 70-85 : Baik, 86-100 : Sangat Baik

## Pengajuan

Setelah proses datamining pada tiap barang, maka akan mendapatkan barang yang sesuai dengan kriteria pengajuan yaitu jika skor barang 1-69
pada barang denga skor tersebut dapat melakukan pengajuan barang di dalam button detail

## Alur Pengajuan

Flag pada alur pengajuan ada pada kolom status_pengajuan di tabel data_pengajuan dengan ketentuan :
1 : Menunggu approval Accounting, 2 : Menunggu approval direktur, 3 : Selesai 4. Revise to Accounting	

1. Admin melakukan pengajuan barang dengan mengisi catatan -> status_pengajuan update jadi 1
2. Accounting menerima pengajuan barang kemudian mengupdate catatan dan mengisi harga pengajuan barang, lalu melanjutkan pengajuan ke Direktur -> status_pengajuan update jadi 2
3. Direktur menerima pengajuan barang kemudian dapat melakuakan approval atau penolakan pengajuan barang. Jika ditolak, kembali ke step no.2 dan status_pengajuan update jadi 4, jika disetujui maka barang berhasil selesai proses pengajuan dengan efek :
- status_pengajuan update jadi 3
- update status pada tabel data barang menjadi 5 (Selesai diajukan)	
