<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengajuan  extends Model
{
    protected $table = 'data_pengajuan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_kategori_barang', 
        'id_lokasi', 
        'id_barang', 
        'id_admin', 
        'catatan',
        'status_pengajuan',
    ];

    protected $useTimestamps = true;  // Aktifkan timestamps otomatis
    protected $createdField = 'tgl_pengajuan';  // Field untuk created_at
    protected $updatedField = false;  // Tidak perlu updated_at
    
    public function add($data)
    {
        return $this->insert($data);
    }
    
    public function allData()
    {
        return $this->db->table('data_pengajuan')
            ->select('data_pengajuan.*, 
                      data_barang.nama_barang, 
                      data_barang.kode_barang,
                      data_kategori_barang.nama_kategori_barang,
                      data_lokasi.nama as lokasi_nama')
            ->join('data_barang', 'data_pengajuan.id_barang = data_barang.id', 'left')
            ->join('data_kategori_barang', 'data_pengajuan.id_kategori_barang = data_kategori_barang.id', 'left')
            ->join('data_lokasi', 'data_pengajuan.id_lokasi = data_lokasi.id', 'left')
            ->orderBy('tgl_pengajuan', 'DESC')
            ->get()->getResultArray();
    }
}
