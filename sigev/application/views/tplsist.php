<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("/assets/vendor/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("/assets/vendor/metisMenu/metisMenu.min.css"); ?>"  rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("/assets/dist/css/sb-admin-2.css"); ?>"  rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("/assets/vendor/font-awesome/css/font-awesome.min.css"); ?>"  rel="stylesheet" type="text/css">
    
	<link href="<?php echo base_url("/assets/datepiker/jquery-ui.css"); ?>" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/datepiker/jquery-ui.js"); ?>"></script>			
	<!--
	<title>SIGEV - DIA DO AGRICULTOR</title>
	<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("/assets/css/bootstrapdatatable.css"); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url("/assets/datepiker/jquery-ui.css"); ?>" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/datepiker/jquery-ui.js"); ?>"></script>			
	<script src="<?php echo base_url("/assets/js/bootstrap_toolstip.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/js/datatable.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/js/bootstrap-confirmation.js"); ?>"></script>
	-->
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

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SIGEV - Dia do Agricultor</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-inverse sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<!--
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group 
                        </li>
                       			-->
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
						//	echo "<li><a href=".base_url()."sist/escolhe_atividade><i class=\"glyphicon glyphicon-ok\"></i> Confirmação de Participação</a></li>";
							echo "<li><a href=".base_url()."sist/escolhe_atividade><i class=\"glyphicon glyphicon-ok\"></i> Confirmação de Participação</a></li>";
						}
					?>
					
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php $this->load->view($conteudo); ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>		
		  		
	</div>
    <!-- /#wrapper -->
	
    <!-- jQuery -->
    <script src="<?php echo base_url("/assets/vendor/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("/assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("/assets/vendor/metisMenu/metisMenu.min.js"); ?>"></script>

     <!-- DataTables JavaScript -->
    <script src="<?php echo base_url("/assets/vendor/datatables/js/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/datatables-responsive/dataTables.responsive.js"); ?>"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("/assets/dist/js/sb-admin-2.js"); ?>"></script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>