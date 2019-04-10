<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo base_url( HTTP .'main'); ?>">
    <table><tr>
        <td class="logo_td">#</td>
        <td class="logo_td">G</td>
        <td class="logo_td">D</td>
        <td class="logo_td">P</td>
    </tr></table>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url( HTTP .'main'); ?>"><?php echo msg('Home');?><span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url( HTTP .'codebook'); ?>"><?php echo msg('Codebook');?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo msg('configurations'); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url( HTTP .'templat'); ?>"><?php echo msg('config_plan_templat'); ?></a>
          <a class="dropdown-item" href="<?php echo base_url( HTTP .'plan_fields'); ?>"><?php echo msg('config_plan_fields'); ?></a>
          <a class="dropdown-item" href="<?php echo base_url( HTTP .'config'); ?>"><?php echo msg('config_system'); ?></a>
          <a class="dropdown-item" href="<?php echo base_url( HTTP .'institutions'); ?>"><?php echo msg('institutions'); ?></a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url( HTTP .'about'); ?>"><?php echo msg('about');?></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <?php echo $this -> socials -> menu_user(); ?>
        </li>  
        </ul>    
    </form>
  </div>
</nav>

<style>
    .logo_td {
        border: 1px solid #FFFFFF;
        padding: 15px 0px 0px 0px;
        margin-left: 2px;
        width: 20px;
        text-align: center;
        background: #330011;
        color: white;
        font-family: Dosis, Arial, Helvetica, sans-serif;
    }
</style>