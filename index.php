<?php
require __DIR__.'/vendor/autoload.php';
use App\Controllers\C_Departement;
$dept = new C_Departement();
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
}
require __DIR__.'/app/view/'.$main;




