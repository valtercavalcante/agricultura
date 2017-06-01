
			<div class="row">
				<h5 align="center"><strong>SIGEV</strong><br />- SISTEMA DE GERENCIAMENTO DE EVENTOS -<br />I SEMPREIFPI 2016</h5>
				
				<div class="col-md-6 col-md-offset-3">
				<h4 align="center"><strong>Oi <?php echo $usuario['nome'] ?> <br /> <br /> Informe uma senha e confirmação de senha e atualize seu cadastro</strong></h4>
												<?php 
					  							if(validation_errors()!==NULL){
													echo validation_errors();
												}
												?>
		  					<div class="form-group">
					  				<?php
					  				//Criação de formulario
						          	echo form_open("sist/atualiza_senha"); 
						           	echo form_hidden('id', $usuario['id']);    
						         	?>
							</div>	
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
											<?php
											
											echo form_label("SENHA", "senha");
								            echo form_password(array(
								                        "name" => "senha",
								                        "id" => "senha",
								                        "class" => "form-control",
								               ));  
								        	?>
								   	</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
											<?php
											echo form_label("CONFIRMAÇÃO DE SENHA", "confirmsenha");
								            echo form_password(array(
								                        "name" => "confirmsenha",
								                        "id" => "confirmsenha",
								                        "class" => "form-control",
								                        
								               ));  
								        	?>
								   	</div>
								</div>
							</div>
						  	<div class="col-md-6 col-md-offset-3">
								<div class="form-group">
									<?php
								  	 echo form_button(array(
						                "class" => "btn btn-lg btn-primary btn-block",
						                "content" => "Atualizar Cadastro",
						                "type" => "submit"
						            )); 
									 echo form_close();
								    ?>
								</div>
							</div>
	  		</div>
