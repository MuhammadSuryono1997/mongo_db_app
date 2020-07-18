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
}


