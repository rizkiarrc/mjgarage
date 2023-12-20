<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori_model extends Model
{
    function get_all()
    {
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->orderBy('id_kategori', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function tambah($data)
    {
        $builder = $this->db->table('kategori');
        $builder->insert($data);
    }

    function update_kategori($data)
    {
        $builder = $this->db->table('kategori');
        $builder->where('id_kategori', $data['id_kategori']);

        return $builder->update($data);
    }

    function detail($id_kategori)
    {
        $builder = $this->db->table('kategori');
        $builder->select('*');
        $builder->where('id_kategori', $id_kategori);
        $builder->orderBy('id_kategori', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function hapus($data)
    {
        $builder = $this->db->table('kategori');
        $builder->where('id_kategori', $data['id_kategori']);
        $builder->delete($data);
    }
}
