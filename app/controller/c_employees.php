<?php
namespace App\Controllers;
use App\Database\DatabaseClass;

class C_Employess
{
    public function __construct()
    {
        $this->db = new DatabaseClass();
    }
}


