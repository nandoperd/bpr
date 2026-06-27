<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDirektur  extends Model
{
    public function jmlLokasi()
    {
        return $this->db->table('data_lokasi')
            ->countAll();
    }

    public function jmlKategori()
    {
        return $this->db->table('data_kategori_barang')
            ->countAll();
    }

    public function jmlBarang()
    {
        return $this->db->table('data_barang')
            ->countAll();
    }

    public function jmlPengajuan()
    {
        return $this->db->table('data_pengajuan')
        // ->where('kondisi', 2) 
        ->countAllResults();
    }

    public function getAllLokasi()
    {
        return $this->db->table('data_lokasi')->get()->getResultArray();
    }

    public function getAllKategori()
    {
        return $this->db->table('data_kategori_barang')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getAllBarang()
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

    public function dataKategoriBarang()
    {
        return $this->db->table('data_kategori_barang')
            ->select('id, nama_kategori_barang')
            ->orderBy('nama_kategori_barang', 'ASC')
            ->get()->getResultArray();
    }

    public function dataLokasiBarang()
    {
        return $this->db->table('data_lokasi')
            ->select('id, nama')
            ->orderBy('nama', 'ASC')
            ->get()->getResultArray();
    }

    public function getAllPengajuan()
    {
        return $this->db->table('data_pengajuan')
            ->select('data_pengajuan.*, 
                      data_barang.nama_barang, 
                      data_barang.kode_barang,
                      data_barang.harga as harga_barang,
                      data_kategori_barang.nama_kategori_barang,
                      data_lokasi.nama as lokasi_nama')
            ->join('data_barang', 'data_pengajuan.id_barang = data_barang.id', 'left')
            ->join('data_kategori_barang', 'data_pengajuan.id_kategori_barang = data_kategori_barang.id', 'left')
            ->join('data_lokasi', 'data_pengajuan.id_lokasi = data_lokasi.id', 'left')
            ->orderBy('tgl_pengajuan', 'DESC')
            ->get()->getResultArray();
    }

    public function getPengajuanById($id)
    {
        return $this->db->table('data_pengajuan')
            ->select('data_pengajuan.*, 
                      data_barang.nama_barang, 
                      data_barang.kode_barang,
                      data_barang.harga as harga_barang,
                      data_kategori_barang.nama_kategori_barang,
                      data_lokasi.nama as lokasi_nama')
            ->join('data_barang', 'data_pengajuan.id_barang = data_barang.id', 'left')
            ->join('data_kategori_barang', 'data_pengajuan.id_kategori_barang = data_kategori_barang.id', 'left')
            ->join('data_lokasi', 'data_pengajuan.id_lokasi = data_lokasi.id', 'left')
            ->where('data_pengajuan.id', $id)
            ->get()->getRowArray();
    }

    public function updatePengajuan($id, $data)
    {
        return $this->db->table('data_pengajuan')
            ->where('id', $id)
            ->update($data);
    }

    public function updateStatusBarang($id_barang, $status)
    {
        return $this->db->table('data_barang')
            ->where('id', $id_barang)
            ->update(['status' => $status]);
    }

    public function tolakPengajuan($id, $data)
    {
        return $this->db->table('data_pengajuan')
            ->where('id', $id)
            ->update($data);
    }

}
