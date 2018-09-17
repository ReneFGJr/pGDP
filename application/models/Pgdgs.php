<?php
class pgdgs extends CI_model {
    function list_fields($pg = '') {
        $sql = "select * from dcr_fields 
                            order by f_group, f_descript";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        $sx = '<table width="100%" class="table">' . cr();
        $sx .= '<tr>';
        $sx .= '<th width="5%">' . msg('#') . '</th>' . cr();
        $sx .= '<th width="90%">' . msg('f_descript') . '</th>' . cr();
        $sx .= '<th width="5%">' . msg('f_group') . '</th>' . cr();
        $sx .= '</tr>';

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url(PATH . 'plan_fields/' . $line['id_f']) . '">';
            $sx .= '<tr>';
            $sx .= '<td align="center">' . ($r + 1) . '</td>';
            $sx .= '<td>' . $link . msg($line['f_descript']) . '</a>' . '</td>';
            $sx .= '<td align="center">' . msg($line['f_group']) . '</td>';
            $sx .= '</tr>';
        }
        $sx .= '</table>';
        $sx .= '<a href="' . base_url(PATH . 'plan_fields/0') . '" class="btn btn-outline-primary">';
        $sx .= msg('new_field');
        $sx .= '</a>';
        return ($sx);
    }

    function cp_fields($id = 0) {
        $cp = array();
        array_push($cp, array('$H8', 'id_f', '', false, true));
        array_push($cp, array('$S100', 'f_descript', msg('f_descript'), true, true));
        //array_push($cp, array('$[1-9]', 'f_group', msg('f_group'), true, true));
        array_push($cp, array('$O 1:' . msg('Yes') . '&0:' . msg('No'), 'f_active', msg('f_active'), true, true));
        array_push($cp, array('$T80:5', 'f_form', msg('f_form'), true, true));
        $form = new form;
        $form -> id = $id;
        $sx = $form -> editar($cp, 'dcr_fields');
        if ($form -> saved > 0) {
            redirect(base_url(PATH . 'plan_fields'));
        }
        return ($sx);
    }

    function form_include_group($a1, $a2) {
        $sql = "select * from dcr_form where fr_group = $a2 and fr_templat = $a1";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $a3 = 0;
        if (count($rlt) == 0) {
            $sql = "insert into dcr_form
                            (fr_templat, fr_group, fr_field,
                            fr_majoritary, f_readwrite, fr_page,
                            fr_order)
                            values
                            ($a1,$a2,$a3,
                            1,1,$a2,
                            $a2)";
            $rlt = $this -> db -> query($sql);
        }

    }

    function form_include_form($a2, $a1, $a3) {
        $sql = "select * from dcr_form 
                        where fr_templat = $a1
                            and fr_group = $a2
                            and fr_field = $a3";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            $sql = "insert into dcr_form
                            (fr_templat, fr_group, fr_field,
                            fr_majoritary, f_readwrite, fr_page,
                            fr_order)
                            values
                            ($a1,$a2,$a3,
                            1,1,$a2,
                            $a2)";
            $rlt = $this -> db -> query($sql);
        }
    }

    function templats_preview($id, $url) {

        $sx = '';

        /************************/
        $ac = get("action");
        $dd10 = get("dd10");
        $dd11 = get("dd11");
        $dd12 = get("dd12");

        $dd20 = get("dd20");
        $dd21 = get("dd21");

        /******************** GROUPS **************************/
        $groups = '';
        $sql = "select * from dcr_groups where d_active = 1 order by d_order";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $groups .= '<option value="' . $line['id_d'] . '">' . mst($line['d_descript']) . '</option>' . cr();
        }

        if ((strlen($ac) > 0) and ($dd20 != '') and ($dd21 != '')) {
            $this -> form_include_group($dd20, $dd21);
        }
        $sx .= '<div class="row">';
        $sx .= '<div class="col-md-1">';
        $sx .= '</div>';
        $sx .= '<div class="col-md-11">';
        $sx .= '<form method="post">';
        $sx .= '<div style="float: left;">';
        $sx .= '<input type="hidden" name="dd20" value="' . $id . '">';
        $sx .= '<select name="dd21" class="form-control">';
        $sx .= $groups;
        $sx .= '</select>';
        $sx .= '</div>';
        $sx .= '<div style="float: left;">';
        $sx .= '<input type="submit" name="action" value="' . msg("add_group") . '" class="btn btn-outline-primary">';
        $sx .= '</form>';
        $sx .= '</div>';
        $sx .= '</div>';

        $sx .= '<br><br>';
        $sx .= '<br><br>';

        /******************** FORMS ***************************/
        if ((strlen($ac) > 0) and ($dd10 != '') and ($dd11 != '') and ($dd12 != '')) {
            $this -> form_include_form($dd10, $dd11, $dd12);
        }
        $sql = "select * from dcr_fields where f_active = 1 order by f_descript";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $options = '';
        $options .= '<option value="">' . msg('::select an option::') . '</option>' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $options .= '<option value="' . $line['id_f'] . '">' . msg($line['f_descript']) . '</option>' . cr();
        }

        $sql = "select * from dcr_templat 
                        LEFT JOIN dcr_form ON fr_templat = id_t
                        LEFT JOIN dcr_groups ON fr_group = id_d
                        LEFT JOIN dcr_fields ON fr_field = id_f
                        where id_t = $id
                        order by fr_group, fr_order
                        ";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx .= '<div class="row">';
        $xgr = '';

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $gr = $line['id_d'];

            if ($gr != $xgr) {
                $sx .= '<div class="col-md-12">';
                $sx .= '<h4 style="border-left: 5px solid #c0c0c0; padding: 5px;">' . msg($line['d_descript']) . ' <sup>' . msg('tab') . '-' . $line['fr_page'] . '</sup></h4>';
                $sx .= '</div>';
                $xgr = $gr;

                $sx .= '<div class="col-md-1">';
                $sx .= '</div>';
                $sx .= '<div class="col-md-11">';
                $sx .= '<form method="post">';
                $sx .= '<div style="float: left;">';
                $sx .= '<input type="hidden" name="dd10" value="' . $gr . '">';
                $sx .= '<input type="hidden" name="dd11" value="' . $id . '">';
                $sx .= '<select name="dd12" class="form-control">';
                $sx .= $options;
                $sx .= '</select>';
                $sx .= '</div>';
                $sx .= '<div style="float: left;">';
                $sx .= '<input type="submit" name="action" value="' . msg("add_field") . '" class="btn btn-outline-primary">';
                $sx .= '</form>';
                $sx .= '</div>';
                $sx .= '</div>';

            }

            $sx .= '<div class="col-md-1">';
            $sx .= '</div>';
            $sx .= '<div class="col-md-6">';
            $sx .= '<h5>' . msg($line['f_descript']) . '</h5>';
            $sx .= '</div>';
            $sx .= '<div class="col-md-5">';
            $sx .= '<h5>' . $line['f_form'] . '</h5>';
            $sx .= '</div>';
        }
        $sx .= '</div>';
        return ($sx);
    }

    function templats($url) {
        $sx = '';
        $sql = "select * from dcr_templat where t_active = 1";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        $sx .= '<div class="row">' . cr();
        $sx .= '<div class="col-md-12">' . cr();
        $sx .= '<ul>' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . $url . $line['id_t'] . '">';
            $sx .= '<li>' . $link . msg('templat_' . $line['t_name']) . '</a>' . '</li>' . cr();
        }
        $sx .= '<ul>' . cr();
        $sx .= '</div>' . cr();
        $sx .= '</div>' . cr();
        return ($sx);
    }

    function plan_page_0($id) {
        if (isset($this -> pgdgs -> line['p_title'])) {
            $title = $this -> pgdgs -> line['p_title'];
        } else {
            $title = msg('no_title_exist');
        }

        $pg = 0;
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
        $sx .= $this -> pgdgs -> plan_menu($pg, $id);
        $sx .= '</div>' . cr();
        $sx .= '<div class="col-md-10">';
        $sx .= $this -> pgdgs -> plan_first_page($id, $pg);
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);
    }

    function plan_new() {
        $sx = '';
        $sql = "select * from dcr_templat where t_active = 1";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        $sx .= '<div class="row">' . cr();
        $sx .= '<div class="col-md-12">' . cr();
        $sx .= '<h3>' . msg('CREATE_PLAN') . '</h3>' . cr();
        $sx .= '<ul>' . cr();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url(PATH . 'plan_new/' . $line['id_t']) . '">';
            $sx .= '<li>' . $link . msg('templat_' . $line['t_name']) . '</a>' . '</li>' . cr();
        }
        $sx .= '<ul>' . cr();
        $sx .= '</div>' . cr();
        $sx .= '</div>' . cr();
        return ($sx);
    }

    function templat_new() {
        $sx = '';
        $form = new form;
        $cp = array();
        array_push($cp, array('$H8', 'id_t', '', false, false));
        array_push($cp, array('$S80', 't_name', msg('templat_reference'), true, true));
        array_push($cp, array('$O 1:' . msg("Yes") . '&2:' . msg("No"), 't_active', msg('active'), true, true));
        $sx = $form -> editar($cp, 'dcr_templat');
        if ($form -> saved > 0) {
            redirect(base_url(PATH . 'templat'));
        }
        return ($sx);
    }

    function plan_form($p = '') {
        $id = round($this -> id);
        $tp = $this -> line['p_templat'];
        if ($id <= 0) {
            return ("");
        }
        $sql = "select * FROM dcr_form
                            INNER JOIN dcr_fields ON fr_field = id_f 
                            WHERE fr_templat = $tp and fr_group = $p
                            ORDER by fr_group, fr_page, fr_order";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $cp = array();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $obr = $line['fr_majoritary'];
            $type = $line['f_form'];
            $name = $line['f_descript'];
            $rw = $line['f_readwrite'];
            $obr = $line['fr_majoritary'];
            array_push($cp, array($type, '', msg($name), $obr, $rw));
        }
        $form = new form;
        $sx = $form -> editar($cp, '');
        return ($sx);
    }

    function plan_menu($p, $lk = 1) {
        $id = $this -> id;
        $t = $this -> templat;
        $sql = "SELECT d_descript, fr_page FROM `dcr_form`
                            inner join dcr_groups on fr_group = id_d
                            where fr_templat = $t
                            group by d_descript, fr_page
                            order by fr_page";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        $link = '<a href="' . base_url(PATH . 'plan/0') . '">';
        $linka = '';
        $active = '';
        if ($p == 0) {
            $active = 'plan_menu_active';
        }
        $name = 'group_title';

        if ($lk == '0') {
            $link = '';
            $linka = '';
        }

        $sx = '<ul class="list-unstyled text-right">' . cr();
        $sx .= $link . '<li class="plan_menu ' . $active . '">' . msg($name) . '</li>' . $linka;

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $active = '';
            if ($r == ($p - 1)) {
                $active = 'plan_menu_active';
            }
            $name = $line['d_descript'];
            $pg = $line['fr_page'];
            if ($id > 0) {
                $link = '<a href="' . base_url(PATH . 'plan/' . ($r + 1)) . '" class="aa">';
            } else {
                $link = '<a href="#">';
            }
            $linka = '</a>';

            if ($lk == '0') {
                $link = '';
                $linka = '';
            }

            $sx .= $link . '<li class="plan_menu ' . $active . '">' . msg($name) . '</li>' . $linka;
        }
        $sx .= '</ul>' . cr();
        return ($sx);
    }

    function form($id = 0, $templat = 1) {

    }

    function my_plan($user = 1) {
        $sql = "select * from dcr_plans 
                            INNER JOIN dcr_templat on p_templat = id_t
                            where p_user = $user
                            order by p_status, p_update desc ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '';
        $sx .= '<table width="100%" class="table table-sm">';
        $sx .= '<tr class="bg">' . cr();
        $sx .= '<th width="5%">#</th>' . cr();
        $sx .= '<th width="30%">' . msg('p_title') . '</th>';
        $sx .= '<th width="15%">' . msg('p_templat') . '</th>';
        $sx .= '<th width="10%">' . msg('p_update') . '</th>';
        $sx .= '<th width="5%">' . msg('p_test') . '</th>';
        $sx .= '<th width="5%">' . msg('p_visibility') . '</th>';
        $sx .= '<th width="5%">' . msg('p_shared') . '</th>';
        $sx .= '<th width="15%">' . msg('p_status') . '</th>';
        $sx .= '</tr>';

        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            $link = '<a href="' . base_url(PATH . 'plan_token/' . $line['p_token']) . '">';
            $sx .= '<tr>';
            $sx .= '<td>' . ($r + 1) . '</td>';
            $sx .= '<td>' . $link . $line['p_title'] . '</a>' . '</td>';
            $sx .= '<td>' . $link . msg('templat_' . $line['t_name']) . '</a>' . '</td>';
            $sx .= '<td>' . $link . stodbr($line['p_update']) . '</a>' . '</td>';
            $sx .= '<td align="center">' . $link . msg('bin_' . $line['p_test']) . '</a>' . '</td>';
            $sx .= '<td align="center">' . $link . msg('bin_' . $line['p_visibility']) . '</a>' . '</td>';
            $sx .= '<td align="center">' . $link . msg('bin_' . $line['p_shared']) . '</a>' . '</td>';
            $sx .= '<td>' . $link . msg('satus_' . $line['p_status']) . '</a>' . '</td>';
            $sx .= '</tr>';
        }
        $sx .= '<tr>';
        $total = msg('not_plan');
        if (count($rlt) > 0) {
            $total = msg("Total") . ' ' . count($rlt) . ' ' . msg('plan');
        }
        $sx .= '<td colspan=9 class="text-right"><b>' . $total . '</b></td></tr>';
        $sx .= '</tr>';
        $sx .= '</table>';
        return ($sx);
    }

    function templats_button_new() {
        $sx = '<div class="row">';
        $sx .= '<div class="col-md-1">';
        $sx .= '<a href="' . base_url(PATH . 'templat_new') . '" class="btn btn-outline-primary">' . msg('new_templat') . '</a>' . cr();
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);
    }

    function new_plan_button() {
        $sx = '<div class="row">';
        $sx .= '<div class="col-md-1">';
        $sx .= '<a href="' . base_url(PATH . 'plan_new') . '" class="btn btn-outline-primary">' . msg('new_plan') . '</a>' . cr();
        $sx .= '</div>';
        $sx .= '</div>';
        return ($sx);
    }

    function user() {
        $user = 1;
        return ($user);
    }

    function token($c = '', $token = '') {
        $user = $this -> socials -> user_id();
        if ($c == 'recover') {
            if (isset($_SESSION['token'])) {
                $token = $_SESSION['token'];
                $sql = "select * from dcr_plans where p_token = '$token' and p_user = $user ";
                $rlt = $this -> db -> query($sql);
                $rlt = $rlt -> result_array();
                if (count($rlt) > 0) {
                    $line = $rlt[0];
                    return ($line['id_p']);
                } else {
                    echo "ERRO id_p, token '$token' not found - user ($user)";
                    exit ;
                }
            }
            EXIT ;
        }
        /**************/
        if ($c == 'new') {
            $token = md5(date("Ymdhis" . $user));
            $token .= $token;
            $token = substr($token,0,30);
            $_SESSION['token'] = $token;
        }

        if ($c == 'clean') {
            unset($_session['token']);
        }
        if ($c == 'set') {
            $_SESSION['token'] = $token;
            return ($token);
        }
        $user = $this -> user();
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            $token = md5(date("Ymdhis" . $user));
            $token .= $token;
            $token = substr($token,0,30);
            $_SESSION['token'] = $token;
        }
        return ($token);
    }

    function le_plan($id) {
        $sql = "select * from dcr_plans
                    inner join dcr_templat ON id_t = p_templat 
                    where id_p = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $line = $rlt[0];
            return ($line);
        } else {
            return ( array());
        }
    }

    function le_templat($id) {
        $sql = "select * from dcr_templat
                    where id_t = $id";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $line = $rlt[0];
            return ($line);
        } else {
            return ( array());
        }
    }

    function plan_first_page($id = 0) {
        $user = $this -> socials -> user_id();
        
        if ((strlen(get("dd7")) > 0) or ($id > 0))
            {
                $token = $this -> token();
            } else {
                $token = $this -> token('new');        
            }
        
        $templat = $this -> templat;
        $form = new form;
        $cp = array();

        array_push($cp, array('$H8', 'id_p', '', false, false));
        array_push($cp, array('$T80:5', 'p_title', msg('p_title'), True, True));
        array_push($cp, array('$C1', 'p_test', msg('p_test'), False, True));
        array_push($cp, array('$C1', 'p_shared', msg('p_shared'), False, True));
        array_push($cp, array('$C1', 'p_visibility', msg('p_visibility'), False, True));
        array_push($cp, array('$HV', 'p_update', date("Y-m-d"), True, True));
        if ($id == 0) {
            array_push($cp, array('$HV', 'p_user', $user, True, True));
            array_push($cp, array('$HV', 'p_templat', $templat, True, True));
            array_push($cp, array('$HV', 'p_token', $token, True, True));
        }

        $form = new form;
        $form -> id = $id;
        $sx = $form -> editar($cp, 'dcr_plans');
        if ($form -> saved > 0) {
            redirect(base_url(PATH . 'plan/1'));
        }
        return ($sx);
    }

}
?>
