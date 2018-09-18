<style>
    .pgdp {
        color: white;
        font-family: Dosis, Arial;
    }
    .pgdp_td {
        font-size: 800%;
        padding: 150px 20px 0px 20px;
        border: 1px solid #ffffff;
        vertical-align: bottom;
    }
    .bottom {

        position: absolute;
        bottom: 0px;
        right: 0px;
        padding: 0px 30px;
    }
    .btn-outline-primary
        {
            color: #ffffff;
            border-color: #ffffff;
        }
    .btn-outline-primary:hover
        {
            color: #00000;
            border-color: #ffffff;
            background-color: #330011;
        }        
</style>
<body class="bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<table align="center" class="pgdp" >
					<tr>
						<td class="pgdp_td">P</td>
						<td class="pgdp_td">G</td>
						<td class="pgdp_td">D</td>
						<td class="pgdp_td">P</td>
					</tr>
					<tr>
						<td colspan=4 style="font-size: 200%;">Plano de Gestão de Dados de Pesquisa</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
    <br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="<?php echo base_url("index.php/pgdp/social/login");?>"><span class="btn btn-outline-secondary"><?php echo msg("create_a_dmp");?></span></a>
			</div>
		</div>
	</div>

	<div class="bottom">
		<a href="http://www.ufrgs.br;"> <img src="<?php echo base_url('img/sponser/ufrgs_inverse.png'); ?>" height="120" border=0> </a>
	</div>

</body>