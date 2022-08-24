<?php

namespace App\Models\Dmp\Admin;

use CodeIgniter\Model;
use App\Libraries\GroceryCrud;

class PlanForm extends Model
{
    protected $DBGroup          = 'dmp';
    protected $table            = 'planforms';
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

    function index($id='')
        {
        $crud = new GroceryCrud();
        $crud->setTheme('datatables');
        $crud->setTable('plan_form');
        $output = $crud->render();
        $output->table = 'plan_form';
        return view('crud', (array)$output);
        }
}
