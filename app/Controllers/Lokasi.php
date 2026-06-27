<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

use App\Controllers\BaseController;

class Lokasi extends BaseController
{
    protected $ModelLokasi;

    public function __construct()
    {
        helper('form');
        $this->ModelLokasi = new ModelLokasi();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Lokasi',
            'd' => $this->ModelLokasi->allData(),
        ];
        return view('lokasi/v_index', $data);
    }

    public function add()
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
            'leader' => [
                'label' => 'Leader',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!',
                ]
            ],
        ])) {
            //if valid
            $data = [
                'nama' => $this->request->getPost('nama'),
                'leader' => $this->request->getPost('leader'),
            ];
            $this->ModelLokasi->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('lokasi'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('lokasi'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Lokasi',
            'data' => $this->ModelLokasi->allData(),
            'd' => $this->ModelLokasi->detailData($id)
        ];
        return view('lokasi/v_edit', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'nama' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
            'leader' => [
                'label' => 'Leader',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ],
        ])) {
            $data = array(
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'leader' => $this->request->getPost('leader'),
            );
            $this->ModelLokasi->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to(base_url('lokasi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('lokasi/edit/' . $id));
        }
    }

    public function delete($id)
    {
        $data = [
            'id' => $id,
        ];
        $this->ModelLokasi->deleteData($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('lokasi'));
    }

}
