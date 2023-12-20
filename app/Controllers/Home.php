<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;

class Home extends BaseController
{
    protected $appModel;
    public function __construct()
    {
        $db = db_connect();
        $this->appModel = new AppModel();
    }

    public function index()
    {
        $data['data'] = $this->appModel->get_all('produk');
        $data['title'] = 'MJGarage';
        return view('pages/index', $data);
    }

    public function profile()
    {
        $data['title'] = 'MJGarage : Detail';
        return view('pages/index/head', $data);
    }
}
