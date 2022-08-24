<?php

namespace App\Models\Dmp\Admin;

use CodeIgniter\Model;

class Plan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'plan_form';
    protected $primaryKey       = 'id_pf';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pf', 'pf_acronic', 'pf_name',
        'pf_lang', 'pf_active'
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

    function index($d1='',$d2='')
        {
            switch($d1)
                {
                    case 'viewid':
                        $sx = $this->viewid($d2);
                        break;
                    default:
                        $this->path = PATH . '/admin/plans';
                        $this->edit = false;
                        $sx = tableview($this);
                        break;
                }
            return $sx;
        }

    function viewid($id)
        {
            $dt = $this->find($id);
            $sx = '';
            $sx .= bsc(h($dt['pf_name']),12);
            $sx .= bsc($dt['pf_acronic'],12);
            $sx = bs(bsc($sx));

            $sx .= bs(bsc($this->formView($id),12));
            return $sx;
        }

    function formView($id)
        {
            $dt = $this
            ->join('plan_form_fields', 'plf_plan_id = id_pf', 'left')
            ->join('plan_form_section', 'plf_plan_section = id_pfs', 'left')
            ->join('plan_form_fields_tips', 'id_plf = tips_fld_id', 'left')
            ->where('id_pf',$id)
            ->findAll();

            $sx = '<table class="table table-sm table-striped">';
            $xsec = '';
            for($r=0;$r < count($dt);$r++)
                {
                    $line = $dt[$r];
                    $sec = $line['pfs_section_name'];
                    $id_tips = round($line['id_tips']);
                    //pre($line);
                    if ($xsec != $sec)
                        {
                            $sx .= '<tr><th class="h4" colspan=4>'.$sec.'</th></tr>';
                            $xsec = $sec;
                        }
                    $sx .= '<tr>';
                    $sx .= '<td>'.$line['plf_field'].'</td>';
                    $sx .= '<td>' . $line['plf_type'] . '</td>';
                    $sx .= '<td>' . $line['tips_question'] . '</td>';
                    $sx .= '<td>' . $line['plf_ord'] . '</td>';
                    $sx .= '<td>' . $line['plf_mandatory'] . '</td>';
                    $link = '<a href="#" onclick="'.newwin(PATH.'/popup/tips/edit/'.$id_tips.'/'.$line['id_plf']).'">';
                    $linka = '</a>';
                    $sx .= '<td width="1%">'.$link.bsicone('info').$linka.'</td>';
                    $sx .= '<td width="1%">' . bsicone('trash') . '</td>';
                    $sx .= '</tr>';
                }
            $sx .= '</table>';
            return $sx;
        }
}
