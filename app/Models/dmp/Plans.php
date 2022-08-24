<?php

namespace App\Models\dmp;

use CodeIgniter\Model;

class Plans extends Model
{
	protected $DBGroup              = 'dmp';
	protected $table                = 'plans';
	protected $primaryKey           = 'id_p';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_p', 'p_title', 'p_lang',
		'p_own', 'p_nr', 'p_version',
		'p_status', 'p_draft', 'p_year'
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

	function plans_list($user = 1)
	{
		$sx = bs(bsc(h(lang('ma_dmp.list_plans'), 4), 12));
		$dt = $this->where('p_own', $user)
			->join('plan_form', 'id_pf = p_form')
			->orderBy('created_at desc')
			->findall();
		$dt['plans'] = $dt;
		$sx .= view('dmp/Pages/Plans/plans_00_list', $dt);
		return $sx;
	}

	function index($act = '', $id = '')
	{
		$user = 1;
		$data = array();
		$sx = '';
		switch ($act) {
			case 'new_api':
				$sx .= $this->new_api();
				break;
			case 'new':
				$sx .= $this->new();
				break;
			case 'view':
				$sx .= $this->view($id);
				break;
			case 'edit':
				$sx .= $this->edit($id);
				break;
			case 'trash':
				$sx .= $this->trash($id);
				break;
			default:
				$sx .= h("list");
				$sx .= $this->plans_list($user);
				$sx .= bs(bsc($this->btn_new_plan().' | '. $this->btn_new_plan_cnpq(),12));
				break;
		}
		return $sx;
	}

	function new_api($typ='cnpq')
		{

		}

	function btn_new_plan()
		{
			$link = PATH.COLLECTION.'/plans/new';
			$sx = '<a href="' . $link . '" class="btn btn-outline-primary disabled">';
			$sx .= lang('ma_dmp.new_plan');
			$sx .= '</a>';
			return $sx;
		}

	function btn_new_plan_cnpq()
	{
		$link = PATH . COLLECTION . '/plans/new_api';
		$disabled = '';
		$sx = '<a href="' . $link . '" class="btn btn-outline-primary '.$disabled.'">';
		$sx .= lang('ma_dmp.new_plan_api');
		$sx .= '</a>';
		return $sx;
	}

	function new()
	{
		$sx = '';
		if ($plan = $this->plan_new_save()) {
			redirect('dmp::index/plans');
		}
		$data['plan_nr'] = lang('ma_dmp.plan_new');
		$sx .= view('dmp/Pages/Plans/plans_00_form_open', $data);
		$sx .= view('dmp/Pages/Plans/plans_01_plan_new', $data);
		$sx .= view('dmp/Pages/Plans/plans_02_id', $data);
		$sx .= view('dmp/Pages/Plans/plans_11_title', $data);
		$sx .= view('dmp/Pages/Plans/plans_10_form', $data);
		$sx .= view('dmp/Pages/Plans/plans_19_submit', $data);
		$sx .= view('dmp/Pages/Plans/plans_99_form_close', $data);
		return $sx;
	}

	function view($id)
	{
		$data = $this->find($id);
		$sx = '';
		$sx .= view('dmp/Pages/Plans/plans_02_id', $data);
		return $sx;
	}

	function trash($id)
	{
		$data = $this->find($id);
		$sx = '';
		$sx .= view('dmp/Pages/Plans/plans_02_id', $data);
		$sx .= view('dmp/Pages/Plans/plans_00_remove');

		return $sx;
	}

	function edit($id)
	{
		$PlansForm = new \App\Models\dmp\PlansForm();
		$tab = round(get("pag"));
		if ($tab < 1) {
			$tab = 1;
		}
		$data = $this->find($id);
		$data['form_id'] = $data['p_form'];
		$data['tabPage'] = $tab;

		$sx = '';
		$sx .= breadcrumbs();

		$sx .= view('dmp/Pages/Plans/plans_02_id', $data);

		$sx .= view('dmp/Pages/Plans/plans_00_tabs');

		/************************************* FORM */
		$sx .= $PlansForm->form($id, $tab);

		return $sx;
	}

	function plan_new_save()
	{
		$user = 1;
		$title = get("pgdc_title");
		$form = get("pgdc_form");
		if (($title != '') and (round($form) > 0)) {
			$dt = $this
				->where('p_title', $title)
				->where('p_own', $user)
				->where('p_draft', 1)
				->findAll();
			if (count($dt) == 0) {
				$dt['p_title'] = $title;
				$dt['p_own'] = $user;
				$dt['p_draft'] = 1;
				$dt['p_form'] = round(get("pgdc_form"));
				$dt['updated_at'] = date("Y-m-d");
				$dt['p_year'] = date("Y");
				$dt['p_nr'] = strzero(1, 6) . '/' . date("y");
				$id = $this->insert($dt);
			} else {
				$id = $dt[0]['id_p'];
			}
			return $id;
		} else {
			return 0;
		}
	}
}