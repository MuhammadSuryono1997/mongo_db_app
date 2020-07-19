<?php
require __DIR__.'/vendor/autoload.php';
use App\Controllers\C_Departement;
use App\Controllers\C_Employess;

$dept = new C_Departement();
$emp = new C_Employess();

if(isset($_REQUEST['data-edit-depart']))
{
    $id = (object)[
        'dept_no' => $_POST['id']
    ];
    $data = $dept->get_where($id);
    echo json_encode($data);
}

if (isset($_REQUEST['data-edit-employee'])) 
{
    $id = (object)[
        'emp_no' => $_POST['id']
    ];
    $data = $emp->get_where($id);
    echo json_encode($data);
}