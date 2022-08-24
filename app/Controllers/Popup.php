<?php

namespace App\Controllers;

use App\Controllers\BaseController;

$this->session = \Config\Services::session();
$language = \Config\Services::language();

helper(['boostrap', 'url', 'sisdoc_forms', 'form', 'nbr', 'sessions', 'cookie']);
$session = \Config\Services::session();

define("URL", getenv("app.baseURL"));
define("PATH", getenv("app.baseURL") . getenv("app.prefix"));
define("MODULE", '');
define("PREFIX", '');
define("COLLECTION", '/maDMP');

class Popup extends BaseController
{
    public function index($act ='', $id = '',$id2='',$id3='')
    {
        $data['page_title'] = 'Brapci - POPUP - ' . ucfirst($act);
        $data['bg'] = 'bg-pq';
        $sx = '';
        $sx = view('dmp/headers/header',$data);
        echo h($act);

        switch ($act) {
            case 'tips':
                $PlanTips = new \App\Models\dmp\Admin\PlanTips();
                echo '===>'.$id;
                $sx .= $PlanTips->index($id,$id2,$id3);
                break;
            case 'lattesextrator':
                $LattesExtrator = new \App\Models\LattesExtrator\Index();
                $LattesExtrator->harvesting();
                $sx = wclose();
                break;
            case 'pq_bolsista_edit':
                $Bolsistas = new \App\Models\PQ\Bolsistas();
                $id = get('id');
                $sx .= $Bolsistas->edit($id);
                break;

            case 'pq_bolsa_edit':
                $Bolsas = new \App\Models\PQ\Bolsas();
                $id = get('id');
                $sx .= $Bolsas->edit($id);
                break;

            case 'pq_bolsa_delete':
                $Bolsas = new \App\Models\PQ\Bolsas();
                $id = get('id');
                $Bolsas->delete($id);
                $sx = wclose();
                break;
        }
        return $sx;
    }
}