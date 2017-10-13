<?php
class Help extends CI_Controller
    {
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
        
    function index($id = '')
        {
            $this->load->model("manuals");
            $this->manuals->check();
            redirect(base_url('index.php/help/item/'.$id));
            echo $this->manuals->back();
        } 
    function item($id = '')
        {
            $this->load->model("manuals");
            echo $this->manuals->header();
            echo $this->manuals->cab();
            echo $this->manuals->show($id);

            echo $this->manuals->back();            
        }
    function indice($id='')
        {
            $this->load->model("manuals");            
            
            echo $this->manuals->header();
            echo $this->manuals->cab();
            
            $t = troca($id,'_',' ');
            echo $this->manuals->busca_indice($t);
            echo $this->manuals->back();                        
        }
    }
?>
