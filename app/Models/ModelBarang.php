<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang  extends Model
{
    public function allData()
    {
        return $this->db->table('data_barang')
            ->select('data_barang.*, 
                    data_kategori_barang.nama_kategori_barang as kategori_nama,
                    data_lokasi.nama as lokasi_nama')
            ->join('data_kategori_barang', 'data_barang.id_kategori_barang = data_kategori_barang.id', 'left')
            ->join('data_lokasi', 'data_barang.id_lokasi = data_lokasi.id', 'left')
            ->orderBy('data_barang.id', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id)
    {
        return $this->db->table('data_barang')
            ->select('data_barang.*, 
                    data_kategori_barang.nama_kategori_barang as kategori_nama,
                    data_lokasi.nama as lokasi_nama')
            ->join('data_kategori_barang', 'data_barang.id_kategori_barang = data_kategori_barang.id', 'left')
            ->join('data_lokasi', 'data_barang.id_lokasi = data_lokasi.id', 'left')
            ->where('data_barang.id', $id)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('data_barang')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('data_barang')
            ->where('id', $data['id'])->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('data_barang')
            ->where('id', $data['id'])->delete($data);
    }

    public function dataKategori()
    {
        return $this->db->table('data_kategori_barang')
            ->select('id, nama_kategori_barang')
            ->orderBy('nama_kategori_barang', 'ASC')
            ->get()->getResultArray();
    }

    public function dataLokasi()
    {
        return $this->db->table('data_lokasi')
            ->select('id, nama')
            ->orderBy('nama', 'ASC')
            ->get()->getResultArray();
    }

    public function processDataMining($data)
    {
        $update_data = [
            'status' => $data['status'],
            'skor' => $data['skor'],
            'kondisi' => $data['kondisi']
        ];
        
        $this->db->table('data_barang')
            ->where('id', $data['id'])
            ->update($update_data);
    }

    public function getBarangById($id)
    {
        return $this->db->table('data_barang')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function updateStatus($id, $status)
    {
        return $this->db->table('data_barang')
            ->where('id', $id)
            ->update(['status' => $status]);
    }
}
