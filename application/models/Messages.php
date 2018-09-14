<?php
class messages extends CI_Model {
	var $language = 'es';
	var $email_reply = '';
	var $email_name = '';
	var $smtp = '';
	var $smtp_user = '';
	var $smtp_pass = '';
	var $smtp_type = '';
	var $smtp_port = '465';
	var $sign = '';
	var $testmode = 1;
	var $testmode_email = 'renefgj@gmail.com';

	function __construct() {
		global $email_from, $email_from_name, $email_port, $email_smtp, $email_pass, $email_user, $email_auth, $email_debug, $email_replay, $email_sign;
		return ('');
	}

	/**
	 * Campos de edicao e alteracao da tabela
	 */
	function cp() {
		$cp = array();
		array_push($cp, array('$H4', 'id_msg', 'id_nw', False, False, ''));
		array_push($cp, array('$S80', 'msg_field', msg('msg_field'), False, False, ''));
		array_push($cp, array('$T80:5', 'msg_content', msg('page_ref'), True, True, ''));
		array_push($cp, array('$HV', 'msg_update', date("Ymd"), True, True, ''));
		//dd5
		return ($cp);
	}


	function messages_modal_edit($id, $frame = 'myModal') {
		$texto = 'SAMPLE';
		$sx = '<div class="modal fade" id="' . $frame . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">' . msg('email_template') . '</h4>
					      </div>
					      <div class="modal-body">
					        <p>' . $texto . ';</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary">Save changes</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->';
		return ($sx);
	}

	function email_icone($id) {
		$state = 'danger';
		$frame = "edit_email";
		$sx = $this -> messages_modal_edit(0, $frame);
		$sx .= '<font class="glyphicon glyphicon-envelope ' . $state . '" aria-hidden="true" title="' . msg("send_email") . '" data-toggle="modal" data-target="#' . $frame . '"></font>';

		return ($sx);
	}

	function show_messages($id) {
		$toti = 0;
		$btn = '';
		if ($toti > 0) {
			$btn = 'btn-primary';
		}
		$sx = '
				<button class="btn ' . $btn . '" type="button" id="messages">
				  ' . msg('messages') . ' <span class="badge">' . $toti . '</span>
				</button>';
		return ($sx);
		$sx = '
				<button class="btn btn-primary" type="button" id="messages">
				  Messages <span class="badge">4</span>
				</button>			
			';
		return ($sx);
	}

	function show_messages_list($id) {
		$sx = '			
				<div class="panel panel-default" style="display: none; margin-top: 20px;" id="messages_list">
				  <div class="panel-heading">' . msg('messages_with_investigator') . '</div>
				  <div class="panel-body">
				    <table width="100%" class="table lt1">
				    <tr class="lt0">
				    	<th width="5%">' . msg('hd_data') . '</th>
				    	<th width="5%">' . msg('hd_hora') . '</th>
				    	<th width="90%">' . msg('hd_comment') . '</th>
				    </tr>
				    </table>
				  </div>
				</div>			
				
			<script>
				$("#messages").click(function() {
					$("#messages_list").slideToggle( "slow", function() { });
				});
			</script>
			';
		return ($sx);
	}

	function create() {
		$id = array('english', 'spanish', 'portuguese', 'french');
		$ir = array('en', 'es', 'pt-BR', 'fr');
		$s = '';
		for ($r = 0; $r < count($ir); $r++) {
			$filename = 'language/' . $id[$r] . '/pgdp_lang.php';
			$tp = $ir[$r];
			$sql = "select * from _messages where msg_language = '$tp' ";
			$rlt = $this -> db -> query($sql);
			$rlt = $rlt -> result_array();
			$sx = '<?php' . cr();
			for ($y = 0; $y < count($rlt); $y++) {
				$line = $rlt[$y];
				$m1 = utf8_decode($line['msg_content']);
				$sx .= '$lang[\'' . $line['msg_field'] . '\'] = \'' . $m1 . '\';' . cr();
			}
			$sx .= '?>' . cr();
			$s .= msg('export').' '.$filename.'<br>';
			$dir = $_SERVER['SCRIPT_FILENAME'];
			$dir = troca($dir,'index.php','application/');
			$handle = fopen($dir.$filename, 'w+');
			fwrite($handle, $sx);
			fclose($handle);									
		}
		$s .= bs_alert('success',msg('success')); 
		return($s);
	}

	function row() {
		$form = new form;
		$form -> fd = array('id_msg', 'msg_field', 'msg_content', 'msg_language');
		$form -> lb = array('id_msg', msg('msg_field'), msg('msg_content'), msg('msg_language'));
		$form -> mk = array('', '', '', '', '', '', '', '', '');
		$form -> edit = true;
		$form -> row = base_url(PATH.'config/message_edit');
		$form -> row_edit = base_url(PATH.'config/message_edit');
		$form->tabela = '_messages';
		$sx = row($form);
		return ($sx);
	}

	function editar($id)
		{
			$form = new form;
			$form->id = $id;
			$cp = $this->cp($id);
			$tela = $form->editar($cp,'_messages');
			if ($form->saved > 0)
				{
					redirect(base_url(PATH.'config/message_edit'));
				}
			return($tela);
		}
	function recover($idm, $data) {
		$lang = $this -> language;
		$sql = "select * from ic_noticia where nw_ref = '$idm' and nw_idioma = '$lang'";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$msg = $rlt[0];

			/* usuario */
			if (isset($data['us_senha'])) { $msg['nw_descricao'] = troca($msg['nw_descricao'], '$password', $data['us_senha']);
			}
			if (isset($data['us_nome'])) { $msg['nw_descricao'] = troca($msg['nw_descricao'], '$name', $data['us_nome']);
			}
			$msg['nw_descricao'] = troca($msg['nw_descricao'],chr(13),'<br>');
			$msg['nw_descricao'] = troca($msg['nw_descricao'],chr(10),'');
			return ($msg);
		} else {
			return ( array());
		}
	}

	function email_to_user($id, $messa, $proto = '') {
		$subject = $messa['nw_titulo'];
		$content = $messa['nw_descricao'];

		$sql = "select * from usuario where id_us = " . round($id);
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$erro = msg('not_send');
		if (count($rlt) > 0) {
			$line = $rlt[0];

			/* Emails */
			$email_1 = $line['us_email'];
			$email_2 = $line['us_email_alt'];
			$to = array();
			if (strlen($email_1) > 0) { array_push($to, $email_1);
			}
			if (strlen($email_2) > 0) { array_push($to, $email_2);
			}
			//$ok = $this -> messages -> sendmail($to, $subject, $content);
			$erro = sendmail($to[0],$subject,$content,'');
		}
		return ($erro);

	}

	function validaemail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			list($alias, $domain) = explode("@", $email);
			if (checkdnsrr($domain, "MX")) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
?>
