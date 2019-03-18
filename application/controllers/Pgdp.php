<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PGDP extends CI_Controller {

    var $line;
    var $id = 0;
    var $templat = 0;

    function __construct() {
        global $db_public;

        parent::__construct();
        $this -> load -> library('form_validation');
        $this -> load -> database();
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('bootstrap');
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> lang -> load("pgdp", "portuguese");
        $this -> lang -> load("app", "portuguese");
        $this -> lang -> load("pgdp", "portuguese");
        date_default_timezone_set('America/Sao_Paulo');
        $this -> load -> model('socials');
    }

    private function cab($data = array()) {
        if (!isset($data['login'])) {
            $user_id = $this -> socials -> user_id();
            if ((strlen($user_id) == 0) or ($user_id == '0')) {
                redirect(base_url(PATH));
            }
        }
        $data['title'] = 'PGDP | UFRGS';
        $this -> load -> view('pgdp/header/header', $data);
        if (!isset($data['menu'])) {
            $this -> load -> view('pgdp/header/menu_top');
        }
    }

    private function foot($data = array()) {
        $this -> load -> view('pgdp/header/foot');
    }

    public function index() {
        $tit = array();
        $tit['page_name'] = msg('Home');
        $tit['menu'] = false;
        $tit['login'] = false;
        $this -> cab($tit);
        $this -> load -> view('pgdp/home');
    }

    public function main() {
        $user_id = $this -> socials -> user_id();
        $this -> load -> model('pgdgs');
        $tit = array();
        $tit['page_name'] = msg('Home');
        $this -> cab($tit);

        $data['title'] = msg('dashboard');
        $data['content'] = $this -> pgdgs -> new_plan_button();
        $data['content'] .= '<br>';
        $data['content'] .= $this -> pgdgs -> my_plan($user_id);
        $this -> load -> view('content', $data);
        
        $this->foot();
    }

    public function plan_new($id = '') {
        $this -> load -> model('pgdgs');
        $this -> cab();
        $sx = '';
        if ($id == '') {
            $data['content'] = $this -> pgdgs -> plan_new();
        } else {
            $this -> pgdgs -> id = $id;
            $this -> pgdgs -> line = array();
            $tp = $this -> pgdgs -> le_templat($id);
            $title = 'no_title';
            $this -> pgdgs -> templat = $tp['id_t'];
            $this -> pgdgs -> templat_name = $tp['t_name'];
            $sx .= $this -> pgdgs -> plan_page_0(0);
            $data['content'] = $sx;
        }

        $this -> load -> view('show', $data);
    }

    public function templat_new() {
        $this -> load -> model('pgdgs');
        $this -> cab();
        $data['content'] = $this -> pgdgs -> templat_new();
        $this -> load -> view('show', $data);
    }
    
    public function codebook($act='',$id='')
        {
            $this->load->model("codebooks");
            $this->cab();
            switch($act)
                {            
                case 'view':
                    $tela = $this->codebooks->view($id);
                    break;
                default:
                    $tela = $this->codebooks->row();        
                    break;
                }
            
            
            $data['content'] = $tela;
            $this->load->view('show',$data);
            $this->foot();
        }

    public function plan($pg = '', $templat = '', $new = '') {
        $sx = '';
        $this -> load -> model('pgdgs');
        $this -> cab();
        /***********************************/

        $id = $this -> pgdgs -> token("recover");
        $this -> pgdgs -> id = $id;
        $this -> pgdgs -> line = $this -> pgdgs -> le_plan($id);

        $title = $this -> pgdgs -> line['p_title'];
        $this -> pgdgs -> templat = $this -> pgdgs -> line['p_templat'];
        $this -> pgdgs -> templat_name = $this -> pgdgs -> line['t_name'];

        $this -> pgdgs -> id = $id;

        switch($pg) {
            case '' :
                break;
            case '0' :
                $sx .= $this -> pgdgs -> plan_page_0($id);
                $data['content'] = $sx;
                break;
            default :
                //$data['fluid'] = true;
                $sx = '<div class="row">' . cr();

                $sx .= '<div class="col-md-12 text-center" style="border-bottom: 1px solid #000000;">';
                $sx .= '<h1>' . $title . '</h1>';
                $sx .= '</div>';
                
                $sx .= '<div class="col-md-6 text-left bg" style="border-bottom: 1px solid #000000;">';
                if (!isset($this->pgdgs->line['id_p']))
                {
                    $sx .= msg('new_plan');
                } else {
                    $sx .= strzero($this->pgdgs->line['id_p'],8).'/'.substr($this->pgdgs->line['p_date'],0,4);    
                }        
                $sx .= '</div>'; 
                $sx .= '<div class="col-md-6 text-right bg" style="border-bottom: 1px solid #000000;">';
                $sx .= msg('templat_' . $this -> pgdgs -> templat_name);
                $sx .= '</div>';                
                               

                $sx .= '<div class="col-md-2" style="border-right: 1px solid #808080; padding: 0px;">';
                $sx .= $this -> pgdgs -> plan_menu($pg);
                $sx .= '</div>' . cr();
                $sx .= '<div class="col-md-10">';
                $sx .= $this -> pgdgs -> plan_form($pg);
                $sx .= '</div>';
                $sx .= '</div>';

                $data['content'] = $sx;
                break;
        }

        $this -> load -> view('show', $data);

        $this -> foot();
    }

    function plan_token($token) {
        $this -> load -> model('pgdgs');
        $this -> pgdgs -> token('set', $token);
        redirect(base_url(PATH . 'plan/0'));
    }

    function plan_fields($id = '') {
        $this -> load -> model('pgdgs');
        $this -> cab();
        if (strlen($id) == 0) {
            $data['content'] = '<h2>' . msg('plan_fields') . '</h2>' . cr();
            $data['content'] .= $this -> pgdgs -> list_fields('');
        } else {
            $data['content'] = '<h2>' . msg('plan_fields') . '</h2>' . cr();
            $data['content'] .= $this -> pgdgs -> cp_fields($id);
        }
        $this -> load -> view('show', $data);

        $this -> foot();
    }

    /* LOGIN */
    function social($act = '', $id = '') {
        $data = array();
        $data['login'] = false;
        switch($act) {
            case 'ac' :
                $this -> socials -> ac($id);
            case 'pwsend' :
                $this -> cab();
                $this -> socials -> resend($data);
                break;
                break;
            case 'signup' :
                $this -> cab();
                $this -> socials -> signup($data);
                break;
            case 'logout' :
                $this -> socials -> logout();
                break;
            case 'npass' :
                $this -> cab();
                $email = get("dd0");
                $chk = get("chk");
                $chk2 = checkpost_link($email . $email);

                if (($chk != $chk2) AND (!isset($_POST['dd1']))) {
                    $data['content'] = 'Erro de Check';
                    $this -> load -> view('content', $data);
                } else {
                    $dt = $this -> socials -> le_email($email);
                    if (count($dt) > 0) {
                        $id = $dt['id_us'];
                        $data['title'] = '';
                        $tela = '<br><br><h1>' . msg('change_password') . '</h1>';
                        $new = 1;
                        // Novo registro
                        $data['content'] = $tela . $this -> socials -> change_password($id, $new);
                        $this -> load -> view('content', $data);
                        //redirect(base_url("index.php/thesa/social/login"));
                    } else {
                        $data['content'] = 'Email não existe!';
                        $this -> load -> view('error', $data);
                    }
                }

                $this -> footer();
                break;
            case 'login' :
                $this -> cab($data);
                $this -> socials -> login();
                break;
            case 'login_local' :
                $ok = $this -> socials -> login_local($data);
                if ($ok == 1) {
                    redirect(base_url(PATH . 'main'));
                } else {
                    redirect(base_url(PATH . 'social/login/') . '?erro=ERRO_DE_LOGIN');
                }
                break;
            default :
                echo "Function not found";
                break;
        }
    }

    function config($cmd = '', $id = '') {
        $this -> cab();
        $sx = '';
        switch($cmd) {
            case 'message_export' :
                $this -> load -> model("messages");
                $sx = $this -> messages -> export();
                break;
            case 'message_edit' :
                $this -> load -> model('messages');
                $sx = $this -> messages -> row($id);
                break;
            case 'message_editar' :
                $this -> load -> model('messages');
                if (strlen($id) > 0) {
                    $sx = $this -> messages -> editar($id);
                } else {
                    $sx = $this -> messages -> row();
                }

                break;
            default :
                $sx = '<ul>' . cr();
                $sx .= '<li><a href="' . base_url(PATH . 'config/message_edit') . '">' . msg('config_message_edit') . '</a></li>' . cr();
                $sx .= '<li><a href="' . base_url(PATH . 'config/message_export') . '">' . msg('config_export_message') . '</a></li>' . cr();
                $sx .= '</ul>' . cr();
                break;
        }
        $data['content'] = $sx;
        $data['title'] = msg('export_message');
        $this -> load -> view("content", $data);
        $this -> foot();
    }

    function templat($id = '') {
        $data = array();
        $this -> cab($data);
        $this -> load -> model('pgdgs');
        if ($id == '') {
            $data['title'] = msg('templat_select');
            $sx = $this -> pgdgs -> templats_button_new(base_url(PATH . 'templat/'));
            $sx .= $this -> pgdgs -> templats(base_url(PATH . 'templat/'));

        } else {
            $data['title'] = msg('templat_preview');
            $sx = $this -> pgdgs -> templats_preview($id, base_url(PATH . 'templat/' . $id));
        }
        $data['content'] = $sx;
        $this -> load -> view("content", $data);
        $this -> foot();
    }

    function about() {
        $data = array();
        $data['login'] = false;
        $this -> cab($data);
        $sx = '<div class="col-md-12">';
        $sx .= '<img src="' . base_url('img/logo-pgdp.png') . '" align="right" height="150">';
        $sx .= msg("text_about");
        $sx .= '</div>';
        $data['content'] = $sx;
        $this -> load -> view("content", $data);
        $this -> foot();
    }

}
