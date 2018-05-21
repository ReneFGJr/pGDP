<body style="background: url('img/background/bg.png') repeat-x;">
<?php
$mn = array('','active','','','','','','','','');
?>
<nav class="navbar navbar-toggleable-md bg-faded navbar">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#"><img src="<?php echo base_url('img/logo_gdp.png');?>" height="50"></a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo $mn[0];?>">
        <a class="nav-link" href="#"><?php echo msg('Home');?> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo $mn[1];?>">
        <a class="nav-link" href="#"><?php echo msg('Link');?></a>
      </li>
      <li class="nav-item <?php echo $mn[2];?>">
        <a class="nav-link" href="#"><?php echo msg('Disabled');?></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action"<?php echo base_url("search");?>">
      <input class="form-control mr-sm-2" type="text" placeholder="<?php echo msg('Search');?>">
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><?php echo msg('Search');?></button>
    </form>
    &nbsp;&nbsp;&nbsp;
    <ul class="navbar-nav">
      <li class="nav-item text-right">
        <a class="btn btn-warning" href="#"><?php echo msg('Sign In');?> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item text-right">
        <a class="btn btn-warning" href="#" onclick="newxy('<?php echo base_url('index.php/help');?>',600,800);"><?php echo msg('HELP');?></a>
      </li>      
    </ul>    
  </div>
</nav>