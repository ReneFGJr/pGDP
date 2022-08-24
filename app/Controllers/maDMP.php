<?php

namespace App\Controllers;

use App\Controllers\BaseController;

$this->session = \Config\Services::session();
$language = \Config\Services::language();

helper(['boostrap', 'url', 'sisdoc_forms', 'form', 'nbr', 'sessions', 'cookie']);
$session = \Config\Services::session();

define("URL", getenv("app.baseURL"));
define("PATH", getenv("app.baseURL"). getenv("app.prefix"));
define("MODULE", '');
define("PREFIX", '');
define("COLLECTION", '/maDMP');

class maDMP extends BaseController
{
    public function index($act = '', $subact = '', $id = '',$id2='')
    {
        $data = array();
        $DMP = new \App\Models\dmp\Index();
        $sx = $DMP->index($act,$subact,$id,$id2);
        return $sx;
    }
}