<?php

namespace App\Models\Authority;

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
	protected $allowedFields        = [
		'', 'authority.url'
	];

	protected $typeFields        = [
		'hidden',
		'url*'
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

	function index($d1, $d2, $d3, $d4)
	{
		//$this->setDatabase('brapci_authority');

		$tela = '';
		switch ($d1) {
			case 'findid':
				$tela .= h(lang('brapci.findid'),3);
				$tela .= $this->findId($d2, $d3);
				$tela .= metarefresh(PATH.'res/authority/viewid/'.$d2.'/');
				break;
			case 'import_lattes':
				$tela .= $this->import_lattes($d2, $d3);
				break;
			case 'resumeCreate':
				$this->resumeCreate();
				break;
			case 'LattesFindId':
				$AuthotityIds = new \App\Models\Authority\AuthotityIds();
				$tela .= $AuthotityIds->LattesFindID($d2);
				break;
			case 'viewid':
				$AuthorityNames = new \App\Models\Authority\AuthorityNames();
				$tela .= $AuthorityNames->viewid($d2);
				break;				
			case 'viewidRDF':
				$this->Person = new \App\Models\Authority\Person();
				$tela .= $this->Person->viewid($d2);
				break;
			case 'list':
				$tela .= $this->tableview();
				break;
			case 'edit':
				$AuthorityNames = new \App\Models\Authority\AuthorityNames();
				$tela .= $AuthorityNames->edit($d2);
				break;				
			case 'import_api_brapci':
				$tela .= $this->import_api_brapci($d2);
				break;
			case 'import':
				$this->id = 0;
				$this->path = base_url(PATH . '/index/import');
				$tela .= form($this);
				$tela .= $this->import_buttons();
				$url = get('authority_url');
				$tela .= '';
				if ($url != '') {
					$tela = h($url, 2);
					$tela .= $this->inport_brapci($url);
				}
				break;

			default:
				$tela .= $this->tableview();
				break;
		}
		$tela = bs($tela);
		return $tela;
	}

	function findId($id)
		{

			$AuthorityNames = new \App\Models\Authority\AuthorityNames();
			//$dt = $AuthorityNames->get_id_by_name($name);
			$dt = $AuthorityNames->le($id);
			$sx = '';
			$sx .= h($dt['a_prefTerm'],3);

			if (count($dt) > 0)
				{
					if ((trim($dt['a_lattes'])=='') or ($dt['a_lattes'] == 0))
						{
							$name = $dt['a_prefTerm'];
							$LattesId = new \App\Models\Lattes\LattesId();
							$dl = $LattesId->LattesFindID($name);

							if (count($dl) > 0)
								{
									$t = $dl['result'];
									foreach($t as $idlattes=>$name)
										{
											$AuthorityNames->set('a_lattes',$idlattes);
											$AuthorityNames->where('id_a',$dt['id_a'])->update();
											$sx .= bsmessage('Update LattesID: '.$idlattes);
										}
								} else {
									$sx .= bsmessage('Multiples LattesID');		
								}
						} else {
							$sx .= bsmessage('Already Update LattesID');
						}
				} else {
					$sx .= bsmessage('Authority not seted!');
				}	
			return $sx;
		}


	function xxxfindId($id)
		{
			$RDF = new \App\Models\Rdf\RDF();
			$dt = $RDF->le($id);
			$name = $dt['concept']['n_name'];

			$sx = '';
			$sx .= h($name,3);

			$AuthorityNames = new \App\Models\Authority\AuthorityNames();
			$dt = $AuthorityNames->get_id_by_name($name);
			if (count($dt) > 0)
				{
					if (trim($dt[0]['a_lattes'])=='')
						{
							$LattesId = new \App\Models\Lattes\LattesId();
							$dl = $LattesId->LattesFindID($name);

							if (count($dl) > 0)
								{
									$t = $dl['result'];
									foreach($t as $idlattes=>$name)
										{
											$AuthorityNames->set('a_lattes',$idlattes);
											$AuthorityNames->where('id_a',$dt[0]['id_a'])->update();
											$sx .= bsmessage('Update LattesID: '.$idlattes);
										}
								} else {
									$sx .= bsmessage('Multiples LattesID');		
								}
						} else {
							$sx .= bsmessage('Already Update LattesID');
						}
				} else {
					$sx .= bsmessage('Authority not seted!');
				}	
			return $sx;
		}

	function import_lattes($d1, $ida)
	{
		$tela = '';
		$Lattes = new \App\Models\Lattes\LattesXML();
		$tela = $Lattes->xml($d1,$ida);
		//$tela = metarefresh(PATH.'index/viewid/'.$ida);
		return $tela;
	}

	function resumeCreate()
	{
		$AuthorityNames = new \App\Models\Authority\AuthorityNames();
		$AuthorityNames->summaryCreate();
	}

	
	function tableview()
	{
		$AuthorityNames = new \App\Models\Authority\AuthorityNames();
		$AuthorityNames->path = PATH. 'res/authority';
		$tela = tableView($AuthorityNames);

		return $tela;
	}

	/******************************************************************************************/
	function import_buttons()
	{
		$sx = h(lang('External_tools'), 3);
		$sx .= '<a href="' . base_url(PATH . '/index/import_api_brapci') . '" class="btn btn-outline-primary">' . lang('Brapci') . ' - API</a>';
		$sx = bsc(bsc($sx, 12));

		return $sx;
	}

	function import_api_brapci($ini = 0)
	{
		$tela = '';
		$file = '.tmp/authors/authors_api_brapci.csv';
		if (!file_exists($file)) {
			$url = 'https://brapci.inf.br/ws/api/?verb=authors';
			$txt = file_get_contents($url);
			dircheck('.tmp');
			dircheck('.tmp/authors');
			file_put_contents($file, $txt);
		}

		$tela .= h(lang('Processing') . ' ' . $file, 5);
		if (file_exists($file)) {
			$txt = file_get_contents($file);
			$lns = explode(chr(10), $txt);
			$tot = 0;
			$ini = round($ini);
			echo '<h1>' . $ini . '</h1>';
			for ($r = ($ini + 1); $r < count($lns); $r++) {
				$tot++;
				if ($tot > 30) {
					$tela .= metarefresh(base_url(PATH . '/index/import_api_brapci/' . $r));
					break;
				}
				$l = $lns[$r];
				$l = explode(';', $l);

				if (count($l) == 2) {
					$idp = $this->author($l[0], $l[1], 0);
					$tela .= '<br>' . $l[0] . ' - ' . $idp;
				}
			}
		}
		return $tela;
	}

	/******************************************************************************************/
	function author($name, $URI, $up = 1)
	{
		$tela = '';
		$name = strip_tags($name);
		if (strlen($name) > 0) {
			$tela .= '<h2>' . $name . '</h2>';
			$AuthorityNames = new \App\Models\Authority\AuthorityNames();
			$AuthorityNames->where('a_uri', $URI);
			$dt = $AuthorityNames->findAll();
			if ((count($dt) == 0) and ($URI != '')) {
				$dt['id_a'] = '';
				$dt['a_uri'] = $URI;
				$dt['a_use'] = '';
				$dt['a_class'] = 'P';
				$dt['a_prefTerm'] = $name;
				$AuthorityNames->insert($dt);
				$tela .= '<h5>' . lang('authority.appended') . '</h5>';
			} else {
				if ($up == 1) {
					$dt = $dt[0];
					if ($dt['a_prefTerm'] != $name) {
						$AuthorityNames->set('a_prefTerm', $name);
						$AuthorityNames->where('id_a', $dt['id_a']);
						$AuthorityNames->update();
						$tela .= '<h5>' . lang('authority.updated') . '</h5>';
					} else {
						$tela .= '<h5>' . lang('authority.already_insired') . '</h5>';
					}
				}
			}
		}
		return '';
	}
	function inport_brapci($url)
	{

		$AuthorityWords = new \App\Models\Authority\AuthorityWords();
		$RDF = new \App\Models\RDF();
		$RDF->DBGroup = 'auth';

		$tela = '';
		$URI = '';
		$file = md5($url) . 'rdf';
		dircheck('.tmp');
		dircheck('.tmp/brapci/');
		$file = '.tmp/brapci/' . $file;

		if (!file_exists($file)) {
			$rdf = file_get_contents($url . '/rdf');
			file_put_contents($file, $rdf);
		} else {
			$rdf = file_get_contents($file);
		}

		/**********************************************************************************/
		//$keywords = preg_split(chr(13),$rdf);
		$ln = explode(chr(13), $rdf);
		$taff = '<ul>';
		for ($r = 0; $r < count($ln); $r++) {
			$l = explode('	', $ln[$r]);
			$ln0 = trim($l[0]);

			if (substr($ln0, 0, 5) == '<http') {
				$uri = $ln0;
				$URI = str_replace(array('<', '>'), '', $uri);
			}

			if (isset($l[2])) {
				//$tela .= $l[1].'=>'.$l[2].'<hr>';
			}

			if (isset($l[1]) and ($l[1] == 'dc:affiliatedWith')) {
				$aff = substr($l[2], 1, strlen($l[2]));
				$affn = substr($aff, strpos($aff, '#') + 1, strlen($aff));
				$aff = substr($aff, 0, strpos($aff, '#'));
				$aff = nbr_author($aff, 7);
				$AuthorityWords->process($affn);
				$taff .= '<li>' . $affn . '</li>';
			}



			if (isset($l[1]) and ($l[1] == 'skos:prefLabel')) {
				$name = substr($l[2], 1, strlen($l[2]));
				$name = substr($name, 0, strpos($name, '"'));
				$name = nbr_author($name, 7);
				$AuthorityWords->process($name);
				$RDF->RDF_concept($name, 'foad:Person');
			}
		}
		$taff .= '</ul>';


		$tela .= $taff;
		return $tela;
	}
}
