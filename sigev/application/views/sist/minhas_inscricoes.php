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
						 <h1 class="page-header">Inscrições Realizadas</h1>
					<div class="col-md-10 col-md-offset-1">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>PAINEL DE INSCRIÇÕES REALIZADAS</strong></h4></div>
	  							<div class="panel-body">
	  								<table class="table table-hover">
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
				
