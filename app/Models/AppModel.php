<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{

    function get_all($table)
    {
        $builder = $this->db->table($table);

        return $builder->get();
    }

    public function tambah($table, $data)
    {
        $builder = $this->db->table($table);

        $builder->insert($data);
    }

    public function sudah_login($email = null, $nama = null)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('email', $email);
        $builder->where('nama', $nama);
        $builder->orderBy('id_user', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function get_where($table, $where = null)
    {
        $builder = $this->db->table($table);
        $builder->where($where);

        return $builder->get();
    }

    function detail($id_produk)
    {
        $builder = $this->db->table('produk');
        $builder->select('*');
        $builder->where('id_produk', $id_produk);
        $builder->orderBy('id_produk', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function update_produk($where, $table, $data)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->update($data);
    }

    function hapus_produk($where, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->delete($table);
    }
}
