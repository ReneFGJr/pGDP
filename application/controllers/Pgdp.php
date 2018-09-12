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

        parent::__construct();
        $this -> load -> library('form_validation');
        $this -> load -> database();
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('url');
        $this -> load -> library('session');       
        $this -> lang -> load("app", "portuguese");
        date_default_timezone_set('America/Sao_Paulo');
        $this -> load -> model('socials');
    }

    private function cab($data = array()) {
        
        $data['title'] = 'PGDP | UFRGS';
        $this -> load -> view('pgdp/header/header', $data);
        if (!isset($data['menu']))
            {
                $this->load->view('pgdp/header/menu_top');
            }
    }

    private function foot($data = array()) {
        $this -> load -> view('pgdp/header/foot');
    }

    public function index() {
        $tit = array();
        $tit['page_name'] = msg('Home');
        $tit['menu'] = false;
        $this -> cab($tit);
        $this -> load -> view('pgdp/home');
    }
    
    public function main() {
        $tit = array();
        $tit['page_name'] = msg('Home');
        $this -> cab($tit);
    }    

    public function login() {
        $this -> load -> model('socials');
        $this -> cab();

        $sx = $this -> socials -> action();

        $this -> load -> view('social/login', null);

        $data['content'] = $sx;
        $this -> load -> view('content', $data);
    }

    public function plan($id = 0, $pg = '') {
        $this -> load -> model('pgdgs');
        $this -> cab();
        switch($pg) {
            case '' :
                $data['content'] = $this -> pgdgs -> plan_new();
                break;
            default :
                //$data['fluid'] = true;
                $sx = '<div class="row">' . cr();
                $sx .= '<div class="col-md-2">';
                $sx .= $this -> pgdgs -> plan_menu($pg);
                $sx .= '</div>' . cr();
                $sx .= '<div class="col-md-10">';
                $sx .= $this -> pgdgs -> plan_form($id, $pg);
                $sx .= '</div>';
                $sx .= '</div>';

                $data['content'] = $sx;
                break;
        }

        $this -> load -> view('show', $data);

        $this -> foot();
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
    function social($act = '') {
        switch($act) {
            case 'pwsend' :
                $this -> cab();
                $this -> socials -> resend();
                break;
                break;
            case 'signup' :
                $this -> cab();
                $this -> socials -> signup();
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
                $this -> cab();
                $this -> socials -> login();
                break;
            case 'login_local' :
                $ok = $this -> socials -> login_local();
                if ($ok == 1) {
                    redirect(base_url(PATH.'main'));
                } else {
                    redirect(base_url(PATH.'social/login/') . '?erro=ERRO_DE_LOGIN');
                }
                break;
            default :
                echo "Function not found";
                break;
        }
    }

}
