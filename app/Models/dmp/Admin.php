<?php

namespace App\Models\dmp;

use CodeIgniter\Model;

class Admin extends Model
{
	protected $DBGroup              = 'dmp';
	protected $table                = '*';
	protected $primaryKey           = '*';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [

	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];


	function index($act = '', $id = '', $id2='',$id3='')
	{
		$user = 1;
		$data = array();
		$sx = '';
		switch ($act) {
			case 'tips':
				$Plan = new \App\Models\dmp\Admin\PlanTips();
				$sx .= $PlanTips->index($id, $id2, $id3);
				break;

			case 'plans':
				$Plan = new \App\Models\dmp\Admin\Plan();
				$sx .= $Plan->index($id,$id2,$id3);
				break;

			case 'plan_form':
				$PlanForm = new \App\Models\dmp\Admin\PlanForm();
				$sx .= $PlanForm->index($id);
			break;

			case 'plan_form_fields':
				$PlanFormFields = new \App\Models\dmp\Admin\PlanFormFields();
				$sx .= $PlanFormFields->index($id);
				break;

			case 'plan_form_section':
				$PlanFormSection = new \App\Models\dmp\Admin\PlanFormSection();
				$sx .= $PlanFormSection->index($id);
				break;

			default:
				$sx .= h("Admin");
				$sx .= $this->menu($user);
				break;
		}
		$sx = bs(bsc($sx, 12));
		return $sx;
	}

	function menu()
		{
			$menu[URL.'/admin'] = lang('ma_dmp.admin');
			$menu['#PLAN'] = lang('ma_dmp.plans');
			$menu[URL . '/admin/plans'] = lang('ma_dmp.admin.plan');
			$menu[URL . '/admin/plan_form'] = lang('ma_dmp.admin.plan_form');
			$menu[URL . '/admin/plan_form_fields'] = lang('ma_dmp.admin.plan_form_fields');
			$menu[URL . '/admin/plan_form_section'] = lang('ma_dmp.admin.plan_form_section');

			$sx = menu($menu);

			return $sx;
		}

}