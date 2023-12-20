<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan_model extends Model
{
    function get_all()
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->orderBy('id_user', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function sudah_login($email = null, $nama = null)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('email', $email);
        $builder->where('nama', $nama);
        $builder->orderBy('id_user', 'desc');

        $query = $builder->get();

        return $query->getRow();
    }

    function get($id_user)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('id_user', $id_user);
        $builder->orderBy('id_user', 'desc');

        $query = $builder->get();

        return $query->getResult();
    }

    function hapus($data)
    {
        $builder = $this->db->table('users');
        $builder->where('id_user', $data['id_user']);
        $builder->delete($data);
    }
}
