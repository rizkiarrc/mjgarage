<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;
use App\Models\Produk_model;

class Produk extends BaseController
{

    protected $appModel;
    protected $produkModel;
    public function __construct()
    {
        $db = db_connect();
        $this->appModel = new AppModel();
        $this->produkModel = new Produk_model();
    }

    public function index()
    {
        $produk_listing = $this->produkModel->nav_produk();
        $listing_kategori = $this->produkModel->listing_kategori();
        $data['produk'] = $this->produkModel->get_all();

        $data = array(
            'title' => 'Produk : MJGarage',
            'produk_listing' => $produk_listing,
            'listin_kategori' => $listing_kategori
        );

        return view('member/produk', $data);
    }

    public function detail($kode_produk)
    {
        if ($kode_produk == null) {
            redirect('produk');
        } else {
            $produk = $this->produkModel->detail($kode_produk);
            $listing_kategori = $this->produkModel->listing_kategori();

            $data = array(
                'title' => 'Detail : MJGarage',
                'produk' => $produk,
                'listing_kategori' => $listing_kategori
            );

            return view('member/produk', $data);
        }
    }

    public function kategori($url)
    {
        if ($url == null) {
            redirect('produk');
        } else {
            $perkategori = $this->produkModel->read($url);

            $data = array(
                'title' => 'Kategori :  MJGarage',
                'perkategori' => $perkategori
            );
        }
    }

    // public function search()
    // {
    //     $keyword = $this->input->post('keyword');

    //     $data['produk'] = $this->produkModel->get_keyword($keyword);

    //     return view('templates/navbar', $data);
    //     return view('member/produk', $data);
    //     return view('templates/footer');
    // }
}
