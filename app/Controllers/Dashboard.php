<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\Kategori_model;
use App\Models\Pembelian_model;
use App\Models\Rekening_model;

class Dashboard extends BaseController
{

    protected $rekening_model;
    protected $pembelian_model;
    protected $kategori_model;
    function __construct()
    {
        $db = db_connect();
        $this->rekening_model = new Rekening_model();
        $this->pembelian_model = new Pembelian_model();
        $this->kategori_model = new Kategori_model();

        if (isset(session()->get('email'))) {

            redirect('dashboard/belanja');
        } else {

            session()->setFlashdata(
                'message',
                '<div class="alert alert-success" role="alert">Silahkan Login terlebih dahulu!
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>'
            );
            redirect('member');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        return view('member/belanja', $data);
    }

    public function belanja()
    {
        $pelanggan = session()->get('id_user');
        $pembelian = $this->pembelian_model->user($pelanggan);
        $data = array(
            'title' => 'Konfirmasi Pembayaran',
            'pembelian' => $pembelian
        );

        return view('member/belanja', $data);
    }

    public function Konfirmasi($id_transaksi)
    {


        if ($id_transaksi == null) {
            redirect('dashboard/belanja');
        } else {

            $transaksi = $this->pembelian_model->user('header_transaksi', ['id_user' => session()->get('email')]);
            $rekening = $this->rekening_model->get_all();
            $kode = $this->pembelian_model->transaksi();
            $header_transaksi = $this->pembelian_model->get($id_transaksi);
            // validasi input

            if ($this->validate([
                'nama_bank' => [
                    'label' => 'Nama Bank',
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama Bank harus diisi!']
                ],
                'rekening_pembayaran' => [
                    'label' => 'Nomor Rekening',
                    'rules' => 'required',
                    'errors' => ['required' => 'Nomor Rekening harus diisi!']
                ],
                'rekening_pelanggan' => [
                    'label' => 'Nama Pemilik Rekening',
                    'rules' => 'required',
                    'errors' => ['required' => 'Rekening Pemilik harus diisi!']
                ],
                [
                    'bukti_bayar' => [
                        'rules' => 'uploaded'
                    ]
                ]
            ])) {
                if (!empty($_FILES['bukti_bayar']['name'])) {
                    $config['upload_path'] = './public/assets/admin/image';
                    $config['allow_type'] = 'jpg|png|jpeg';
                }
            }
        }
    }
}
