<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth  extends Model
{
        public function login_user($username, $password)
        {
                // Ambil data user
                $user = $this->db->table('admin')
                ->where('username', $username)
                ->get()
                ->getRowArray();
                
                // Verifikasi password 
                if ($user && password_verify($password, $user['password'])) {
                return $user;
                }
                
                return false;
        }

        public function login_manager($username, $password)
        {

                $user = $this->db->table('manager')
                ->where('username', $username)
                ->get()
                ->getRowArray();
                
                if ($user && password_verify($password, $user['password'])) {
                return $user;
                }
                
                return false;
        }

        public function login_direktur($username, $password)
        {

                $user = $this->db->table('direktur')
                ->where('username', $username)
                ->get()
                ->getRowArray();
                
                if ($user && password_verify($password, $user['password'])) {
                return $user;
                }
                
                return false;
        }
}
