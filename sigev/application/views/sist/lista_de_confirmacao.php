				<div class="row">
					<div class="col-md-12">
						<blockquote>
							<p><strong><?php echo $atividade ?></strong></p>	
						</blockquote>
						<div class="col-md-6">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>PARTICIPANTES</strong></h4></div>
	  							<div class="panel-body">
	  									<?php 
											echo form_open("sist/confirma_presenca"); 
											echo form_hidden('id_atividade', $id_atividade);    
											?>
	  								<table class="table table-hover">
										<thead>
											<tr><th>NOME DA PARTICIAPANTE</th><th>CPF</th></tr>
										</thead>
										<tbody>
											
											<?php 
											echo form_open("sist/confirma_presenca");
											echo $participantes;
											?>
											
										</tbody>
									</table>
									<div class="form-group">
											<?php
											 echo form_button(array(
									        	"class" => "btn btn-lg btn-success btn-large",
									        	"content" => "Salvar",
									        	"type" => "submit"
									        )); 
											echo form_close();
											?>
											</div>
								</div>
							</div>
						</div>
					</div>
				</div>
