<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;

use function PHPUnit\Framework\stringContains;

$session = \Config\Services::session($config);
$validation = \Config\Services::validation();

class Auth extends BaseController
{
    protected $appModel;

    public function __construct()
    {
        $db = db_connect();
    }

    public function index()
    {
        if (session()->get('email')) {
            return redirect()->to('admin/dashboard');
        }

        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        $validationMessages = [
            'email' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!'
            ],
            'password' => [
                'required' => 'Password harus diisi!'
            ]
        ];

        $this->validate($validationRules, $validationMessages);

        if ($this->validator->withRequest($this->request)->run() === FALSE) {
            $data['title'] = 'MJGarage : Admin Login';
            return view('admin/nav_admin', $data);
            return view('admin/login', $data);
            return view('admin/foot_admin', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $db = \Config\Database::connect();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $db->table('admin')->where('email', $email)->get()->getRowArray();

        if ($admin) {
            if (password_verify((string)$password, $admin['password'])) {
                $data = [
                    'email' => $admin['email'],
                    'password' => $admin['password']
                ];

                session()->set($data);

                return redirect()->to('admin/dashboard');
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi salah!</div>');
                return redirect()->to('auth');
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
            return redirect()->to('auth');
        }
    }

    public function register()
    {
        if (session()->get('email')) {
            return redirect()->to('admin/dashboard');
        }

        $validationRules = [
            'nama' => 'required|trim',
            'email' => 'required|trim|valid_email|is_unique[admin.email]',
            'password1' => 'required|trim|min_length[4]|matches[password2]',
            'password2' => 'required|trim|matches[password1]'
        ];

        $validationMessages = [
            'nama' => [
                'required' => 'Nama harus diisi!'
            ],
            'email' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
                'is_unique' => 'Email ini sudah terdaftar!'
            ],
            'password1' => [
                'min_length' => 'Password terlalu pendek!',
                'matches' => 'Password tidak sama!'
            ],
            'password2' => [
                'matches' => 'Password tidak sama!'
            ]
        ];

        $this->validate($validationRules, $validationMessages);

        if ($this->validator->withRequest($this->request)->run() === FALSE) {
            $data['title'] = 'Admin Register';
            return view('admin/nav_admin', $data);
            return view('admin/login', $data);
            return view('admin/foot_admin', $data);
        } else {
            $db = \Config\Database::connect();
            $data = [
                'nama' => htmlspecialchars((string)$this->request->getPost('nama', TRUE)),
                'email' => htmlspecialchars((string)$this->request->getPost('email', TRUE)),
                'password' => password_hash((string)$this->request->getPost('password1'), PASSWORD_DEFAULT),
                'tanggal_daftar' => time()
            ];
            $db->table('admin')->insert($data);

            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Selamat! Anda berhasil daftar. Silahkan Login!</div>');
            return redirect()->to('auth');
        }
    }

    public function logout()
    {
        session()->remove(['email', 'password']);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');

        return redirect()->to('auth');
    }
}
