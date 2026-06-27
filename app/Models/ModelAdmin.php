<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin  extends Model
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

}
