<?php

namespace App\Models\Base;

use CodeIgniter\Model;

class Sources extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'source_source';
    protected $primaryKey       = 'id_jnl';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields        = [
        'id_jnl', 'jnl_name', 'jnl_name_abrev',
        'jnl_issn', 'jnl_eissn', 'jnl_periodicidade',
        'jnl_ano_inicio', 'jnl_ano_final', 'jnl_url',
        'jnl_url_oai', 'jnl_oai_from', 'jnl_cidade',
        'jnl_scielo', 'jnl_collection', 'jnl_active',
        'jnl_historic', 'jnl_frbr'
    ];

    protected $viewFields        = [
        'id_jnl', 'jnl_name', 'jnl_name_abrev',
        'jnl_issn'
    ];

    protected $typeFields        = [
        'hidden', 'string:100:#', 'string:20:#',
        'string:20:#', 'string:20', 'op: & :Q&Quadrimestral:S&Semestral:A&Anual:F&Continuos FLuxo',
        'year', 'year', 'string:20',
        'string:20', 'string:20', 'string:20',
        'sn', 'string:20', 'sn',
        'sn', 'string:20'
    ];

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

    function list_selected()
    {
        if (!isset($_SESSION['sj'])) {
            $sj = array();
        } else {
            $sj = (array)json_decode($_SESSION['sj']);
        }
        $lst = '';
        $max = 15;
        $nr = 0;
        $sx = '';
        $more = 0;
        foreach ($sj as $jid => $active)
            if ($active == 1) {
                $dt = $this->find($jid);
                if ($nr < $max) {
                    if (strlen($sx) > 0) {
                        $sx .= '; ';
                    }
                    $sx .= $dt['jnl_name_abrev'];
                    $nr++;
                } else {
                    $more++;
                }
            }
        if ($more > 0) {
            $sx .= lang('brapci.more') . ' +' . ($more);
        }
        if ($sx == '') {
            $sx = lang('brapci.select_sources') . ' ' . bsicone('folder-1');
        } else {
            $sx .= '.';
        }
        return $sx;
    }

    function ajax()
    {
        $id = get("id");
        $ok = get("ok");
        if (!isset($_SESSION['sj'])) {
            $sj = array();
        } else {
            $sj = (array)json_decode($_SESSION['sj']);
        }

        /********************************* CHECK */
        if (!isset($sj[$id])) {
            $sj[$id] = 1;
        } else {
            if ($sj[$id] == 1) {
                $sj[$id] = 0;
            } else {
                $sj[$id] = 1;
            }
        }
        $_SESSION['sj'] = json_encode($sj);

        return $this->list_selected();
    }

    function search_source()
    {
        if (isset($_SESSION['sj'])) {
            $sj = (array)json_decode($_SESSION['sj']);
        } else {
            $sj = array();
        }


        $dt = $this
            ->orderBy("jnl_collection, jnl_name")
            ->FindAll();
        $sx = '';

        $xcollection = '';
        $sx .= '<ul style="list-style-type: none;">';
        for ($r = 0; $r < count($dt); $r++) {
            $line = $dt[$r];
            $id = $line['id_jnl'];

            $check = '';
            if (isset($sj[$id])) {
                if ($sj[$id] == 1) {
                    $check = 'checked';
                }
            }
            $collection = trim($line['jnl_collection']);
            if ($collection != $xcollection) {
                $xcollection = $collection;
                $sx .= h(lang('brapci.' . $collection), 4);
            }
            $sx .= '<li>';
            $sx .= '<input type="checkbox" id="jnl_' . $id . '" ' . $check . ' class="me-2" onclick="markSource(' . $id . ',this);">';
            $sx .= $line['jnl_name'];
            if (strlen(trim($line['jnl_issn'])) > 0) {
                $sx .= ' (ISSN ' . $line['jnl_issn'] . ')';
            }
            $sx .= '</>';
        }
        $sx .= '</ul>';
        return $sx;
    }

    function index($d1, $d2, $d3)
    {
        $this->path = base_url(PATH . MODULE . '/index/');
        $this->path_back = base_url(PATH . MODULE . '/index/');

        switch ($d1) {
                /******************* Validade ******/
            default:
                $sx = $this->menu();
                break;

            case 'menu':
                $sx = $this->menu();
                break;

            case 'tableview':
                $sx = $this->tableview();
                break;

            case 'inport_rdf':
                $JournalIssue = new \App\Models\Journal\JournalIssue();
                $sx = $JournalIssue->inport_rdf($d2, $d3);
                break;

                /******************* Implementando */
            case 'issue':
                $sx = $this->issue($d1, $d2, $d3);
                break;

            case 'harvesting':
                $sx = 'Harvesting';
                break;

            case 'issue_harvesting':
                $JournalIssue = new \App\Models\Journal\JournalIssue();
                $sx = $JournalIssue->harvesting_oaipmh($d2, $d3);
                break;


                /******************* Para testes ***/
            case 'edit_issue':
                $sx = $this->editar_issue($d2, $d3);
                break;
            case 'oai_check':
                $sx = $this->oai_check();
                break;
            case 'edit':
                $sx = $this->editar($d2);
                break;
            case 'viewid':
                $sx = $this->viewid($d2);
                break;
            case 'view_issue':
                $sx = $this->view_issue_id($d2);
                break;
            case 'oai':
                $sx = $this->oai($d2, $d3);
                break;
            case 'edit':
                break;
        }
        return $sx;
    }
    function menu()
    {
        $sx = '';
        $items = array();
        $mod = $this->MOD();
        $items['admin/' . $mod . '/tableview'] = 'TableView';
        foreach ($items as $it => $tx) {
            $link = '<a href="' . PATH . MODULE . $it . '">' . $tx . '</a>';
            $sx .= '<li>' . $link . '</li>';
        }

        $sx .= $this->resume();
        $sx = bs(bsc($sx));
        return $sx;
    }

    /******************************************** RESUME */
    function resume()
    {
        $MOD = $this->MOD(TRUE);
        echo $MOD;
        //$dt = $this->get_resume();
        $total = 0;
        //print_r($dt);
        $sx = '<span class="small">' . lang('brapci.total_journals') . '</span>';
        $sx .= h($total, 1);
        return $sx;
    }
    function le_rdf($id)
    {
        $dt = $this->where('jnl_frbr', $id)->FindAll();
        return $dt;
    }
    function oai($jnl, $id)
    {
        $sx = '';
        $OaipmhRegister = new \App\Models\Oaipmh\OaipmhRegister();
        switch ($id) {
            case '0':
                $idr = $OaipmhRegister->process_00($jnl);
                $sx .= '==>' . $idr;

            case '1':
                $idr = $OaipmhRegister->process_01($jnl);
                $sx .= '==>' . $idr;
                break;
        }


        return $sx;
    }
    function oai_check()
    {
        $JournalIssue = new \App\Models\Journal\JournalIssue();
        $sx = $JournalIssue->oai_check();
        return $sx;
    }

    function issue($th, $d2, $d3)
    {
        $JournalIssue = new \App\Models\Journal\JournalIssue();
        $sx = $JournalIssue->ArticlesIssue($d2);
        return $sx;
    }

    /*******************************************************/
    function editar_issue($id, $jnl)
    {
        $JournalIssue = new \App\Models\Journal\JournalIssue();
        $sx = $JournalIssue->edit($id, $jnl);
        return $sx;
    }

    function issn($dt)
    {
        //https://portal.issn.org/resource/ISSN/xxxx-xxxx
        $sx = '';
        $url = $link = '<a href="https://portal.issn.org/resource/ISSN/$issn" target="new_.$issn." class="btn-outline-primary rounded-3 p-2">' . bsicone('url', 24) . ' $issn</a>';
        if ($dt['jnl_issn'] != '') {
            $issn = $dt['jnl_issn'];
            $link = troca($url, '$issn', $issn);
            $sx .= 'ISSN: ' . $link;
        }
        if ($dt['jnl_eissn'] != '') {
            $sx .= ' - ';
            $issn = $dt['jnl_eissn'];
            $link = troca($url, '$issn', $issn);
            $sx .= 'eISSN: ' . $link;
        }
        return $sx;
    }

    function journal_header($dt, $resume = true)
    {
        if (!is_array($dt)) {
            $sx = bsmessage('Erro de identificação do ISSUE/Jornal', 3);
            return $sx;
            exit;
        }

        $idj = $dt['jnl_frbr'];
        $this->Cover = new \App\Models\Journal\Cover();
        $img = '<img src="' . $this->Cover->image($dt['id_jnl']) . '" class="img-fluid">';
        $sx = '';
        $url = PATH . MODULE . 'v/' . $idj;
        $jnl = h(anchor($url, $dt['jnl_name']), 3);

        $jnl .= '<div class="row">';
        $jnl .= bsc($this->start_end($dt), 4);
        $jnl .= bsc($this->issn($dt), 8);
        $jnl .= bsc($this->url($dt), 4);
        $jnl .= bsc($this->active($dt), 8);
        $jnl .= '</div>';

        if ($resume) {
            $Oaipmh = new \App\Models\Oaipmh\Oaipmh();
            $jnl .= '<div class="row mt-5" style="border-bottom: 2px solid #888">';
            $jnl .= bsc('<img src="' . base_url('img/icones/oaipmh.png') . '" class="img-fluid p-4">', 2);
            $jnl .= $Oaipmh->resume($idj);
            $jnl .= '</div>';
        }

        $openaccess = $this->openaccess($dt);

        $sx = bsc($jnl, 10);
        $sx .= bsc($openaccess, 1, 'p-4');
        $sx .= bsc($img, 1, 'p-2');
        $sx = bs($sx);

        return $sx;
    }

    function viewid($id)
    {
        $sx = '';
        $dt = $this->find($id);

        /************** ISSUES */
        $JournalIssue = new \App\Models\Journal\JournalIssue();
        $jn_rdf = $dt['jnl_frbr'];

        $sx = $this->journal_header($dt);

        /************************************************* Mostra edições */
        $sx .= $JournalIssue->view_issue($jn_rdf);

        /********************************************** Botoes de edições */
        $sx .= bs(bsc($JournalIssue->btn_new_issue($dt), 12, 'mt-4'));

        return $sx;
    }

    /********************************************************************************** ADMIN EDIT */
    function editar($id)
    {
        $this->id = $id;
        $this->path = PATH . COLLECTION . '/source';
        $this->path_back = PATH . COLLECTION . '/source';
        if ($id > 0) {
            $dt = $this->find($id);
            $sx = h($dt['jnl_name'], 1);
        } else {
            $sx = h(lang('Editar'), 1);
        }

        $sx .= form($this);
        $sx = bs(bsc($sx, 12));
        return $sx;
    }



    /******************************************** MOSTRA LISTA DE PUBLICAÇÕES */
    function tableview()
    {
        $this->where("jnl_collection = 'JA'");
        $this->path = (PATH . COLLECTION . '/source');
        $sx = tableview($this);
        $sx = bs(bsc($sx, 12));
        return $sx;
    }
}