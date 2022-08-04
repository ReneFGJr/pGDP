<?php

namespace App\Models\PGCD;

use CodeIgniter\Model;

class Admin extends Model
{
	protected $DBGroup              = 'pgcd';
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


	function index($act = '', $id = '')
	{
		$user = 1;
		$data = array();
		$sx = '';
		switch ($act) {
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
			$sx = menu($menu);

			return $sx;
		}

}