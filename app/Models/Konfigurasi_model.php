<?php

namespace App\Models;

use CodeIgniter\Model;

class Konfigurasi_model extends Model
{
    function get_all()
    {
        $builder = $this->db->table('konfigurasi');
        $builder->select('*');
        $builder->orderBy('id_konfigurasi', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function tambah($data)
    {
        $builder = $this->db->table('konfigurasi');

        $builder->insert($data);
    }

    function update_konfigurasi($data)
    {
        $builder = $this->db->table('konfigurasi');
        $builder->where('id_konfigurasi', $data['id_konfigurasi']);

        return $builder->update($data);
    }

    public function edit($data)
    {
        $builder = $this->db->table('konfigurasi');
        $builder->where('id_konfigurasi', $data['id_konfigurasi']);
        $builder->update($data);
    }

    function detail($id_konfigurasi)
    {
        $builder = $this->db->table('konfigurasi');
        $builder->select('*');
        $builder->where('id_konfigurasi', $id_konfigurasi);
        $builder->orderBy('id_konfigurasi', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function hapus($data)
    {
        $builder = $this->db->table('konfigurasi');
        $builder->where('id_konfigurasi', $data['id_konfigurasi']);
        $builder->delete($data);
    }
}
