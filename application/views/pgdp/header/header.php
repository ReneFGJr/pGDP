<!doctype html>
<?php
if (!isset($title)) { $title = 'no title';
}
?>
<head>
    <head lang="pt-br">
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>    
    <link href="https://fonts.googleapis.com/css?family=Dosis|Titillium+Web" rel="stylesheet">
    <META NAME="title" CONTENT="Plano de Gestão de Dados de Pesquisa">
    <META NAME="url" CONTENT="<?php echo base_url();?>">
    <META NAME="description" CONTENT="Base de dados de Periódicos em Ciência da Informação publicadas no Brasil desde 1972.">
    <META NAME="keywords" CONTENT="artigos científicos, revistas científicas, ciência da informação, biblioteconomia, arquivologia">
    <META NAME="copyright" CONTENT="Brapci">
    <LINK REV=made href="brapcici@gmail.com">
    <META NAME="language" CONTENT="Portugues">
    <META NAME="Robots" content="All">
    <META NAME="City" content="Curitiba/Porto Alegre">
    <META NAME="State" content="PR - Paraná / RS - Rio Grande do Sul">
    <META NAME="revisit-after" CONTENT="7 days">
    <META HTTP-EQUIV="Content-Language" CONTENT="pt_BR">
    <meta name="google-site-verification" content="VZpzNVBfl5kOEtr9Upjmed96smfsO9p4N79DZT38toA" />
    
    <link rel="icon" href="<?php echo base_url('img/favicon.png');?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.png');?>" type="image/x-icon" /> 
    <link rel="icon" type="image/png" href="<?php echo base_url('favicon-32x32.png');?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo base_url('favicon-16x16.png');?>" sizes="16x16" />   
    
    <!--- CSS --->
    <link href="<?php echo base_url('css/bootstrap.min.css?v4.0'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css?v0.3'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/jquery-ui.css?v1.12.1'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style_form_sisdoc.css?v1.12.1'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/jquery.dataTables.min.css');?>">
    
    
    <!--- JS ---->
    <script src="<?php echo base_url('js/jquery-3.3.1.min.js?v3.3.1'); ?>"></script>
    <script src="<?php echo base_url('js/utils.js?v3.3.1'); ?>"></script>
    <script src="<?php echo base_url('js/tether.js?v3.3.1'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js?v4.0'); ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui.js?v1.12.1'); ?>"></script>
    <script src="<?php echo base_url('js/sisdoc_form.js?v1.1.1'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.dataTables.min.js');?>"></script>
<!---    
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] ||
        function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-12713129-1', 'auto');
    ga('send', 'pageview'); 
</script>
--->   
</head>
