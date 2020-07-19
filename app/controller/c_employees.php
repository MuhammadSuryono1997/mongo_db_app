<?php
namespace App\Controllers;
use App\Database\DatabaseClass;

class C_Employess
{
    public function __construct()
    {
        $this->db = new DatabaseClass();
    }

    public function get()
    {
        return $this->db->select('employees');
    }

    public function join()
    {
        $table_from = 'employees';
        $table_ref = 'departement';
        $local_field = 'dept_no';
        $fk_field = 'dept_no';
        $as = 'departement';
        return $this->db->join_table($table_from, $table_ref, $local_field, $fk_field, $as);
    }
    
    public function insert($data)
    {
        $insert = $this->db->insert('employees', $data);
        if($insert)
        {
            return 'berhasil';
        }
    }

    public function update($id, $data)
    {
        $update = $this->db->update('employees', $id, $data);
        if($update)
        {
            return 'berhasil';
        }
    }

    public function delete($id)
    {
        $hapus = $this->db->delete('employees',$id);
        if ($hapus) 
        {
            return 'berhasil';
        }
    }

    public function get_where($id)
    {
        $get = $this->db->select_where('employees', $id);
        if($get)
        {
            return $get;
        }
    }
}


