<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk_model extends Model
{
    protected $table = 'produk';

    function get_all()
    {
        $builder = $this->db->table('produk');
        $builder->select('produk.*, kategori.nama_kategori, kategori.url');
        $builder->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $builder->orderBy('id_produk', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function read($url)
    {
        $builder = $this->db->table('kategori k');
        $builder->select('k.*, p.nama_produk, p.gambar, p.harga, p.id_produk, p.kode_produk');
        $builder->join('produk p', 'p.id_kategori = k.id_kategori', 'left');
        $builder->where('k.url', $url);
        $builder->orderBy('p.id_produk', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function listing_kategori()
    {
        $builder = $this->db->table('produk p');
        $builder->select('p.*, k.nama_kategori, k.url');
        $builder->join('kategori k', 'k.id_kategori = p.id_kategori', 'left');
        $builder->groupBy('p.id_kategori');
        $builder->orderBy('p.id_produk', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function tambah($data)
    {
        $builder = $this->db->table('produk');

        $builder->insert($data);
    }

    function update_produk($data)
    {
        $builder = $this->db->table('produk');
        $builder->where('id_produk', $data['id_produk']);

        return $builder->update($data);
    }

    public function detail($kode_produk)
    {
        $builder = $this->db->table('produk p');
        $builder->select('p.*, k.url');
        $builder->join('kategori k', 'k.id_kategori = p.id_kategori', 'left');
        $builder->where('kode_produk', $kode_produk);
        $builder->orderBy('p.kode_produk', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    public function getbyid($id_produk)
    {
        $builder = $this->db->table('produk');
        $builder->select('*');
        $builder->where('id_produk', $id_produk);
        $builder->orderBy('id_produk', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    public function get($id_produk)
    {
        $builder = $this->db->table('produk');
        $builder->select('*');
        $builder->where('id_produk', $id_produk);
        $builder->orderBy('id_produk', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    public function getMax($table, $field, $kode = null)
    {
        $builder = $this->db->table($table);
        $builder->selectMax($field);

        if ($kode != null) {
            $builder->like($field, $kode, 'after');
        }

        $result = $builder->get()->getRowArray();

        return $result[$field];
    }

    function hapus($data)
    {
        $builder = $this->db->table('produk');
        $builder->where('id_produk', $data['id_produk']);
        $builder->delete('produk', $data);
    }

    function nav_produk()
    {
        $builder = $this->db->table('produk p');
        $builder->select('p.*, k.nama_kategori, k.url');
        $builder->join('kategori k', 'k.id_kategori = p.id_kategori', 'left');
        $builder->groupBy('p.id_kategori');
        $builder->orderBy('k.urutan', 'asc');

        $query = $builder->get();

        return $query->getResult();
    }

    public function getProduk($limit = null, $id_produk = null, $range = null)
    {
        $builder = $this->db->table('produk');
        $builder->select('*');

        if ($limit != null) {
            $builder->limit($limit);
        }
        if ($id_produk != null) {
            $builder->where('id_produk', $id_produk);
        }
        if ($range != null) {
            $builder->where('tanggal_daftar' . ' >=', $range['mulai']);
            $builder->where('tanggal_daftar' . ' >=', $range['akhir']);
        }

        $builder->orderBy('id_produk', 'desc');

        return $builder->get('produk')->getResultArray();
    }

    function total_produk()
    {
        $builder = $this->db->table('produk');
        $builder->select('count(*)');
        $builder->where('produk', 'id_produk');

        $query = $builder->get();

        return $query->getRow();
    }

    public function get_keyword($keyword)
    {
        $builder = $this->db->table('produk');
        $builder->select('*');
        $builder->like('nama_produk', $keyword);

        return $builder->get()->getResult();
    }
}
