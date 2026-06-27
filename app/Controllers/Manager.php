<?php

namespace App\Controllers;

use App\Models\ModelManager;

class Manager extends BaseController
{    // mendeklarasikan form pada v_login agar bisa berjalan
    public function __construct()
    {
        helper('form');
        $this->ModelManager = new ModelManager();
    }

    public function index()
    {
        $data = [
            'title' => 'Accounting',
            'jmlLokasi' => $this->ModelManager->jmlLokasi(),
            'jmlKategori' => $this->ModelManager->jmlKategori(),
            'jmlBarang' => $this->ModelManager->jmlBarang(),
            'jmlPengajuan' => $this->ModelManager->jmlPengajuan(),
        ];
        return view('manager/v_index', $data);
    }

    public function lokasi()
    {
        $data = [
            'title' => 'Data Lokasi',
            'lokasiData' => $this->ModelManager->getAllLokasi(),
        ];
        return view('manager/v_lokasi', $data);
    }

    public function kategori()
    {
        $data = [
            'title' => 'Data Kategori Barang',
            'd' => $this->ModelManager->getAllKategori()
        ];
        return view('manager/v_kategori', $data);
    }

    public function barang()
    {
        $data = [
            'title' => 'Data Barang',
            'd' => $this->ModelManager->getAllBarang(),
            'kategori' => $this->ModelManager->dataKategoriBarang(),
            'lokasi' => $this->ModelManager->dataLokasiBarang()
        ];

        return view('manager/v_barang', $data);
    }

    public function pengajuan()
    {
        $data = [
            'title' => 'Data Pengajuan',
            'd' => $this->ModelManager->getAllPengajuan()
        ];
        return view('manager/v_pengajuan', $data);
    }

    public function proses_pengajuan()
    {
        // Validasi
        if ($this->validate([
            'id_pengajuan' => 'required',
            'catatan_manager' => 'required',
            'harga_pengajuan' => 'required|numeric|greater_than_equal_to[0]'
        ])) {
            
            $id_pengajuan = $this->request->getPost('id_pengajuan');
            $catatan_manager = $this->request->getPost('catatan_manager');
            $harga_pengajuan = $this->request->getPost('harga_pengajuan');
            
            // Ambil data pengajuan
            $pengajuan = $this->ModelManager->getPengajuanById($id_pengajuan);
            
            if (!$pengajuan || $pengajuan['status_pengajuan'] != 1 && $pengajuan['status_pengajuan'] != 4) {
                session()->setFlashdata('error', 'Pengajuan tidak dapat diproses!');
                return redirect()->to(base_url('manager/pengajuan'));
            }
            
            // Update data pengajuan
            $data_pengajuan = [
                'id_manager' => session()->get('id_manager'),
                'tgl_approve_manager' => date('Y-m-d H:i:s'),
                'catatan' => $catatan_manager,
                'harga_pengajuan' => $harga_pengajuan,
                'status_pengajuan' => 2  // 2 = Menunggu Approval Direktur
            ];
            
            $this->ModelManager->updatePengajuan($id_pengajuan, $data_pengajuan);
            
            // Update status barang menjadi 4 (Disetujui Accounting)
            $this->ModelManager->updateStatusBarang($pengajuan['id_barang'], 4);
            
            session()->setFlashdata('sukses', 'Pengajuan berhasil diproses! Status diperbarui menjadi "Menunggu Approval Direktur".');
            return redirect()->to(base_url('manager/pengajuan'));
            
        } else {
            session()->setFlashdata('error', 'Catatan wajib diisi!');
            return redirect()->to(base_url('manager/pengajuan'));
        }
    }

}