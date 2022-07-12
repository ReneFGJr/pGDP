<?php

namespace App\Models\Rdf;

use CodeIgniter\Model;

class RdfForm extends Model
{
	protected $DBGroup              = 'rdf';
	protected $table                = 'rdf_form_class';
	protected $primaryKey           = 'id_sc';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_sc','sc_class','sc_propriety',
		'sc_range','sc_ativo','sc_visible',
		'sc_library', 'sc_global','sc_group',
		'sc_ord'
	];

	protected $typeFields        = [
		'hidden',
		'sql:id_c:c_class:rdf_class:c_type=\'C\' order by c_class',
		'sql:id_c:c_class:rdf_class:c_type=\'P\' order by c_class',
		'sql:id_c:c_class:rdf_class:c_type=\'C\' order by c_class',
		'sn','sn','string:100',
		'string:100','string:100','[1-99]'	];	

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

function forms()
	{
		$dt = $this->select("*")
			->Join('rdf_class','sc_propriety = id_c','left')
			->where('sc_library', LIBRARY)
			->OrWhere('sc_library', 0)
			->orderBy('sc_class, sc_group, c_class','asc')
			->FindAll();

		$sx = '';
		$xgr = '';
		for ($r=0;$r < count($dt);$r++)
			{
				$line = $dt[$r];
				$id = $line['sc_class'];
				$gr = $line['sc_group'];
				if ($gr != $xgr)
					{
						$sx .= '<h3>Grupo: '.lang('rdf.'.$gr).'</h3>';
						$xgr = $gr;
					}
				$link = onclick(PATH.MODULE.'rdf/form_ed/'.$line['id_sc'],800,600);
				$linka = '</span>';
				$act = '';
				$acta = '';
				if ($line['sc_ativo'] = 0)
					{
						$act = '<s>';
						$acta = '</s>';
					}
				$sx .= '<li>'.$act.$link.$line['c_class'].$linka.$acta. ' ('.$line['sc_library'].')</li>';
			}
		return $sx;
	}

