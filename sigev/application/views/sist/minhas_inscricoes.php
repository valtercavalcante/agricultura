<script>
	function excluir()   
{  
    var pergunta = confirm("Deseja realmente excluir essa informação ?")  
    if (pergunta)  
         document.messages.submit();
    else  
        return false;  
}  
</script>
				
					<div class="col-md-12">
						 <h2 class="page-header">Inscrições</h2>
					<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>Suas inscrições</strong></h4></div>
	  							<div class="panel-body">
	  								<div class="table-responsive">
		  								 <table class="table table-striped table-bordered table-hover">
											<thead>
												<tr><th>NOME DA ATIVIDADE</th><th style="text-align: center">DATA DA ATIVIDADE</th><th style="text-align: center">INÍCIO</th><th style="text-align: center">TÉRMINO</th><th style="text-align: center"></th></tr>
											</thead>
											<tbody>
												<?php echo $inscricoes ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>Palestras</strong></h4></div>
	  							<div class="panel-body">
		  							<div class="table-responsive">
		  							 <table class="table table-striped table-bordered table-hover">
											<thead>
												<tr><th>NOME DO PALESTRA</th><th>PALESTRANTE</th><th style="text-align: center">DATA DO PALESTRA</th><th style="text-align: center">INÍCIO</th><th style="text-align: center">TÉRMINO</th></tr>
											</thead>
											<tbody>
												<?php echo $palestras ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					-->	
						<div class="col-md-12">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>Oficinas</strong></h4></div>
	  							<div class="panel-body">
	  								<div class="table-responsive">
		  								 <table class="table table-striped table-bordered table-hover">
											<thead>
												<tr><th>NOME DO OFICINA</th><th>PALESTRANTE</th><th style="text-align: center">DATA DO OFICINA</th><th style="text-align: center">INÍCIO</th><th style="text-align: center">TÉRMINO</th><th style="text-align: center"></th></tr>
											</thead>
											<tbody>
												<?php echo $oficinas ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				
