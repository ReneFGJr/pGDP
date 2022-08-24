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

	function create_plan_api($da)
		{
			$projeto = (array)$da['projeto'];
			$abs = $projeto['resumo'];
			$title = $projeto['titulo'];
			$proc = $da['numeroProcesso'];
			$dt['p_title'] = $title;
			$dt['p_own'] = 1;
			$dt['p_nr'] = $proc;
			$dt['p_year'] = substr($da['numeroProcesso'],7,4);
			$dt['p_version'] = 1;
			$dt['p_draft'] = 1;
			$dt['p_status'] = 0;
			$dt['p_form'] = 1;
			$dt['updated_at'] = date("Y-m-d H:i:s");
			$dt['p_persistent_id'] = '';
			$dx = $this->where('p_nr',$proc)->findAll();
			if (count($dx) == 0)
				{
					$id = $this->set($dt)->insert();
					$sx = metarefresh(PATH.MODULE.'/dmp/plans/edit/'.$id);

				}
		}

	function form()
	{
		$erro = '';
		$LattesData = new \App\Models\LattesData\LattesData();
		$proc = '';

		if (isset($_POST['process']) and (strlen($_POST['process']) > 0)) {
			$proc = $_POST['process'];
			$proc = $LattesData->padroniza_processo($proc);


			switch ($proc[1]) {
				case '0':
					$proc = $proc[0];
					break;
				case '2':
					$erro = 'Número do processo inválido - ' . $proc[0];
					$proc = '';
					break;
				default:
					$proc = '';
					break;
			}
		}

		$sx = '
            <div class="border border-1 border-primary" style="width: 100%;">
            <div class="card-body">
              <h1 class="card-title">Depositar</h1>
              <h5 class="card-subtitle mb-2 text-muted">Conjunto de dados (<i>Datasets</i>)</h5>
              <p class="card-text">
              ';
		$sx .= form_open(PATH.COLLECTION.'/plans/new_api');
		//$sx .= '<form method="post" accept-charset="utf-8">';
		$sx .= 'Informe o número do processo no CNPq para iniciar o depósito.';
		$sx .= form_input('process', '', 'class="form-control" placeholder="Número do processo"');
		$sx .= 'Ex: 123456/2022-2 - 20143042677';
		$info = 'O número do processo do CNPQ é composto por seis dígitos, ' . chr(13)
			. ' seguido de um ponto e dois dígitos. Ex: 123456/2022-2 - ' . chr(13)
			. ' O número do processo é disponibilizado em seu termo de outorga.';

		$sx .= ' <span title="' . $info . '" style="cursor: pointer; font-size: 150%">&#x1F6C8;</span><br>';
		$sx .= form_submit('action', 'depositar', 'class="btn btn-primary" style="width: 100%;"');
		$sx .= form_close();
		$sx .= '
              </p>
            </div>
          </div>';

		if ($erro != '') {
			$sx .= '<div class="alert alert-danger" role="alert">' . $erro . '</div>';
		}
		return $sx;
	}

	function Home()
	{
		$sx = '';
		$LattesData = new \App\Models\LattesData\LattesData();
		if (isset($_POST['process']) and (strlen($_POST['process']) > 0)) {
			$proc = $_POST['process'];
			$proc = $LattesData->padroniza_processo($proc);
			jslog("Processo: " . $proc[1]);
			if ($proc[1] != 0) {
				$sx .= $this->welcome();
			} else {
				$url = PATH.COLLECTION.'/plans/new_api';
				$sx .= $LattesData->show_metadate($proc,$url);
			}
		} else {
			$sx .= $this->welcome();
		}
		//$sx .= '20113023806';
		return $sx;
	}

	function welcome()
	{
		$sx = '';
		$sx = h('Crie seu Plano de Gestão de Dados',3);
		$sx .= '<p>Este sistema é integrado com a Plataforma CarlosChagas!</p>';
		$sx .= '<p>Este espaço é destinado para que pesquisadores possam realizar o depósito dos seus conjuntos de dados que tiveram suas pesquisas financiadas totalmente ou parcialmente pelo CNPq.</p>';
		$sx .= '<p>Para iniciar a submissão, preencha o campo à direita da tela com número do processo no CNPq, depois clique em “Depositar”.</p>';
		$sx .= '<p>Após essa etapa inicial, será encaminhado um e-mail confirmando o cadastro do projeto no LattesData. Caso tenha alguma dúvida no acesso ou preenchimento dos metadados, entre em contato com o seguinte e-mail: lattesdata@cnpq.br.</p>';
		$sx .= '<div style="height: 100px"></div>';
		return $sx;
	}

	function new_api($typ='cnpq')
		{
			$Form = new \App\Models\LattesData\Forms();
			$sa = $this->Home();
			$sb = $this->form();

			$sx = bs(bsc($sa,6).bsc($sb,6));
			return $sx;
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
