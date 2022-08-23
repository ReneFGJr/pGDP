<?php

namespace App\Models\PGCD;

use CodeIgniter\Model;

class PlansCollaborationsInstitutions extends Model
{
	protected $DBGroup              = 'pgcd';
	protected $table                = 'plan_form_institution';
	protected $primaryKey           = 'id_pfi';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_pfi', 'pfi_nr', 'pfi_emailidentify',
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
		$sx = '';
		$data['id_p'] = $id;
		$sx .= view('PGCD/Pages/Plans/plans_20_colaborations_invitation', $data);
		return $sx;
	}

	function list($id)
	{
		$dt = $this
			->where('pfi_nr', $id)
			->orderby('pfi_order')
			->findAll();

		$sx = '<table class="table pgcd_table" style="border: 1px solid #000;">';
		$sx .= '<tr class="pgcd_table_th">';
		$sx .= '<th class="pgcd_table_th" width="5%">' . lang('ma_dmp.order') . '</th>';
		$sx .= '<th class="pgcd_table_th" width="95%">' . lang('ma_dmp.institution') . '</th>';
		$sx .= '</tr>';

		for ($r = 0; $r < count($dt); $r++) {
		}
		if (count($dt) == 0) {
			$sx .= '<tr><td colspan=6">' . lang('ma_dmp.collaboration_not_locate') . '</td></tr>' . cr();
		}
		$sx .= '</table>';

		return $sx;
	}
}