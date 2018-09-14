<?php
if (!function_exists(('msg')))
	{
		function msg($t)
			{
				$lang = 'pt-BR';
				$CI = &get_instance();
				if (strlen($CI->lang->line($t)) > 0)
					{
						return($CI->lang->line($t));
					} else {
						$sql = "select * from _messages where msg_field = '$t' and msg_language = '$lang' ";
						$rlt = $CI->db->query($sql);
						$rlt = $rlt->result_array();
						if (count($rlt) > 0)
							{
								$line = $rlt[0];
								return($line['msg_content']);
							} else {
								$date = date("Ymd");
								$sql = "insert into _messages (msg_language, msg_field, msg_content, msg_ativo, msg_update) values ('$lang','$t','$t',1,$date)";
								$rlt = $CI->db->query($sql);
								return($t);
							}
						return($t);
					}
			}
	}
?>