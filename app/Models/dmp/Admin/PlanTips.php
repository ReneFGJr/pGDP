<?php

namespace App\Models\Dmp\Admin;

use CodeIgniter\Model;

class PlanTips extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'plan_form_fields_tips';
    protected $primaryKey       = 'id_tips';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_tips', 'tips_fld_id', 'tips_question',
        'tips_description',
    ];

    protected $typeFields    = [
        'hidden', 'hidden', 'text',
        'text',
    ];

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

    function index($act='',$id,$id2)
        {
            $sx = $act.'==>'.$id.'--'.$id2;
            if ($id == 0)
                {
                    $dt = $this->where('tips_fld_id', $id2)->findAll();
                    if (count($dt) == 0) {
                        $dd['tips_fld_id'] = $id2;
                        $dd['tips_question'] = 'texto da pergunta';
                        $dd['tips_description'] = 'testo da dica';
                        $this->set($dd)->insert();
                        sleep(1);
                        $dt = $this->where('tips_fld_id', $id2)->findAll();
                        $id = $dt[0]['id_tips'];
                    }
                }
            $idx = $this->id = $id;
            $this->path = PATH.'/popup/tips/';
            $this->path_back = 'wclose';
            $this->id = (int)$idx;
            $this->path = PATH . '/popup/tips';
            $sx .= form($this);

            $sx = bs(bsc($sx,12));
            return $sx;
        }
}
