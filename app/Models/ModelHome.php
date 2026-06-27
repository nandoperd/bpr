<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHome extends Model
{
    public function add($data)
    {
        $this->db->table('data')->insert($data);
    }
}
