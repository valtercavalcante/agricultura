<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SIGEV - I SEMPREIFPI</title>
	<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("/assets/css/bootstrapdatatable.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("/assets/datepiker/jquery-ui.css"); ?>" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/datepiker/jquery-ui.js"); ?>"></script>			
	<script src="<?php echo base_url("/assets/js/bootstrap_toolstip.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/js/datatable.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/js/bootstrap-confirmation.js"); ?>"></script>
	
<script type="text/javascript">
  $(document).ready(function() {
    $('#tabela').dataTable({
        "sPaginationType": "full_numbers"
    });
});
  $(document).ready(function() {
    $('#tabela1').dataTable({
        "sPaginationType": "full_numbers"
    });
});
!function() {

  $(function(){
  
    $('[data-toggle="confirmation"]').confirmation({
    	title: 'Confirma a exclusão?',
    	btnOkClass: 'btn btn-danger btn-xs',
    	btnCancelClass: 'btn btn-default btn-xs',
    });
    //$('[data-toggle="confirmation-singleton"]').confirmation({singleton:true});
    //$('[data-toggle="confirmation-popout"]').confirmation({popout: true});

  })

}(window.jQuery)

 $(function() {
	  
	    $( "#datepicker" ).datepicker()
	  });
  </script>
</head>
<body background="<?php echo base_url("/assets/images/bg2.png"); ?>" style=" padding: 51px 0 51px 0;">
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
  	<div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">
	        <img alt="Brand" src="<?php echo base_url()?>assets/images/cropped-logo_site-32x32.png" />
	      </a>
	      <p class="navbar-text">SEMPREIFPI - I Semana de Empreendedorismo do IFPI</p>
	    </div>
	    <div class="collapse navbar-collapse navbar-inverse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav navbar-right ">
		    	<li><?php echo"<p class='navbar-text'><strong>".$this->session->userdata('nome')."</strong></p>"; ?></li>
		        <li><?php  echo anchor('login/destroy_session', 'Sair'); ?></li>
	      	</ul>
		</div>
  	</div>
	</nav>
	
	
    	<div class="row">
		  <div class="col-md-2"  style="padding-right: 0; ">
		  	<div class="sidebar content-box" >
                <ul class="nav navbar-inverse">
                    <!-- Main menu -->
                    <li><a href="<?php  echo base_url()?>sist/home_sist"><i class="glyphicon glyphicon-home"></i> Início</a></li>
                     <!--<li><a href="<?php  echo base_url()?>sist/form_inscricao"><i class="glyphicon glyphicon-plus-sign"></i> Inscrições</a></li>-->
                    <li><a href="<?php  echo base_url()?>sist/minhas_inscricoes"><i class="glyphicon glyphicon-stats"></i> Minhas inscrições / Certificados</a></li>
                    <?php
                    	if ($this->session->userdata('status')==1){
                    		echo "<li><a href=".base_url()."sist/form_inscricao><i class=\"glyphicon glyphicon-plus-sign\"></i> Inscrições</a></li>";
                    		echo "<li><a href=".base_url()."sist/relatorio_inscricoes><i class=\"glyphicon glyphicon-list\"></i> Relatório de Inscrições Realizadas</a></li>";
							echo "<li><a href=".base_url()."sist/relatorio_participantes><i class=\"glyphicon glyphicon-list\"></i> Relatório de Participantes inscritos</a></li>";
							echo "<li><a href=".base_url()."sist/cadastros><i class=\"glyphicon glyphicon-list\"></i> Cadastros</a></li>";
							echo "<li><a href=".base_url()."sist/crachas_participantes><i class=\"glyphicon glyphicon-list\"></i> Crachas participantes</a></li>";
							echo "<li><a href=".base_url()."sist/crachas_organizacao><i class=\"glyphicon glyphicon-list\"></i> Crachas Organização</a></li>";
						}
						if(($this->session->userdata('status')==1) || ($this->session->userdata('status')==2)){
							echo "<li><a href=".base_url()."sist/escolhe_atividade><i class=\"glyphicon glyphicon-ok\"></i> Confirmação de Participação</a></li>";
						}
					?>
                    <!--
                    <li><a href="#"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                   -->
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="container-fluid" style="background-color: white; ">
		  		<?php $this->load->view($conteudo); ?>
		  	</div>
		  </div>
		</div>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
	  	<div class="container-fluid">
	    	<div class="navbar-header">
	      		<p class="navbar-text">SIGEV - Sistema de Gerenciamento de Eventos</p>
	    	</div>
		    <div class="collapse navbar-collapse navbar-inverse navbar-right " id="bs-example-navbar-collapse-1">
		    	<p class="navbar-text">Desenvolvido e Mantido pela Coordenação de T.I - Campus Valença do Piauí</p>
			</div>
	  	</div>
	</nav>
</body>
</html>