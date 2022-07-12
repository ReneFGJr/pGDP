<?php

namespace App\Models\Base\Admin;

use CodeIgniter\Model;

class Index extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'indices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function index($act = '', $subact = '', $id = '')
    {
        switch ($act) {
            case 'socials':
                $Socials = new \App\Models\Socials();
                $sx = $Socials->index($subact,$id);
                break;

            case 'source':
                $Sources = new \App\Models\Base\Sources();
                switch ($subact) {
                    case 'edit':
                        $sx = $Sources->editar($id);
                        break;
                    default:
                        $sx = $Sources->tableview();
                        break;
                }

                break;
            default:
                $sx = '';
                $user_name = $_SESSION['user'];
                $sx .= h(lang('brapci.Hello').' '.$user_name.' !',2);
                print_r($_SESSION);
                $sx .= h($act, 1);
                $sx .= $this->menu();
                $sx = bs(bsc($sx, 12));
        }
        return $sx;
    }

    function menu()
    {
        $m[PATH .  COLLECTION . '/source'] =  lang('brapci.sources');
        $m[PATH .  COLLECTION . '/socials'] =  lang('brapci.Socials');
        $sx = menu($m);
        return $sx;
    }
}