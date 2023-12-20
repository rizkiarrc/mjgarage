<?php

namespace App\Models;

use CodeIgniter\Model;

class Rekening_model extends Model
{
    function get_all()
    {
        $builder = $this->db->table('rekening');
        $builder->select('*');
        $builder->orderBy('id_rekening', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function tambah($data)
    {
        $builder = $this->db->table('rekening');
        $builder->insert($data);
    }

    function update_rekening($data)
    {
        $builder = $this->db->table('rekening');
        $builder->where('id_rekening', $data['id_rekening']);
        $builder->update($data);
    }

    function detail($id_rekening)
    {
        $builder = $this->db->table('rekening');
        $builder->select('*');
        $builder->where('id_rekening', $id_rekening);
        $builder->orderBy('id_rekening', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function hapus($data)
    {
        $builder = $this->db->table('rekening');
        $builder->where('id_rekening', $data['id_rekening']);
        $builder->delete($data);
    }
}
