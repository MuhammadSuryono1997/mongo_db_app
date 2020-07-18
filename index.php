<?php
require __DIR__.'/vendor/autoload.php';
use App\Controllers\C_Departement;
use App\Controllers\C_Employess;

$dept = new C_Departement();
$emp = new C_Employess();
$uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if($uri[1] =="")
{
    $main = "index.php";
    $view = 'dashboard';
}elseif($uri[1]=='index.php')
{
    $main = $uri[1];
}
if (isset($uri[2])) 
{
    $view = 'dashboard';
    $data_dept = $dept->get();
    $data_emp = $emp->join();
}
require __DIR__.'/app/view/'.$main;




