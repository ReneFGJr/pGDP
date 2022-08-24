<?php

namespace App\Models\dmp;

use CodeIgniter\Model;

class Index extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = '*';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

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

	function index($d1='',$d2='',$d3='',$d4='')
		{
			$sx = view('dmp/headers/header');
			$sx .= view('dmp/headers/navbar');
			switch($d1)
				{
					case 'admin':
						$Admin = new \App\Models\dmp\Admin();
						$sx .= $Admin->index($d2, $d3, $d4);
						break;
					case 'myspace':
						$Plans = new \App\Models\dmp\Plans();
						$sx .= $Plans->index();
						break;
					case 'plans':
						$Plans = new \App\Models\dmp\Plans();
						$sx .= $Plans->index($d2,$d3,$d4);
						break;
					default:
						$sx .= view('dmp/welcome');
						$sx .= view('dmp/summary');
				}
			$sx .= view('dmp/headers/footer');
			return $sx;
		}
}