function form($id, $dt) {
		$RDF = new \App\Models\Rdf\RDF();
		$class = $dt['cc_class'];

		if ($dt['cc_class'] < 0)
			{
				$sx = $RDF->E404();
				return $sx;
			}

		$this->form_import($class);

		if (get("action") == "DEL")
			{
				$check = md5($id.MODULE);
				$this->exclude($id,$check);
			}

		$sx = '';
		$js1 = '';  
		$sx .= '<div class="small">Class</div>';
		$sx .= h($RDF->show_class($dt),2,'btn-primary [bn]');
		$sx .= '<a href="'.URL.MODULE.'/v/'.$id.'" class="small">'.lang('rdf.return').'</a>';
		$sx .= ' | ';
		$sx .= onclick(URL.MODULE.'/rdf/exclude_concept/'.$id,800,400,'text-danger');
		$sx .= lang('rdf.delete').'</span>';
		//$sx .= $RDF->link($dt,'btn btn-outline-primary btn-sm').'return'.'</a>';;
		

		/* complementos */
		switch($class) {
			default :
			$cp = 'n_name, cpt.id_cc as idcc, d_p as prop, id_d, d_literal, id_n';
			$sqla = "select $cp from rdf_data as rdata
			INNER JOIN rdf_class as prop ON d_p = prop.id_c 
			INNER JOIN rdf_concept as cpt ON d_r2 = id_cc 
			INNER JOIN rdf_name on cc_pref_term = id_n
			WHERE d_r1 = $id and d_r2 > 0";
			$sqla .= ' union ';
			$sqla .= "select $cp from rdf_data as rdata
			LEFT JOIN rdf_class as prop ON d_p = prop.id_c 
			LEFT JOIN rdf_concept as cpt ON d_r2 = id_cc 
			LEFT JOIN rdf_name on d_literal = id_n
			WHERE d_r1 = $id and d_r2 = 0";
			/*****************/
			$sql = "select * from rdf_form_class
			INNER JOIN rdf_class as t0 ON id_c = sc_propriety
			LEFT JOIN (" . $sqla . ") as t1 ON id_c = prop 
			LEFT JOIN rdf_class as t2 ON sc_propriety = t2.id_c
			where sc_class = $class and (sc_library = ".LIBRARY." OR sc_library = 0) and (sc_visible = 1)
			order by sc_ord, id_sc, t0.c_order";

			$rlt =  (array)$this->db->query($sql)->getResult();

			$sx .= '<table width="100%" cellpadding=5>';
			$js = '';
			$xcap = '';
			$xgrp = '';
			for ($r = 0; $r < count($rlt); $r++) {
				$line = (array)$rlt[$r];
				$grp = $line['sc_group'];
				if ($xgrp != $grp)
				{
					$sx .= '<tr>';
					$sx .= '<td colspan=3 class="middle" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;" align="center">';
					$sx .= lang('rdf.'.$grp);
					$sx .= '</td>';
					$sx .= '</tr>';
					$xgrp = $grp;
				}
				$cap = msg($line['c_class']);

				/************************************************************** LINKS EDICAO */
				$idc = $id; /* ID do conceito */
				$form_id = $line['id_sc']; /* ID do formulário */
				/* $class =>  ID da classe */

				$furl = (PATH.MODULE.'rdf/form/'.$class.'/'.$line['id_sc'].'/'.$id);

				$class = trim($line['c_class']);
				$link = onclick(PATH.MODULE.'rdf/form/edit/'.$class.'/'.$line['id_sc'].'/'.$id,800,400,'btn-primary rounded');
				//$link = onclick(PATH.MODULE.'rdf/form/'.$line['id_sc'],800,600,'btn-primary round');
				$linka = '</span>';
				$sx .= '<tr>';
				$sx .= '<td width="25%" align="right" valign="top">';

				if ($xcap != $cap) {
					$sx .= '<nobr><i>' . lang('rdf.'.$line['c_class']) . '</i></nobr>';
					$sx .= '<td width="1%" valign="top">' . $link . '&nbsp;+&nbsp;' . $linka . '</td>';
					$xcap = $cap;
				} else {
					$sx .= '&nbsp;';
					$sx .= '<td>-</td>';
				}
				$sx .= '</td>';

				/***************** Editar campo *******************************************/
				$sx .= '<td style="border-bottom: 1px solid #808080;">';
				if (strlen($line['n_name']) > 0) {
					$linkc = '<a href="' . (PATH . MODULE. 'v/' . $line['idcc']) . '" class="middle">';
					$linkca = '</a>';
					if (strlen($line['idcc']) == 0)
					{
						$linkc = '';
						$linkca = '';
					}
					$sx .= $linkc . ''.$line['n_name'] . $linkca;

					/********************** Editar caso texto */
					$elinka = '</a>';
					if (strlen($line['idcc']) == 0)
					{
						$onclick = onclick(PATH.MODULE.'rdf/text/'.$line['d_literal'],$x=600,$y=400,$class="btn-warning p-1 text-white supersmall rounded");
						$elink = $onclick;												
						$sx .= '&nbsp; '.$elink . '[ed]' . $elinka;
						$sx .= '</span>';
					}

				/************* Excluir Texto/Conceito Associado */
				$onclick = onclick(PATH.MODULE.'rdf/exclude/'.$line['id_d'],$x=600,$y=300,$class="btn-danger p-1 text-white supersmall rounded");
				$link = $onclick;
				$sx .= '&nbsp; '. $link .'[X]' . $elinka;
				$sx .= '</span>';
				}

				$sx .= '</td>';
				$sx .= '</tr>';				
			}
			$sx .= '</table>';
			break;
		}		
		return ($sx);
	}

function form_ed($id)
	{
		$this->id = $id;
		$this->path = PATH.MODULE.'rdf/form_ed/'.$id;
		$this->path_back = 'wclose';
		$sx = form($this);
		return $sx;
	}

