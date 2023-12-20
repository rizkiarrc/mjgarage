<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;

class Member extends BaseController
{

    protected $appModel;
    protected $pelanggan_model;
    public function __construct()
    {
        $db = db_connect();
        $this->appModel = new AppModel();
    }

    public function index()
    {
        if ($this->validate([
            'email' => [

                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!'
                ]
            ],
            'password' => [

                'rules' => 'required',
                'errors' => ['required' => 'Password harus diisi!']
            ]
        ]) == FALSE) {
            $data['title'] = 'MJGarage : Member Login';

            return view('pages/login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $db = \Config\Database::connect();

        $post = $this->request->getPost();
        $query = $db->table('users')->getWhere(['email' => $post['email']]);
        $users = $query->getRow();

        if ($users) {
            if (password_verify($post['password'], $users->password)) {
                $data = [
                    'id_user' => $users->id_user,
                    'email' => $users->email,
                    'nama' => $users->nama,
                    'password' => $users->password
                ];
                $validation = \config\Services::validation();

                return redirect()->to('dashboard/belanja')->withInput()->with('validation', $validation);
            } else {
                return redirect()->to('member')->with('error', 'Kata Sandi salah!');
            }
        } else {
            return redirect()->to('member')->with('error', 'Email tidak sesuai!');
        }
    }

    public function register()
    {
        if ($this->validate([
            'nama' => [

                'rules' => 'required',
                'errors' => ['required' => 'Nama harus diisi!']
            ],
            'email' => [

                'rules' => 'required|valid_email|is_unique',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email ini sudah terdaftar'
                ]
            ],
            'alamat' => [

                'rules' => 'required',
                'errors' => ['required' => 'Alamat harus diisi!']
            ],
            'telepon' => [

                'rules' => 'required',
                'errors' => ['required' => 'Alamat harus diisi!']
            ],
            'password1' => [

                'rules' => 'required|min_length[4]|matches[password2]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Password terlalu pendek!',
                    'matches' => 'The Password field does not match the Password field!'
                ]
            ],
            'password2' => [

                'rules' => 'required|matches[password1]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'matches' => 'The Password field does not match the Password field!'
                ]
            ]
        ]) == FALSE) {
            $data['title'] = 'MJGarage : Registration';
            return view('pages/register', $data);
        } else {
            $db = \Config\Database::connect();

            $data = [
                'nama' => htmlspecialchars((string)$this->request->getPost('nama')),
                'email' => htmlspecialchars((string)$this->request->getPost('email')),
                'password' => password_hash((string)$this->request->getPost('password1'), PASSWORD_DEFAULT),
                'alamat' => htmlspecialchars((string)$this->request->getPost('alamat')),
                'telepon' => htmlspecialchars((string)$this->request->getPost('telepon')),
                'tanggal_daftar' => time()
            ];

            $db->table('users')->insert($data);

            session()->setFlashdata(
                'message',
                '<div class="alert alert-success" role="alert">Selamat. Anda berhasil melakukan registrasi. Silahkan login!
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>'
            );

            return redirect()->to('member');
        }
    }

    public function logout()
    {
        session()->remove('id_user');
        session()->remove('name');
        session()->remove('email');
        session()->remove('password');

        session()->setFlashdata(
            'message',
            '<div class="alert alert-success" role="alert">Anda berhasil keluar.
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>'
        );

        return redirect()->to('member');
    }
}
