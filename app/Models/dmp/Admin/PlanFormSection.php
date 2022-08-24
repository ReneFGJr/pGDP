<?php

namespace App\Models\Dmp\Admin;

use CodeIgniter\Model;
use App\Libraries\GroceryCrud;

class PlanFormSection extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'planformsections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    function index($id = '')
    {
        $crud = new GroceryCrud();
        $crud->setTheme('datatables');

        $crud->setTable('plan_form_section');
        //$crud->setRelationNtoN('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname');
        //$crud->Columns(['plf_plan_id', 'plf_plan_section','plf_field', 'plf_type']);

        //        $crud->setRelationNtoN('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname');
        $output = $crud->render();
        $output->table = 'plan_form_fields';
        return view('crud', (array)$output);
    }
}
