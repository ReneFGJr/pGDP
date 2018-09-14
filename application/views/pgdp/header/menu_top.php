<style>
	.logo_td
	{
		border: 1px solid #FFFFFF; padding: 15px 0px 0px 0px; margin-left: 2px; width: 20px; text-align: center; background: #330011; color: white;
		font-family: Dosis, Arial, Helvetica, sans-serif;
	}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light zmdi">
  <a class="navbar-brand" href="<?php echo base_url(PATH.'main');?>">
  	<table><tr>
  		<td class="logo_td">P</td>
  		<td class="logo_td">G</td>
  		<td class="logo_td">D</td>
  		<td class="logo_td">P</td>
	</tr></table>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(PATH.'main');?>"><?php echo msg('home');?> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(PATH.'plan');?>"><?php echo msg('plan');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo msg('help');?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo msg('configurations');?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url(PATH.'plan_fields');?>"><?php echo msg('config_plan_fields');?></a>
          <a class="dropdown-item" href="<?php echo base_url(PATH.'config');?>"><?php echo msg('config_system');?></a>
        </div>
      </li>
    </ul>
  </div>
</nav>