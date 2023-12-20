<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\AppModel;
use App\Models\Pelanggan_model;
use App\Models\Pembelian_model;
use App\Models\Produk_model;
use App\Helpers\tanggal_indo_helper;

class Keranjang extends BaseController
{
    protected $appModel;
    protected $produk_model;
    protected $pelanggan_model;
    protected $pembelian_model;

    public function __construct()
    {
        $db = db_connect();
        $this->appModel = new AppModel();
        $this->produk_model = new Produk_model();
        $this->pelanggan_model = new Pelanggan_model();
        $this->pembelian_model = new Pembelian_model();

        helper('tanggal_indo_helper');
    }

    public function index()
    {
        $cart = \Config\Services::cart();

        $data['keranjang'] = $cart->contents();

        return view('templates/navbar', $data);
        return view('member/keranjang', $data);
        return view('templates/footer');
    }

    public function sukses()
    {
        $pembelian = $this->pembelian_model->transaksi();
        $data = array(
            'title' => 'Belanja Berhasil',
            'pembelian' => $pembelian
        );
        return view('templates/navbar', $data);
        return view('member/sukses', $data);
        return view('templates/footer');
    }

    public function berhasil()
    {
        $data['title'] = 'Konfirmasi Berhasil';
        return view('templates/navbar', $data);
        return view('member/berhasil', $data);
        return view('templates/footer');
    }

    public function checkout()
    {
        $cart = \Config\Services::cart();

        if (session()->get('email')) {
            session()->setFlashdata(
                'message',
                '<div class="alert alert-success" role="alert">Silahkan Login terlebih dahulu!</div>'
            );
            return redirect('member');
        }

        if (!$cart->contents()) {
            session()->setFlashdata(
                'message',
                '<div class="alert alert-success" role="alert">Silahkan Login terlebih dahulu!</div>'
            );
            return redirect('index');
        }

        if (session()->get('email')) {
            $email = session()->get('email');
            $nama = session()->get('nama');
            $pelanggan = $this->pelanggan_model->sudah_login($email, $nama);
            $keranjang = $cart->contents();

            $validationRules = [
                'nama' => 'required|trim',
                'email' => 'required|trim|valid_email',
                'alamat' => 'required|trim',
                'telepon' => 'required|trim'
            ];

            $validationMessages = [
                'nama' => [
                    'required' => 'Nama harus diisi!'
                ],
                'email' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!'
                ],
                'alamat' => [
                    'required' => 'Alamat harus diisi!'
                ],
                'telepon' => [
                    'required' => 'Telepon harus diisi!'
                ]
            ];

            if ($this->validate([
                'nama' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama harus diisi!']
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'vaild_email' => 'Email tidak valid!'
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => 'Alamat harus diisi!']
                ],
                'telepon' => [
                    'label' => 'Telepon',
                    'rules' => 'required',
                    'errors' => ['required' => 'Nomor telepon harus diisi!']
                ]
            ])) {
                $data = array(
                    'tittle' => 'Checkout : MJGarage',
                    'pelanggan' => $pelanggan,
                    'keranjang' => $keranjang
                );

                return view('member/checkout', $data);
            } else {
                $data = [
                    'id_user' => $pelanggan->id_user,
                    'id_transaksi' => (string)$this->request->getPost('id_transaksi'),
                    'nama' => (string)$this->request->getPost('nama'),
                    'status' => 'Belum Konfirmasi',
                    'email' => (string)$this->request->getPost('email'),
                    'telepon' => (string)$this->request->getPost('telepon'),
                    'alamat' => (string)$this->request->getPost('alamat'),
                    'tanggal_transaksi' => (string)$this->request->getPost('tanggal_transaksi')
                ];
                $this->pembelian_model->tambah_konfirmasi($data);

                foreach ($keranjang as $keranjang) {
                    $subtotal = $keranjang['price'] * $keranjang['qty'];

                    $data = [
                        'id_user' => $pelanggan->id_user,
                        'id_transaksi' => (string)$this->request->getPost('id_transaksi'),
                        'id_produk' => $keranjang['id'],
                        'harga' => $keranjang['price'],
                        'jumlah' => $keranjang['qty'],
                        'total_harga' => $subtotal,
                        'tanggal_transaksi' => (string)$this->request->getPost('tanggal_transaksi')
                    ];
                    $this->pembelian_model->tambah($data);
                }

                $cart->destroy();
                session()->setFlashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Belanja Berhasil. Silahkan konfirmasi pembayaran agar bisa segera kami proses.
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>'
                );

                return redirect()->to(base_url('keranjang/sukses'), 'refresh');
            }
        }
    }

    public function add()
    {
        $cart = \Config\Services::cart();

        $id = (string)$this->request->getPost('id');
        $qty = (string)$this->request->getPost('qty');
        $price = (string)$this->request->getPost('price');
        $name = (string)$this->request->getPost('name');
        $redirect_page = (string)$this->request->getPost('redirect_page');

        $data = array(
            'id' => $id,
            'qty' => $qty,
            'price' => $price,
            'name' => $name
        );
        $cart->insert($data);

        return redirect()->to($redirect_page, 'refresh');
    }

    public function update_cart($rowid)
    {
        $cart = \Config\Services::cart();

        if ($rowid) {
            $data = [
                'rowid' => $rowid,
                'qty' => (string)$this->request->getPost('qty')
            ];

            $cart->update($data);

            session()->setFlashdata(
                'message',
                '<div class="alert alert-warning m-t-10" role="alert">Belanja berhasil diupdate.
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>'
            );
            return redirect()->to(base_url('keranjang'), 'refresh');
        } else {
            return redirect()->to(base_url('keranjang'), 'refresh');
        }
    }

    public function hapus($rowid)
    {
        $cart = \Config\Services::cart();

        if ($rowid) {
            $cart->remove($rowid);
            session()->setFlashdata(
                'message',
                '<div class="alert alert-warning m-t-10" role="alert">Keranjang belanja berhasil dihapus.
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>'
            );
            return redirect()->to(base_url('keranjang'), 'refresh');
        }
    }

    public function hapus_keranjang()
    {
        $cart = \Config\Services::cart();

        $cart->destroy();
        session()->setFlashdata(
            'message',
            '<div class="alert alert-warning m-t-10" role="alert">Keranjang belanja berhasil dihapus.
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>'
        );
        return redirect()->to(base_url('keranjang'), 'refresh');
    }
}
