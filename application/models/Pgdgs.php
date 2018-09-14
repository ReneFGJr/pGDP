<?php
class pgdgs extends CI_model
    {
        function list_fields($pg='')
            {
                $sql = "select * from dcr_fields 
                            order by f_group, f_descript";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                
                $sx = '<table width="100%" class="table">'.cr();
                $sx .= '<tr>';
                $sx .= '<th width="5%">'.msg('#').'</th>'.cr();
                $sx .= '<th width="90%">'.msg('f_descript').'</th>'.cr();
                $sx .= '<th width="5%">'.msg('f_group').'</th>'.cr();
                $sx .= '</tr>';
                
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $sx .= '<tr>';
                        $sx .= '<td align="center">'.($r+1).'</td>';
                        $sx .= '<td>'.msg($line['f_descript']).'</td>';
                        $sx .= '<td align="center">'.msg($line['f_group']).'</td>';
                        $sx .= '</tr>';
                    }
                $sx .= '</table>';
                $sx .= '<a href="'.base_url(PATH.'plan_fields/0').'" class="btn btn-outline-primary">';
                $sx .= msg('new_field');
                $sx .= '</a>';
                return($sx);
            }
        function cp_fields($id=0)
            {
                $cp = array();
                array_push($cp,array('$H8','id_f','',false,true));
                array_push($cp,array('$S100','f_descript',msg('f_descript'),true,true));
                array_push($cp,array('$[1-9]','f_group',msg('f_group'),true,true));
                array_push($cp,array('$O 1:'.msg('Yes').'&0:'.msg('No'),'f_active',msg('f_active'),true,true));
                array_push($cp,array('$T80:5','f_form',msg('f_form'),true,true));
                $form = new form;
                $form->id = $id;
                $sx = $form->editar($cp,'dcr_fields');
                if ($form->saved > 0)
                    {
                        redirect(base_url(PATH.'plan_fields'));
                    }
                return($sx);
            }
        function plan_new()
            {
               $sx = '';
               $sql = "select * from dcr_templat where t_active = 1";
               $rlt = $this->db->query($sql);
               $rlt = $rlt->result_array();
               
               $sx .= '<div class="row">'.cr();
               $sx .= '<div class="col-md-12">'.cr();
               $sx .= '<h3>'.msg('CREATE_PLAN').'</h3>'.cr();
               $sx .= '<ul>'.cr();
               for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $link = '<a href="'.base_url(PATH.'plan/1/'.$line['id_t']).'">';
                        $sx .= '<li>'.$link.msg('templat_'.$line['t_name']).'</a>'.'</li>'.cr();
                    }
               $sx .= '<ul>'.cr();
               $sx .= '</div>'.cr();
               $sx .= '</div>'.cr();
               return($sx); 
            }
            
        function plan_form($id,$p='')
            {
                $sql = "select * FROM dcr_form
                            INNER JOIN dcr_fields ON fr_field = id_f 
                            WHERE fr_templat = $id and fr_group = $p
                            ORDER by fr_group, fr_page, fr_order";
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                $cp = array();
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $obr = $line['fr_majoritary'];
                        $type = $line['f_form'];
                        $name = $line['f_descript'];
                        $rw = $line['f_readwrite'];
                        $obr = $line['fr_majoritary'];
                        array_push($cp,array($type,'',msg($name),$obr,$rw));
                    }
                $form = new form;
                $sx = $form->editar($cp,'');                                   
                return($sx);
            }
        function plan_menu($p)
            {
                $id = 1;
                $sql = "SELECT d_descript, fr_page FROM `dcr_form`
                            inner join dcr_groups on fr_group = id_d
                            where fr_templat = 1
                            group by d_descript, fr_page
                            order by fr_page";
                            
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                
                $sx = '<table width="100%" class="table">'.cr();
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
						$active = '';
						if ($r==0)
							{
								$active = 'plan_menu_active';
							}
                        $name = $line['d_descript'];
                        $pg = $line['fr_page'];
						$link = '<a href="'.base_url(PATH.'plan/'.$id.'/'.($r+1)).'">';
                        $sx .= '<tr class="plan_menu"><td class="'.$active.' text-right" style="border-right: 1px solid #c0c0c0;" >'.$link.msg($name).'</a>'.'</td></tr>';        
                    }                                            
                $sx .= '</table>'.cr();
                return($sx);
            }
        function form($id=0,$templat=1)
            {
                    
            }
    }
?>
