<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembelian_model extends Model
{
    function konfirmasi($id_user)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->select('*');
        $builder->where('header_transaksi.id_pembelian', $id_user);
        $builder->join('transaksi', 'header_transaksi.id_transaksi = transaksi.id_transaksi');

        $query = $builder->get();

        return $query->getResult();
    }

    function user($id_user)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->select('header_transaksi.*, produk.nama_produk, transaksi.jumlah, transaksi.total_harga');
        $builder->where('header_transaksi.id_user', $id_user);
        $builder->join('transaksi', 'transaksi.id_transaksi = header_transaksi.id_transaksi', 'left');
        $builder->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        $builder->groupBy('header_transaksi.id_transaksi');
        $builder->orderBy('id_transaksi', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function riwayat($id_pelanggan)
    {
        $builder = $this->db->table('transaksi');
        $builder->select('*');
        $builder->where('transaksi.id_user', $id_pelanggan);
        $builder->groupBy('transaksi.id_pembayaran');
        $builder->orderBy('id_pembayaran', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function get_all()
    {
        $builder = $this->db->table('transaksi');
        $builder->select('transaksi.*,users.nama,produk.nama_produk, header_transaksi.status, header_transaksi.telepon');
        $builder->join('users', 'users.id_user = transaksi.id_user', 'left');
        $builder->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        $builder->join('header_transaksi', 'header_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $builder->orderBy('id_transaksi', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function tambah($data)
    {
        $builder = $this->db->table('transaksi');
        $builder->insert($data);
    }

    function tambah_konfirmasi($data)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->insert($data);
    }

    function hapus_pembelian($data)
    {
        $builder = $this->db->table('header_transaksi', 'transaksi');
        $builder->where('id_transaksi', $data['id_tansaksi']);
        $builder->delete($data);
    }

    function update_pembelian($data = null)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->where('id_transaksi', $data['id_transaksi']);
        $builder->update($data);
    }

    function detail($id_transaksi)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->select('*');
        $builder->where('id_transaksi', $id_transaksi);
        $builder->orderBy('id_transaksi', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function get($id_transaksi)
    {
        $builder = $this->db->table('header_transaksi');
        $builder->select('*');
        $builder->where('id_transaksi', $id_transaksi);
        $builder->orderBy('id_transaksi', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function get_pembelian($limit = null, $id_pelanggan = null, $range = null)
    {
        $builder = $this->db->table('users', 'header_transaksi', 'transaksi',);
        $builder->select('*');
        $builder->join('users', 'users.id_user = header_transaksi.id_user');
        $builder->join('transaksi', 'transaksi.id_transaksi = header_transaksi.id_transaksi');

        if ($limit != null) {
            $builder->limit($limit);
        }
        if ($id_pelanggan != null) {
            $builder->where('id_pelanggan', $id_pelanggan);
        }
        if ($range != null) {
            $builder->where('tanggal_transaksi' . ' >=', $range['mulai']);
            $builder->where('tanggal_transaksi' . ' >=', $range['akhir']);
        }

        $builder->orderBy('id_pembelian', 'desc');

        return $builder->get('header_transaksi')->getResultArray();
    }

    function transaksi()
    {
        $builder = $this->db->table('transaksi', 'users', 'produk', 'header_transaksi');
        $builder->select('transaksi.*,users.nama,produk.nama_produk, header_transaksi.status, header_transaksi.telepon');
        $builder->where('status', 'konfirmasi');
        $builder->join('users', 'users.id_user = transaksi.id_user', 'left');
        $builder->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        $builder->join('header_transaksi', 'header_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $builder->orderBy('id_transaksi', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }
}
