<?php

namespace App\Controllers;

use App\Models\ModelKategori;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    protected $ModelKategori;

    public function __construct()
    {
        helper('form');
        $this->ModelKategori = new ModelKategori();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori Barang',
            'd' => $this->ModelKategori->allData(),
        ];
        return view('kategori/v_index', $data);
    }

    public function add()
    {
        if ($this->validate([
            'nama_kategori_barang' => [
                'label' => 'Nama Kategori Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
        ])) {
            //if valid
            $data = [
                'nama_kategori_barang' => $this->request->getPost('nama_kategori_barang'),
            ];
            $this->ModelKategori->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('kategori'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kategori'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Kategori',
            'data' => $this->ModelKategori->allData(),
            'd' => $this->ModelKategori->detailData($id)
        ];
        return view('kategori/v_edit', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'nama_kategori_barang' => [
                'label' => 'Nama Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
        ])) {
            $data = array(
                'id' => $id,
                'nama_kategori_barang' => $this->request->getPost('nama_kategori_barang'),
            );
            $this->ModelKategori->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('kategori'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kategori/edit/' . $id));
        }
    }

    public function delete($id)
    {
        $data = [
            'id' => $id,
        ];
        $this->ModelKategori->deleteData($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('kategori'));
    }

}
