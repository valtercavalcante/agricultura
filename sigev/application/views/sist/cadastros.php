  <script>
  jQuery(function($){
        $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
});
jQuery(function($){
   	$("#hora_inicio").mask("99:99:00");
   	$("#hora_final").mask("99:99:00");
});
</script>
<script src="<?php echo base_url("/assets/js/jquery.maskedinput.js"); ?>"></script>		
		
				
					<div class="col-md-12">
						 <h1 class="page-header">Cadastros</h1>
						<div class="col-md-6">
							<div class="panel panel-default">
	  							<div class="panel-heading"><strong>CADASTRO DE ATIVIDADE</strong></h4></div>
	  							<div class="panel-body">
										<div class="col-md-12">
														<?php 
											  				if(validation_errors()!==NULL){
																echo validation_errors();
															}
														?>
													<div class="row">
								  					<div class="form-group">
											  				<?php
											  				//Criação de formulario
												            echo form_open("sist/cadastra_atividade");
												            echo form_label("NOME", "nome");
												            echo form_input(array(
												                        "name" => "nome",
												                        "id" => "nome",
												                        "class" => "form-control",
												                        "value"=> $this->input->post('nome'),
												                        "style" => "text-transform:uppercase;"
												               )); ?>
													</div>
													<div class="form-group">
											  				<?php
											  				//Criação de formulario
												            echo form_open("sist/cadastra_atividade");
												            echo form_label("PALESTRANTE", "palestrate");
												            echo form_input(array(
												                        "name" => "palestrante",
												                        "id" => "palestrante",
												                        "class" => "form-control",
												                        "value"=> $this->input->post('palestrante'),
												                        "style" => "text-transform:uppercase;"
												               )); ?>
													</div>
													</div>
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																	<?php
																	echo form_label("Data", "data");
														            echo form_input(array(
														                        "name" => "data",
														                        "id" => "datepicker",
														                        "class" => "form-control",
														                        "value"=> $this->input->post('data'),
														                        "style" => "text-transform:uppercase;",
														                       
														               ));  
														        	?>
														   	</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																	<?php
																	echo form_label("Hora de Início", "hora_inicio");
														            echo form_input(array(
														                        "name" => "hora_inicio",
														                        "id" => "hora_inicio",
														                        "class" => "form-control",
														                        "value"=> $this->input->post('hora_inicio'),
														               ));  
														        	?>
														   	</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
													  				<?php
														            echo form_label("Hora Final", "hora_final");
														            echo form_input(array(
														                        "name" => "hora_final",
														                        "id" => "hora_final",
														                        "class" => "form-control",
														                        "value"=> $this->input->post('hora_final'),
														               )); ?>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group" >
																   <?php
														            echo form_label("TIPO", "tipo"); ?>
													  				<select id="tipo" name="tipo" class="form-control">
													  					<option value="">Selecione</option>
													  					<option value="1">Palestra</option>
													  					<option value="2">Mini-curso</option>
													  					<option value="3">Oficina</option>
													  				</select>
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
							</div>
						</div>
					</div>
				
