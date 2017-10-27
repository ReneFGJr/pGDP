<?php
class socials extends CI_model
    {
    
    function action()
        {
            $r_name = get("register_name");
            $r_email = get("register_email");
            $r_password = get("register_password");
            $r_action = get("action");
            
            switch($r_action)
                {
                case 'register':
                    $this->register($r_name,$r_email,$r_password);
                }
        }  
    function register($n,$e,$p)
        {
            $sql = "select * from wp_users where user_email = '$e'";
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            
            echo md5('448545ct');
            echo '<br>'.crypt('448545ct');
            exit;
        }       
    }
?>
