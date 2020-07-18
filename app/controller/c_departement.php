<?php

namespace App\Controllers;
use App\Database\DatabaseClass;

class C_Departement
{
    public function __construct()
    {
        $this->db = new DatabaseClass();
    }


    public function get()
    {
        return $this->db->select('departement');
    }

    public function delete($id)
    {
        $hapus = $this->db->delete('departement',$id);
        if ($hapus) 
        {
            return 'berhasil';
        }
    }

    public function insert($data)
    {
        $insert = $this->db->insert('departement', $data);
        if($insert)
        {
            return 'berhasil';
        }
    }

    public function get_where($id)
    {
        $get = $this->db->select_where('departement', $id);
        return $get;
    }
}
