<?php

namespace App\Controllers;

use App\Models\ModelDirektur;

class Direktur extends BaseController
{    // mendeklarasikan form pada v_login agar bisa berjalan
    public function __construct()
    {
        helper('form');
        $this->ModelDirektur = new ModelDirektur();
    }

    public function index()
    {
        $data = [
            'title' => 'Direktur',
            'jmlLokasi' => $this->ModelDirektur->jmlLokasi(),
            'jmlKategori' => $this->ModelDirektur->jmlKategori(),
            'jmlBarang' => $this->ModelDirektur->jmlBarang(),
            'jmlPengajuan' => $this->ModelDirektur->jmlPengajuan(),
        ];
        return view('direktur/v_index', $data);
    }

    public function lokasi()
    {
        $data = [
            'title' => 'Data Lokasi',
            'lokasiData' => $this->ModelDirektur->getAllLokasi(),
        ];
        return view('direktur/v_lokasi', $data);
    }

    public function kategori()
    {
        $data = [
            'title' => 'Data Kategori Barang',
            'd' => $this->ModelDirektur->getAllKategori()
        ];
        return view('direktur/v_kategori', $data);
    }

    public function barang()
    {
        $data = [
            'title' => 'Data Barang',
            'd' => $this->ModelDirektur->getAllBarang(),
            'kategori' => $this->ModelDirektur->dataKategoriBarang(),
            'lokasi' => $this->ModelDirektur->dataLokasiBarang()
        ];

        return view('direktur/v_barang', $data);
    }

    public function pengajuan()
    {
        $data = [
            'title' => 'Data Pengajuan',
            'd' => $this->ModelDirektur->getAllPengajuan()
        ];
        return view('direktur/v_pengajuan', $data);
    }
    
    public function proses_pengajuan()
    {
        // Validasi
        if ($this->validate([
            'id_pengajuan' => 'required',
            'catatan_direktur' => 'required'
        ])) {
            
            $id_pengajuan = $this->request->getPost('id_pengajuan');
            $catatan_direktur = $this->request->getPost('catatan_direktur');
            
            // Ambil data pengajuan
            $pengajuan = $this->ModelDirektur->getPengajuanById($id_pengajuan);
            
            if (!$pengajuan || $pengajuan['status_pengajuan'] != 2) {
                session()->setFlashdata('error', 'Pengajuan tidak dapat diproses!');
                return redirect()->to(base_url('direktur/pengajuan'));
            }
            
            // Update data pengajuan
            $data_pengajuan = [
                'id_direktur' => session()->get('id_direktur'),
                'tgl_approve_direktur' => date('Y-m-d H:i:s'),
                'tgl_selesai_pengajuan' => date('Y-m-d H:i:s'),
                'catatan' => $catatan_direktur,
                'status_pengajuan' => 3  // 3 = Selesai
            ];
            
            $this->ModelDirektur->updatePengajuan($id_pengajuan, $data_pengajuan);
            
            // Update status barang menjadi 5 (Disetujui Direktur)
            $this->ModelDirektur->updateStatusBarang($pengajuan['id_barang'], 5);
            
            session()->setFlashdata('sukses', 'Pengajuan berhasil diselesaikan! Status diperbarui menjadi "Selesai".');
            return redirect()->to(base_url('direktur/pengajuan'));
            
        } else {
            session()->setFlashdata('error', 'Catatan wajib diisi!');
            return redirect()->to(base_url('direktur/pengajuan'));
        }
    }

    // Method untuk tolak pengajuan
    public function tolak_pengajuan()
    {
        if ($this->validate([
            'id_pengajuan' => 'required',
            'catatan_direktur' => 'required'
        ])) {
            
            $id_pengajuan = $this->request->getPost('id_pengajuan');
            $catatan_direktur = $this->request->getPost('catatan_direktur');
            
            // Ambil data pengajuan
            $pengajuan = $this->ModelDirektur->getPengajuanById($id_pengajuan);
            
            if (!$pengajuan || $pengajuan['status_pengajuan'] != 2) {
                session()->setFlashdata('error', 'Pengajuan tidak dapat ditolak!');
                return redirect()->to(base_url('direktur/pengajuan'));
            }
            
            // Update data pengajuan - status menjadi 4 (Revise to Accounting)
            $data_pengajuan = [
                'id_direktur' => session()->get('id_direktur'),
                'catatan' => $catatan_direktur,
                'status_pengajuan' => 4  // 4 = Revise to Accounting
            ];
            
            $this->ModelDirektur->tolakPengajuan($id_pengajuan, $data_pengajuan);
            
            // Update status barang menjadi 2 (Direvisi)
            $this->ModelDirektur->updateStatusBarang($pengajuan['id_barang'], 2);
            
            session()->setFlashdata('sukses', 'Pengajuan ditolak dan dikembalikan ke Accounting untuk revisi!');
            return redirect()->to(base_url('direktur/pengajuan'));
            
        } else {
            session()->setFlashdata('error', 'Catatan wajib diisi!');
            return redirect()->to(base_url('direktur/pengajuan'));
        }
    }

}