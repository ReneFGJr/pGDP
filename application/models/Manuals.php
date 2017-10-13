<?php
class manuals extends CI_model
    {
        function check()
            {
                if (!is_dir('img'))
                    {
                        mkdir('img');
                    }
                if (!is_dir('img/help'))
                    {
                        mkdir('img/help');
                    }
            }
        function busca_indice($t='')
            {
                $t = troca($t,' ',';').';';
                $t = troca($t,' da ','');
                $t = troca($t,' de ','');
                $t = troca($t,' do ','');
                $t = troca($t,' seu ','');
                $t = troca($t,' sua ','');
                $t = troca($t,' para ','');
                $te = splitx(';',$t);
                $wh1 = '';
                $wh2 = '';
                for ($r=0;$r < count($te);$r++)
                    {
                        $tt = $te[$r];
                        if (strlen($wh1) > 0)
                            {
                                $wh1 .= ' and ';
                                $wh2 .= ' and ';
                            }
                        $wh1 .= " (h_name like '%$tt%') ";
                        $wh2 .= " (h_keywords like '%$tt%') ";
                    }
                $wh = ' where ('.$wh1.') or ('.$wh2.')';
                $sx = '';
                $sql = "select * from _help ".$wh;
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                
                /*
                 * RESPOSTA ÚNICA
                 */
                if (count($rlt) == 0)
                    {
                        $sx = '<br><center>Página não encontrada</center></br>';
                        return($sx);
                    }


                /*
                 * RESPOSTA ÚNICA
                 */
                if (count($rlt) == 1)
                    {
                        $line = $rlt[0];
                        redirect(base_url('index.php/help/item/'.$line['id_h']));
                    }
                
                $sx .= cr().'<div class="container-fluid">'.cr();
                $sx .= '    <div class="row">'.cr();
                $sx .= '        <div class="col-md-12">'.cr();
                $sx .= '            <ul>'.cr();
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $link = base_url('index.php/help/item/'.$line['id_h']);
                        $link = '<a href="'.$link.'">';
                        
                        $sx .= '            <li>'.$link.$line['h_name'].'</a>'.'</li>'.cr();                        
                    }
                $sx .= '            </ul>'.cr();
                $sx .= '        </div>'.cr();
                $sx .= '    </div>'.cr();
                $sx .= '</div>'.cr(); 
                return($sx);
            }
        function show($id='')
            {
                $wh = '';
                if (strlen($id)==0)
                    {                        
                        $id = 1;
                    }
                $wh = ' where id_h = '.$id;
                $sx = '';
                $sql = "select * from _help ".$wh;
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                $sx .= cr().'<div class="container-fluid">'.cr();
                $sx .= '    <div class="row">'.cr();
                
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $sx .= '        <div class="col-md-12">'.cr();
                        $sx .= '            <h4>'.$line['h_name'].'</h4>'.cr();
                        $sx .= '        </div>'.cr();
                        
                        if (strlen($line['h_description']) > 0)
                            {
                                $sx .= '        <div class="col-md-12">';
                                $sx .= $this->format($line['h_description']);
                                $sx .= '</div>';                                
                            }
                    }
                $sx .= '    </div>'.cr();
                $sx .= '</div>'.cr();
                
                $sx .= $this->show_derivate($id);
                return($sx);                
            }
        function show_derivate($id)
            {
                $sx = '';
                $wh = "where h_master = ".$id;
                $sql = "select * from _help ".$wh;
                $rlt = $this->db->query($sql);
                $rlt = $rlt->result_array();
                $sx .= '<div class="container-fluid">'.cr();
                $sx .= '    <div class="row">'.cr();
                $sx .= '        <div class="col-md-12">'.cr();
                $sx .= '            <ul>'.cr();
                
                for ($r=0;$r < count($rlt);$r++)
                    {
                        $line = $rlt[$r];
                        $link = base_url('index.php/help/item/'.$line['id_h']);
                        $link = '<a href="'.$link.'">';
                        $sx .= '                <li>'.$link.$line['h_name'].'</a>'.'</li>'.cr();
                    }
                $sx .= '            </ul>'.cr();
                $sx .= '        </div>'.cr();
                $sx .= '    </div>'.cr();
                $sx .= '</div>'.cr();  
                return($sx);
            }
        function back()
            {
                $sx = '<div style="position:absolute; bottom:0; right:0;">
                        <a href="#" onclick="window.history.back();" class="btn btn-default">voltar</a>
                        <a href="#" onclick="window.close();" class="btn btn-default">fechar</a>
                       <div>
                      ';
                return($sx);
            }
            
        function imagens($t)
            {
                $t = troca($t,'[[','{');
                $t = troca($t,']]','}');               
                
                $p = strpos($t,'{');
                $l = 0;          
                while (($p > 0) and ($l < 10))
                    {
                        $l++;
                        $f = strpos($t,'}');
                        
                        $term = substr($t,$p+1,$f-$p-1);
                        $term_asc = lowercaseSQL($term);
                        $term_asc = troca($term_asc,' ','_');
                        $tl = '<div class="col-md-4 col-md-offset-4"><img src="'.base_url('img/help/'.$term_asc).'" style="width: 100%; border: 1px solid #808080;" class=" img-responsive"></div>';
                        $t = substr($t,0,$p).$tl.substr($t,$f+1,strlen($t));
                        $p = strpos($t,'{');
                    }
                $t = troca($t,'}','">'.chr(13).chr(10));
                $t = troca($t,'[::1]','¢');
                return($t);                
            }

        function format($t)
            {
                $link = '<a href="'.base_url('index.php/help/indice/');
                $its = '<ul>'.chr(13).chr(10);  
                $l = 0;
                $t = $this->imagens($t);
                
                $t = troca($t,'[','{');
                $t = troca($t,']','}');               
                
                $p = strpos($t,'{');          
                while (($p > 0) and ($l < 10))
                    {
                        $l++;
                        $f = strpos($t,'}');
                        
                        $term = substr($t,$p+1,$f-$p-1);
                        $term_asc = lowercaseSQL($term);
                        $term_asc = troca($term_asc,' ','_');
                        $link = '<a href="'.base_url('index.php/help/indice/'.$term_asc).'">';
                        $tl = $link.$term.'</a>';
                        $its .= '<li>'.$link.$term.'</a>'.'</li>'.chr(13).chr(10);
                        $t = substr($t,0,$p).$tl.substr($t,$f+1,strlen($t));
                        $p = strpos($t,'{');
                    }
                $its .= '</ul>'.chr(13).chr(10);
                $t = troca($t,'}','">'.chr(13).chr(10));
                
                $t = troca($t,'¢','[::1]');

                return($t);
            }
        function header()
            {
                $sx = '
                    <!DOCTYPE html>
                    <html lang="pt-BR">
                        <header>
                            <meta charset="utf-8">
                            <meta name="PGDP" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    
                            <title>Manual</title>
                    
                            <!-- Twitter -->
                            <meta name="twitter:site" content="@dpgp">
                            <meta name="twitter:creator" content="@dpgp">
                    
                            <!-- Meta -->
                            <meta name="description" content="PGDP">
                            <meta name="author" content="Rene Faustino Gabriel junior <renefgj@gmail.com">
                    
                            <!-- Bootstrap core CSS -->
                            <link href="'.base_url('css/bootstrap.min.css').'" rel="stylesheet">
                            <link href="'.base_url('css/style.css').'" rel="stylesheet">
                            
                            <!-- JS ------------------>
                            <script src="'.base_url('js/utils.js').'"></script>
                                    
                            <script src="'.base_url('js/jquery.min.js').'"></script>             
                            
                            <script src="'.base_url('js/tether.js').'"></script>
                            <script src="'.base_url('js/bootstrap.min.js').'"></script>
                            <script src="'.base_url('js/form_sisdoc.js').'"></script>                         
                    
                            <!-- Favicons -->
                            <link rel="apple-touch-icon" href="/apple-touch-icon.png">
                            <link rel="icon" href="/favicon.ico">
                ';
                return($sx);
            }
        function cab()
            {
            $mn = array('','active','','','','','','','','');
            $sx = '
            <nav class="navbar navbar-toggleable-md bg-faded navbar-inverse bg-inverse">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="#">Manual</a>
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item '.$mn[0].'">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item .'.$mn[1].'">
                    <a class="nav-link" href="#">Index</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action"'.base_url("busca").'">
                  <input class="form-control mr-sm-2" type="text" placeholder="Busca">
                  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Busca</button>
                </form>
              </div>
            </nav>';
            return($sx);                
            }            
    }
?>