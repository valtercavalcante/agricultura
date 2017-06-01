
	<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            	<p align="center" style="padding-top: 20px"><img  src="<?php echo base_url()?>assets/images/logo_evento.png" width=200px /></p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Por favor efetue seu cadastro. *Todos os campos são obrigatórios.</h3>
                    </div>
                    <div class="panel-body">
                    	<?php 
					  							if(validation_errors()!==NULL){
													echo validation_errors();
												}
												?>
		  					<div class="form-group">
					  				<?php
					  				//Criação de formulario
						            echo form_open("login/efetuaCadastroParticipante");
						            echo form_label("NOME", "nome");
						            echo form_input(array(
						                        "name" => "nome",
						                        "id" => "nome",
						                        "class" => "form-control",
						                        "value"=> $this->input->post('nome'),
						                        "style" => "text-transform:uppercase;"
						               )); ?>
							</div>	
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
											<?php
											echo form_label("CPF", "cpf");
								            echo form_input(array(
								                        "name" => "cpf",
								                        "id" => "cpf",
								                        "class" => "form-control",
								                        "value"=> $this->input->post('cpf'),
								                        "style" => "text-transform:uppercase;",
								                       
								               ));  
								        	?>
								   	</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
											<?php
											echo form_label("TELEFONE", "telefone");
								            echo form_input(array(
								                        "name" => "telefone",
								                        "id" => "telefone",
								                        "class" => "form-control",
								                        "value"=> $this->input->post('telefone'),
								               ));  
								        	?>
								   	</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
							  				<?php
								            echo form_label("EMAIL", "email");
								            echo form_input(array(
								                        "name" => "email",
								                        "id" => "email",
								                        "type" => "email",
								                        "class" => "form-control",
								                        "value"=> $this->input->post('email'),
								               )); ?>
									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group" >
										   <?php
								            echo form_label("Ocupa&ccedil;&atilde;o", "vinculo"); ?>
							  				<select id="ocupacao" name="ocupacao" class="form-control">
							  					<option value="">Selecione...</option>
							  					<?php echo $profissoes; ?>
							  				</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group" >
										   <?php
								            echo form_label("Estado", "estado"); ?>
							  				<select id="estado" name="estado" class="form-control">
							  					<option value="">Selecione...</option>
							  					<?php echo $estados; ?>
							  				</select>
									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group" >
										   <?php
								            echo form_label("Cidade", "cidade"); ?>
							  				<select id="cidade" name="cidade" class="form-control">
                								<option value="">Selecione o estado</option>
            								</select>
									</div>
								</div>
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
								                        "value"=> $this->input->post('senha'),
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
								                        "value"=> $this->input->post('confirmsenha'),
								                        
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
						                "content" => "Efetuar Cadastro",
						                "type" => "submit"
						            )); 
									 echo form_close();
								    ?>
								</div>
							</div>
	  		</div>
			<script type="text/javascript">   
            $(document).ready(function() {                
                $("#estado").change(function() {
                    $("#estado option:selected").each(function() {
                        idEstado = $('#estado').val();
                        $.post("<?php echo base_url(); ?>login/buscaCidade", {
                            idEstado : idEstado
                        }, function(data) {
                            $("#cidade").html(data);
                        });
                    });
                });
            });
        </script>
             	</div>
			</div>
		</div>
	</div>

			
				
				