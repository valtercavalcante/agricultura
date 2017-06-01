
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            	<p align="center" style="padding-top: 20px"><img  src="<?php echo base_url()?>assets/images/logo_evento.png" width=200px /></p>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Por favor efetue login</h3>
                    </div>
                    <div class="panel-body">
                    	<?php 
					  			if(validation_errors()!==NULL){
									echo validation_errors();
								}
								if (isset($erro)){
									echo $erro;
								}
								
                       
					  				//Criação de formulario
						            echo form_open("login/autenticar");
						    	?>        
                            <fieldset>
                                <div class="form-group">
                                  <?php echo form_label("CPF", "cpf");
						                echo form_input(array(
						                        "name" => "cpf",
						                        "id" => "cpf",
						                        "class" => "form-control",
						                        "maxlenth" => "20"
						                    )); 
						         ?> 
                                </div> 
                                <div class="form-group">
                                    <?php
						            echo form_label("Senha", "senha");
						                echo form_password(array(
						                        "name" => "senha",
						                        "id" => "senha",
						                        "class" => "form-control",
						                       
						                    )); 
						        	?>
                                </div>
                                <div class="form-group"> 
                                <!-- Change this to a button or input when using this as a form -->
                                <?php
								  	 echo form_button(array(
						                "class" => "btn btn-lg btn-success btn-block",
						                "content" => "Entrar no Sistema",
						                "type" => "submit"
						            )); 
									 echo form_close();
								    ?>
                                </div>
                                <div class="form-group">
                                 	<p><strong>Para se cadastrar </strong><?php  echo anchor('login/cadastroparticipante', 'Clique Aqui', array('class' => 'btn btn-tiny btn-danger')); ?> <p>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>