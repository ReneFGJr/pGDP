<?php

namespace App\Models\dmp;

use CodeIgniter\Model;

class PlansCollaborations extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'plan_form_collaboration';
	protected $primaryKey           = 'id_pfc';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_pfc', 'pfc_nr', 'pfc_email',
		'pfc_status', 'pfc_name', 'pfc_actions'
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

	function invitation($id)
		{
			$sx ='';
			$data['id_p'] = $id;
			$sx .= view('dmp/Pages/Plans/plans_20_colaborations_invitation',$data);
			return $sx;
		}

	function list($id)
		{
				$dt = $this
				->where('pfc_nr',$id)
				->orderby('id_pfc')
				->findAll();

				$sx = '<table class="table dmp_table" style="border: 1px solid #000;">';
				$sx .= '<tr class="dmp_table_th">';
				$sx .= '<th class="dmp_table_th" width="5%">'.lang('ma_dmp.order').'</th>';
				$sx .= '<th class="dmp_table_th" width="35%">'.lang('ma_dmp.email').'</th>';
				$sx .= '<th class="dmp_table_th" width="35%">'.lang('ma_dmp.name').'</th>';
				$sx .= '<th class="dmp_table_th" width="20%">'.lang('ma_dmp.status').'</th>';
				$sx .= '<th class="dmp_table_th" width="20%">'.lang('ma_dmp.action').'</th>';
				$sx .= '</tr>';

				for ($r=0;$r < count($dt);$r++)
					{

					}
				if (count($dt) == 0)
					{
						$sx .= '<tr><td colspan=6">'.lang('ma_dmp.collaboration_not_locate').'</td></tr>'.cr();
					}
				$sx .= '</table>';

				return $sx;
		}
}
