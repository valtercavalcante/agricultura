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
						 <h1 class="page-header">Relatório de Participantes Cadastrados</h1>			
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>PARTICIPANTES CADASTRADOS</strong></h4></div>
	  							<div class="panel-body">
	  								<table class="table table-striped table-bordered" id="tabela1" class="tablesorter">
										<thead>
											<tr><th>NOME DO PARTICIPANTE</th><th>CPF</th><th style="text-align: center">E-MAIL</th><th style="text-align: center">TELEFONE</th><th style="text-align: center">OCUPAÇÃO</th><th style="text-align: center">AÇÕES</th></tr>
										</thead>
										<tbody>
											<?php echo $participantes ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
				
			
