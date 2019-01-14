<?php
class pgdps extends CI_model
    {
    function le($id=0)
        {
            $sql = "select * from pgdp_plans
                        INNER JOIN pgdp_templat ON pl_templat = id_t
            ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) > 0)
                {
                    return($rlt[0]);
                } else {
                    return(array());
                }
        }
    function list_plan($id=0)
        {
            $data = $this->le($id);
            $tp = $data['pl_templat'];
            
            $sx = '';
            $sx .= $this->load->view('pgdp/plan_info',$data,true);
            $sql = "select * from pgdp_templat_itens
                        LEFT JOIN pgdp_form_type on it_type = id_f
                        where it_tp = $tp and it_status = 1
                        order by it_ord, id_ord_sub ";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            $sx .= '<table class="table" width="100%">'.cr();
            $id = 0;
            for ($r=0;$r < count($rlt);$r++)
                {
                    $line = $rlt[$r];
                    $it = $line['id_it'];
                    $item = $line['id_ord_sub'];
                    if ($item == 0)
                        {
                            $id++;
                        }
                    if ($item > 0)
                        {
                            $sx .= '<tr>';
                            $sx .= '<td class="text-center">';
                            $sx .= $id;
                            $sx .= '.'.$item;
                            $sx .= '</td>';
                            
                            $sx .= '<td>';
                            $sx .= $line['it_field'];
                            $sx .= '</td>'; 
                            
                            $sx .= '<td>';
                            $sx .= '<!-- Large modal -->
                                        <button class="btn btn-primary" data-toggle="modal" data-target=".id'.$it.'">?</button>';
                            $sx .= '
                            <div class="modal fade bd-example-modal-lg id'.$it.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">                                            
                                            <div class="modal-content">
                                                <div class="row">
                                                <h3>Título</h3>
                                                '.$line['it_descrition'].'
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         </div>
                                      </div>';                           
                        } else {
                            $sx .= '<tr>';
                            $sx .= '<td class="text-center">';
                            $sx .= $id;
                            $sx .= '</td>';                      
                            $sx .= '<td colspan=2>';
                            $sx .= $line['it_field'];
                            $sx .= '</td>';
                            
                            $sx .= '</tr>';
                            $sx .= '<tr>';
                            $sx .= '<td></td>';
                            $sx .= '<td></td>';                            
                        }
                    $sx .= '</tr>'.cr();
                    
                    
                }
            $sx .= '</table>';
            return($sx);
        }      
    }
?>