function form_import($id_class,$force=false)
	{
		$RDF = new \App\Models\Rdf\Rdf();
		$RDFData = new \App\Models\Rdf\RDFData();
		$RDFConcept = new \App\Models\Rdf\RDFConcept();
				
		$dt = $RDFConcept
				->select('cc_class, d_p')
				->where('cc_class',$id_class)
				->join('rdf_data','id_cc = d_r1')
				->groupBy('cc_class, d_p')
				->FindAll();		

		for ($r=0;$r < count($dt);$r++)
			{
				$dd['sc_class'] = $dt[$r]['cc_class'];
				$dd['sc_propriety']  = $dt[$r]['d_p'];
				$dd['sc_range'] = 0;
				$dd['sc_ativo'] = 1;
				$dd['sc_ord'] = 1;
				$dd['sc_library'] = LIBRARY;
				$dd['sc_group'] = '';
				$dd['sc_global'] = LIBRARY;

				$this->where('sc_propriety',$dt[$r]['d_p']);
				$this->where('sc_class',$dt[$r]['cc_class']);
				$this->where('sc_library',LIBRARY);
				$da = $this->findAll();

				if (count($da) == 0)
					{
						$this->set($dd)->insert();
					}
			}
	}
	
function le($id)
	{
		$dt = $this->find($id);
		return $dt;
	}

function edit_form($id)
	{
		$this->id = $id;
		$this->path_back = 'close';
		$sx = form($this);
		return $sx;
	}

function edit($d1,$d2,$d3,$d4,$d5)
	{
		$this->Socials = new \App\Models\Socials();
		$sx = '';		
		$prop = $d3;
		$id = $d4;
		$idc = $d5;
		$dt = $this->le($id);
		/*************************** RANGE */
		$range = $dt['sc_range'];

		if ($range == 0)
			{
				if  ($this->Socials->getAccess("#ADM"))
					{
						$id = $dt['id_sc'];
						$sx = metarefresh(PATH.MODULE.'rdf/form_ed/'.$id.'?msg=range_not_found',0);
						return $sx;
					} else {						
						echo bsmessage("RANGE not defined",3);
						if (perfil("#ADM"))
							{
								$sx = '<a href="'.PATH.MODULE.'rdf/form_ed/'.$id.'?msg=range_not_found">';
								$sx .= 'EDIT';
								$sx .= '</a>';
							}
						return $sx;
					}
			}

		$RDFClass = new \App\Models\Rdf\RDFClass();
		$dr = $RDFClass->find($range);

		$rclass = $dr['c_class'];
		switch($rclass)
			{
				case 'Text':
					$RDFFormText = new \App\Models\Rdf\RDFFormText();
					$sx .= $RDFFormText->edit(0,$d3,$d4,$d5);
					break;
				default:
					$RDFFormVC = new \App\Models\Rdf\RDFFormVC();
					$sx .= $RDFFormVC->edit($d3,$d4,$d5,$rclass);					
			}
		return $sx;
	}

function exclude($id,$ac='')
	{
		$check = md5($id.MODULE);
		$RDFData = new \App\Models\Rdf\RDFData();
		$dt = $RDFData->find($id);

		$sx = '';
		$dd = array();

		/* Confirm */
		if ($ac == $check)
			{				
				echo wclose();
				echo bsmessage(lang('Success'),1);
				$RDFData->delete($id);
				exit;
			}

		/* Concept */
		if ($dt['d_r2'] > 0)
			{
				$RDFConcept = new \App\Models\Rdf\RDFConcept();
				$dd = $RDFConcept->le($dt['d_r2']);
				$sx .= '<div class="mt-2">'.lang('rdf.concept').'</div>';
			}
		/* Text */
		if (($dt['d_r2'] == 0) and ($dt['d_literal'] > 0))
			{
				$RDFLiteral = new \App\Models\Rdf\RDFLiteral();
				$dd = $RDFLiteral->find($dt['d_literal']);
				$sx .= '<div class="mt-2">'.lang('rdf.term').'</div>';
			}
		/* Mostra Nome */

		if (count($dd) == 0)
			{
				echo h(lang('rdf.404'),1);
				echo h(lang('rdf.concept_not_found'),3);
				exit;
			}
		
		$sx .= h($dd['n_name'],3).'<hr>';

		/* Mostra mensagem de exclusão */
		$sx .= '<center>'.h(lang('rdf.find.rdf_exclude_confirm'),4,'text-danger').'</center>';
		$sx .= '
			</div>		
			<div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="wclose();" data-dismiss="modal">'.lang('find.cancel').'</button>
			<a href="'.(PATH.MODULE.'rdf/exclude/'.$id.'/'.$check).'" class="btn btn-warning" id="submt">'.lang('find.confirm_exclude').'</a>
			</div>                  
		';
		/**************** fim ******************/
		return $sx;
}

