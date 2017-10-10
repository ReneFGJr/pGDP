<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PGDP extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
    function __construct() {
        global $db_public;

        $db_public = 'brapci_publico.';
        parent::__construct();
        $this -> load -> library('form_validation');
        $this -> load -> database();
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> lang -> load("app", "portuguese");
        date_default_timezone_set('America/Sao_Paulo');
    }	 
	 
	private function cab($data=array())
        {
            $this->load->view('pgdp/header/header',$data);
            $this->load->view('pgdp/header/menu_top');
        }
	public function index()
	{
	    $tit = array();
	    $tit['page_name'] = msg('Home');
	    $this->cab($tit);
        $this->load->view('pgdp/home/home');
        
        $this->load->model('pgdps');
        
        $data['content'] = $this->pgdps->list_plan(1);
        $this->load->view('content',$data);
	}
}
