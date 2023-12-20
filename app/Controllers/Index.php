<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;
use App\Models\Konfigurasi_model;

class Index extends BaseController
{

    protected $appModel;
    protected $konfigurasi_model;
    public function __construct()
    {
        $db = db_connect();
        $this->appModel = new AppModel();
        $this->konfigurasi_model = new Konfigurasi_model();
    }

    public function index()
    {
        $data['data'] = $this->appModel->get_all('produk');
        $data['title'] = 'MJGarage';
        echo view('pages/index', $data);
    }
}
