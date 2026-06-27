<?php

namespace App\Controllers;

use App\Models\ModelBarang;
use DateTime;

use App\Controllers\BaseController;

class Barang extends BaseController
{
    protected $ModelBarang;

    public function __construct()
    {
        helper('form');
        $this->ModelBarang = new ModelBarang();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'd' => $this->ModelBarang->allData(),
            'kategori' => $this->ModelBarang->dataKategori(),
            'lokasi' => $this->ModelBarang->dataLokasi()
        ];

        // Proses kondisi untuk setiap barang
        foreach ($data['d'] as &$row) {
            $row['kondisi_text'] = $this->getKondisiText($row['kondisi']);
            $row['badge_class'] = $this->getBadgeClass($row['kondisi']);
        }

        return view('barang/v_index', $data);
    }

    // Helper function untuk teks kondisi
    private function getKondisiText($kondisi)
    {
        switch ($kondisi) {
            case 1:
                return 'Perlu Perbaikan';
            case 2:
                return 'Baik';
            case 3:
                return 'Sangat Baik';
            default:
                return 'Tidak Diketahui';
        }
    }

    // Helper function untuk badge class
    private function getBadgeClass($kondisi)
    {
        switch ($kondisi) {
            case 1:
                return 'badge-danger';  // Merah
            case 2:
                return 'badge-warning'; // Kuning
            case 3:
                return 'badge-success'; // Hijau
            default:
                return 'badge-secondary';
        }
    }

    public function add()
    {
        if ($this->validate([
            'id_kategori_barang' => [
                'label' => 'Kategori Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
            'id_lokasi' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
            'kode_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'is_image' => '{field} Harus berupa gambar!',
                    'mime_in' => '{field} Harus berupa gambar dengan format jpg, jpeg, gif, atau png!',
                    'max_size' => '{field} Ukuran maksimal 2MB!',
                ]
            ],
        ])) {
            // If valid
            $foto = $this->request->getFile('foto');
            $fotoName = $foto->getRandomName(); // Generate a random name for the file
            $foto->move('foto', $fotoName); // Move the file to the 'foto' directory

            $data = [
                'id_kategori_barang' => $this->request->getPost('id_kategori_barang'),
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'kode_barang' => $this->request->getPost('kode_barang'),
                'harga' => $this->request->getPost('harga'),
                'nilai_barang' => $this->request->getPost('nilai_barang'),
                'status' => $this->request->getPost('status'),
                'kondisi' => $this->request->getPost('kondisi'),
                'tgl_brg_masuk' => $this->request->getPost('tgl_brg_masuk'),
                'foto' => $fotoName, // Save the filename in the database
            ];
            $this->ModelBarang->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('barang'));
        } else {
            // If not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('barang'));
        }
    }

    public function edit($id)
    {
        // Ambil detail data barang
        $detail = $this->ModelBarang->detailData($id);
        
        // Cek apakah data ditemukan
        if (empty($detail)) {
            session()->setFlashdata('pesan', 'Data barang tidak ditemukan');
            return redirect()->to(base_url('barang'));
        }
        
        $data = [
            'title' => 'Edit Data Barang',
            'd' => $detail,
            'kategori' => $this->ModelBarang->dataKategori(),
            'lokasi' => $this->ModelBarang->dataLokasi()
        ];
        return view('barang/v_edit', $data);
    }

    public function update($id)
    {
        // Validasi
        if ($this->validate([
            'id_kategori_barang' => [
                'label' => 'Kategori Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
            'id_lokasi' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
            'kode_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                    'numeric' => '{field} harus berupa angka!'
                ]
            ],
            'nilai_barang' => [
                'label' => 'Nilai Barang',
                'rules' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[100]',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                    'numeric' => '{field} harus berupa angka!',
                    'greater_than_equal_to' => '{field} minimal 1!',
                    'less_than_equal_to' => '{field} maksimal 100!'
                ]
            ],
            'tgl_brg_masuk' => [
                'label' => 'Tanggal Masuk',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                    'valid_date' => '{field} harus format tanggal yang valid!'
                ]
            ]
        ])) {
            
            // Siapkan data untuk update
            $data = [
                'id' => $id,
                'id_kategori_barang' => $this->request->getPost('id_kategori_barang'),
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'kode_barang' => $this->request->getPost('kode_barang'),
                'harga' => $this->request->getPost('harga'),
                'nilai_barang' => $this->request->getPost('nilai_barang'),
                'tgl_brg_masuk' => $this->request->getPost('tgl_brg_masuk')
            ];
            
            // Cek jika ada upload foto baru
            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Hapus foto lama
                $oldData = $this->ModelBarang->detailData($id);
                if ($oldData['foto'] && file_exists('foto/' . $oldData['foto'])) {
                    unlink('foto/' . $oldData['foto']);
                }
                
                // Upload foto baru
                $nama_foto = $foto->getRandomName();
                $foto->move('foto', $nama_foto);
                $data['foto'] = $nama_foto;
            }
            
            $this->ModelBarang->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('barang'));
            
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('barang/edit/' . $id));
        }
    }

    public function delete($id)
    {
        // Ambil data untuk hapus foto
        $data = $this->ModelBarang->detailData($id);
        
        // Hapus foto jika ada
        if ($data['foto'] && file_exists('foto/' . $data['foto'])) {
            unlink('foto/' . $data['foto']);
        }
        
        // Hapus data
        $this->ModelBarang->deleteData(['id' => $id]);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('barang'));
    }

    public function processDataMining($id)
    {
        // Ambil data barang berdasarkan id
        $barang = $this->ModelBarang->getBarangById($id);
        
        if (!$barang) {
            session()->setFlashdata('pesan', 'Data barang tidak ditemukan');
            echo "<script>history.go(-1);</script>";
            exit();
        }
        
        // Hitung skor berdasarkan nilai_barang dan range waktu
        $nilai_barang = $barang['nilai_barang'];
        $tgl_brg_masuk = $barang['tgl_brg_masuk'];
        $tanggal_sekarang = date('Y-m-d');
        
        // Hitung selisih tahun
        $tahun1 = new DateTime($tgl_brg_masuk);
        $tahun2 = new DateTime($tanggal_sekarang);
        $selisih_tahun = $tahun1->diff($tahun2)->y;
        
        // Hitung skor (setiap tahun mengurangi 5 angka)
        $skor = $nilai_barang - ($selisih_tahun * 5);
        
        // Pastikan skor tidak kurang dari 0
        if ($skor < 0) {
            $skor = 0;
        }
        
        // Tentukan kondisi berdasarkan skor
        if ($skor >= 1 && $skor <= 69) {
            $kondisi = 1;
        } elseif ($skor >= 70 && $skor <= 85) {
            $kondisi = 2;
        } elseif ($skor >= 86 && $skor <= 100) {
            $kondisi = 3;
        } else {
            $kondisi = 0;
        }
        
        // Data untuk update
        $data = [
            'id' => $id,
            'status' => 2,
            'skor' => $skor,
            'kondisi' => $kondisi
        ];
        
        // Update data ke database
        $this->ModelBarang->processDataMining($data);
        
        // Simpan data untuk ditampilkan di modal
        $result = [
            'nama_barang' => $barang['nama_barang'],
            'kode_barang' => $barang['kode_barang'],
            'tgl_brg_masuk' => $tgl_brg_masuk,
            'skor' => $skor,
            'kondisi' => $kondisi,
            'selisih_tahun' => $selisih_tahun
        ];

        $result['badge_class'] = $this->getBadgeClass($result['kondisi']);
        $result['kondisi_text'] = $this->getKondisiText($result['kondisi']);
        
        // Kirim data ke view melalui session flashdata
        session()->setFlashdata('mining_result', $result);
        
        // Redirect kembali ke halaman sebelumnya
        echo "<script>
            window.location.href = document.referrer;
        </script>";
        exit();
    }

}