function form_class_edit($id,$class='')
		{
			$RDFPrefix = new \App\Models\Rdf\RDFPrefix();
			$sql = "
			SELECT id_sc, sc_class, sc_propriety, sc_ord, id_sc,
			t1.c_class as c_class, t2.prefix_ref as prefix_ref,
			t3.c_class as pc_class, t4.prefix_ref as pc_prefix_ref,
			sc_group, sc_library, sc_visible
			FROM rdf_form_class
			INNER JOIN rdf_class as t1 ON t1.id_c = sc_propriety
			LEFT JOIN rdf_prefix as t2 ON t1.c_prefix = t2.id_prefix

			LEFT JOIN rdf_class as t3 ON t3.id_c = sc_range
			LEFT JOIN rdf_prefix as t4 ON t3.c_prefix = t4.id_prefix

			where sc_class = $class
			AND ((sc_global =1 ) or (sc_library = 0) or (sc_library = ".LIBRARY."))
			order by sc_ord";

			$rlt = (array)$this->db->query($sql)->getResult();
			
			$sx = '<div class="col-md-12">';
			$sx .= '<h4>'.msg("Form").'</h4>';
			$sx .= '<table class="table">';
			$sx .= '<tr><th width="4%">#</th>';
			$sx .= '<th width="47%">'.lang('rdf.propriety').'</th>';
			$sx .= '<th width="42%">'.lang('rdf.range').'</th>';
			$sx .= '<th width="42%">'.lang('rdf.visible').'</th>';
			$sx .= '<th width="5%">'.lang('rdf.group').'</th>';
			$sx .= '</tr>';
			for ($r=0;$r < count($rlt);$r++)			
			{
				$line = (array)$rlt[$r];
				$link = onclick(PATH.MODULE.'rdf/form_ed/'.$line['id_sc'],800,600);
				$linka = '</span>';
				$sx .= '<tr>';

				$sx .= '<td align="center">';
				$sx .= $line['sc_ord'];
				$sx .= '</td>';

				/* CLASS */
				$prop = $RDFPrefix->prefixn($line);
				$sx .= '<td>';	
				$sx .= $link;			
				$sx .= msg($line['c_class']).' ('.$prop.')';
				$sx .= $linka;
				$sx .= '</td>';

				/* RANGE */
				$dt = array();
				$dt['c_class'] = $line['pc_class'];
				$dt['prefix_ref'] = $line['pc_prefix_ref'];
				$sx .= '<td>';
				$sx .= $RDFPrefix->prefixn($dt);
				$sx .= '</td>';

				/* RANGE */
				$dt = array();
				$sx .= '<td>';
				if ($line['sc_visible'] == 1)
					{
						$sx .= bsicone('eye');
					} else {
						$sx .= bsicone('eye-closed');
					}					
				$sx .= '</td>';				

				/* GROUP */
				$dt = array();
				$sx .= '<td>';
				$sx .= $line['sc_group'];
				$sx .= '</td>';

				$sx .= '</tr>';
			}
			$sx .= '</table>';
			$sx .= '</div>';

			if (isset($line['sc_class']))
			{
				//$link = onclick(PATH.MODULE.'rdf/formss/'.$id.'/0',800,600,"btn btn-outline-primary");
				$link = onclick(PATH.MODULE.'rdf/form_ed/'.$line['sc_class'],800,600,"btn btn-outline-primary");
				$linka = '</span>';
				$sx .= $link.lang('rdf.nova_propriedade2').$linka;

				$sx .= ' &nbsp; ';
			}

			$link = '<a href="'.PATH.MODULE.'rdf/form_check/'.$id.'" class="btn btn-outline-primary">';
			$linka = '</a>';
			$sx .= $link.lang('rdf.check_form').$linka;

			return($sx);
		}	
}
