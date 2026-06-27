<?php

namespace App\Controllers;

use App\Models\ModelPengajuan;
use App\Models\ModelBarang;

use App\Controllers\BaseController;

class Pengajuan extends BaseController
{
    protected $ModelPengajuan;
    protected $ModelBarang;

    public function __construct()
    {
        helper('form');
        $this->ModelPengajuan = new ModelPengajuan();
        $this->ModelBarang = new ModelBarang();
    }

    public function kirim()
    {
        // Validasi
        if ($this->validate([
            'id_barang' => 'required',
            'catatan' => 'required'
        ])) {
            
            // Ambil data barang berdasarkan id_barang
            $id_barang = $this->request->getPost('id_barang');
            $barang = $this->ModelBarang->detailData($id_barang);
            
            // Cek apakah barang ditemukan dan kondisinya 1
            if (!$barang || $barang['kondisi'] != 1) {
                session()->setFlashdata('error', 'Barang tidak dapat diajukan perbaikan!');
                return redirect()->to(base_url('barang'));
            }
            
            // Siapkan data pengajuan
            $data = [
                'id_kategori_barang' => $barang['id_kategori_barang'],
                'id_lokasi' => $barang['id_lokasi'],
                'id_barang' => $id_barang,
                'id_admin' => session()->get('id_admin'),
                'catatan' => $this->request->getPost('catatan'),
                'status_pengajuan' => 1
            ];
            
            // Simpan ke database
            $this->ModelPengajuan->add($data);

            $this->ModelBarang->updateStatus($id_barang, 3);
            
            session()->setFlashdata('sukses', 'Pengajuan berhasil dikirim!');
            return redirect()->to(base_url('barang'));
            
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('barang'));
        }
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data Pengajuan',
            'd' => $this->ModelPengajuan->allData()
        ];
        return view('pengajuan/v_index', $data);
    }
}
