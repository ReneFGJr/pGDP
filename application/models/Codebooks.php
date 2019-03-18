<?php
class codebooks extends CI_model {
    function type_var($a = '') {
        $type = 'String';
        $am = troca($a, ',', '');
        $am = troca($am, '.', '');
        $am = troca($am, '$', '');
        /* Numeric */
        if ($am == sonumero($a)) {
            $type = 'Numeric';
        }
        /* Data */
        $an = troca($a, '-', '/');
        $am = troca($am, '-', '/');
        if ((substr($an, 2, 1) == '/') and (substr($an, 5, 1) == '/')) {
            $am = troca($am, '/', '');
            if ($am == sonumero($a)) {
                $type = 'DateDMY';
            }
        }
        if ((substr($an, 4, 1) == '/') and (substr($an, 7, 1) == '/')) {
            $am = troca($am, '/', '');
            if ($am == sonumero($a)) {
                $type = 'DateYMD';
            }
        }
        return ($type);
    }

    function process_file($file = '', $id = 1) {
        $file = 'd:\lixo\dadosbrutos012018.csv';
        $ln = 0;

        $hd = array();
        $hd_min = array();
        $hd_sample = array();
        $hd_max = array();
        $hd_type = array();

        $handle = fopen($file, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                switch($ln) {
                    case 0 :
                        $hd = splitx(',', $line);
                        break;
                    case 1 :
                        $hda = splitx(',', $line);
                        for ($r = 0; $r < count($hd); $r++) {
                            $hd_type[$r] = $this -> type_var($hda[$r]);
                            $hd_sample[$r] = $hda[$r];
                            if ($hd_type[$r] != 'String') {
                                $hd_min[$r] = $hda[$r];
                                $hd_max[$r] = $hda[$r];
                            } else {
                                $hd_min[$r] = '-';
                                $hd_max[$r] = '-';
                            }
                            $hd_sample[$r] = $hda[$r];
                        }
                        break;
                    default :
                        $hda = splitx(',', $line);
                        for ($r = 0; $r < count($hd); $r++) {
                            /* Minimun */
                            if (($hd_type[$r] == 'Numeric') and ($hd_min[$r] > $hda[$r])) {
                                $hd_min[$r] = $hda[$r];
                            }
                            /* Maximum */
                            if (($hd_type[$r] == 'Numeric') and ($hd_max[$r] < $hda[$r])) {
                                $hd_max[$r] = $hda[$r];
                            }
                        }
                        break;
                }
                $ln++;

            }
            fclose($handle);
        } else {
            // error opening the file.
        }
        $sx = 'Total de ' . number_format($ln, 0, ',', '.') . ' linhas processadas';

        $cb = array();
        for ($r = 0; $r < count($hd); $r++) {
            $cb[$r]['name'] = $hd[$r];
            $cb[$r]['type'] = $hd_type[$r];
            $cb[$r]['min'] = $hd_min[$r];
            $cb[$r]['max'] = $hd_max[$r];
            $cb[$r]['sample'] = $hd_sample[$r];
            $sql = "select * from codebook_vars where cv_var_name='" . $hd[$r] . "' and cv_codebook = $id";
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
            if (count($rlt) > 0) {

            } else {
                $sql = "insert into codebook_vars
                                    (
                                    cv_codebook, cv_var_name, cv_var_description,
                                    cv_var_type, cv_var_range, cv_comments,
                                    cv_order
                                    )
                                    values
                                    (
                                    '" . $id . "','" . $cb[$r]['name'] . "','',
                                    '" . $cb[$r]['type'] . "','" . $cb[$r]['min'] . '-' . $cb[$r]['max'] . "','" . $cb[$r]['sample'] . "',
                                    '" . ($r + 1) . "'
                                    )
                                ";
                $this -> db -> query($sql);
            }
        }
        return ($sx);

    }

    function le($id) {
        $sql = 'select * from codebook
                            INNER JOIN users ON cb_own = id_us 
                            where id_cb = ' . sonumero($id);
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $line = $rlt[0];

            $sql = "select * from codebook_vars where cv_codebook = $id and cv_ativo = 1 order by cv_order";
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
            $line['code'] = $rlt;
            return ($line);
        } else {
            return ( array());
        }
    }

    function view($id = 0) {
        $data = $this -> le($id);
        $sx = '<div class="col-md-12"><h1>' . $data['cb_name'] . '</h1></div>' . cr();
        $sx .= '<div class="col-md-6"><i>' . $data['us_nome'] . '</i></div>';

        /* Code Book */
        $code = $data['code'];
        $sx .= $this -> code_list($code, 1);

        //$sx = $this -> process_file();
        return ($sx);
    }

    function code_list($code, $type = 1) {
        $sx = '';
        switch($type) {
            case 1 :
                $sx .= '<table class="table" id="codes">';
                $sx .= '<tr>';
                $sx .= '<th width="5%">'.msg('cv_order').'</th>'.cr();
                $sx .= '<th width="15%">'.msg('cv_var_name').'</th>'.cr();
                $sx .= '<th width="25%">'.msg('cv_var_description').'</th>'.cr();
                $sx .= '<th width="5%">'.msg('cv_var_type').'</th>'.cr();
                $sx .= '<th width="20%">'.msg('cv_var_range').'</th>'.cr();
                $sx .= '<th width="30%">'.msg('cv_comments').'</th>'.cr();
                $sx .= '</tr>'.cr();                
                for ($r = 0; $r < count($code); $r++) {
                    $line = $code[$r];
                    $sx .= '<tr>';
                    $sx .= '<td>'.$line['cv_order'].'</td>';
                    $sx .= '<td>'.$line['cv_var_name'].'</td>';
                    $sx .= '<td>'.$line['cv_var_description'].'</td>';
                    $sx .= '<td>'.$line['cv_var_type'].'</td>';
                    $sx .= '<td>'.$line['cv_var_range'].'</td>';
                    $sx .= '<td>'.$line['cv_comments'].'</td>';
                    $sx .= '</tr>';
                }
                $sx .= '</table>';
                break;
            default :
                $sx .= '<table class="table" id="codes">';

                for ($r = 0; $r < count($code); $r++) {
                    $line = $code[$r];
                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_order') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_order'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_var_name') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_var_name'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_var_description') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_var_description'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_var_type') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_var_type'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_var_range') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_var_range'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr>';
                    $sx .= '<td>' . msg('cv_comments') . '</td>' . cr();
                    $sx .= '<td>' . $line['cv_comments'] . '</td>' . cr();
                    $sx .= '</tr>';

                    $sx .= '<tr><td><hr/></td><td><hr/></td></tr>' . cr();
                }
                $sx .= '</table>' . cr();
                $sx .= '<script> $(document).ready( function () { $(\'#codes\').DataTable(); } ); </script>' . cr();
                break;
        }
        return ($sx);
    }

    function row() {
        if (!isset($_SESSION['id'])) {
            redirect(base_url(PATH));
        }
        $user = $_SESSION['id'];
        $form = new form;
        $form -> fd = array('id_cb', 'cb_name', 'cb_created', 'cb_update');
        $form -> lb = array('id', msg('CB_NAME'), msg('CB_CREATED'), msg('CB_UPDATE'));
        $form -> mk = array('L', 'L', 'D', 'D');
        $form -> see = True;
        $form -> row_view = base_url(PATH . 'codebook/view');
        $form -> tabela = 'codebook';
        $tela = row2($form);
        return ($tela);
    }

}
?>
