				<div class="row">
					<div class="col-md-12">
						
						<h2><?php echo $atividade ?></h2>	
					
						<div class="col-md-6">
							<div class="panel panel-default">
	  							<div class="panel-heading">Confirmação de Inscrições</h4></div>
	  							<div class="panel-body">
  									<h4 style="color: green"><strong>Você acaba de confirmar a participação de <?php echo $numero_de_confirmacoes ?> pessoas no curso acima!</strong></h4>
	  								<table class="table table-hover">
										<thead>
											<tr><th>CÓDIGO</th><th>NOME DA PARTICIAPANTE</th></tr>
										</thead>
										<tbody>
											
											<?php
											echo $participantes;
											?>
											
										</tbody>
									</table>
									<?php echo anchor('sist/escolhe_atividade', 'VOLTAR PARA LISTA DE ATIVIDADES', array('class' => 'btn btn-primary btn-large')); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
