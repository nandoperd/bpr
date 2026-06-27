<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Auth extends BaseController
{
    // mendeklarasikan form pada v_login agar bisa berjalan
    public function __construct()
    {
        helper('form');
        $this->ModelAuth = new ModelAuth();
    }

    public function index()
    {
        return view('home');
    }

    // cek login 
    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi!'
                ]
            ]
        ])) {
            //jika valid
            $level = $this->request->getPost('level');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($level == 1) {
                $cek_user = $this->ModelAuth->login_user($username, $password);
                if ($cek_user) {
                    session()->set('id_admin', $cek_user['id']);
                    session()->set('username', $cek_user['username']);
                    session()->set('level', $level);
                    return redirect()->to(base_url('admin'));
                }
            } elseif ($level == 2) {
                $cek_manager = $this->ModelAuth->login_manager($username, $password);
                if ($cek_manager) {
                    session()->set('id_manager', $cek_manager['id']);
                    session()->set('username', $cek_manager['username']);
                    session()->set('level', $level);
                    return redirect()->to(base_url('manager'));
                }
            } elseif ($level == 3) {
                $cek_direktur = $this->ModelAuth->login_direktur($username, $password);
                if ($cek_direktur) {
                    session()->set('id_manager', $cek_direktur['id']);
                    session()->set('username', $cek_direktur['username']);
                    session()->set('level', $level);
                    return redirect()->to(base_url('direktur'));
                }
            }

            // Jika tidak ada user yang ditemukan
            session()->setFlashdata('pesan', 'Login gagal, Username atau Password tidak sesuai');
            return redirect()->to(base_url('auth'));
        } else {
            //errors notification
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('level');
        session()->setFlashdata('sukses', 'Logout berhasil');
        return redirect()->to(base_url('auth'));
    }
}
