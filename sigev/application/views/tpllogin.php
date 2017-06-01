<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SIGEV - I SEMPREIFPI</title>
	<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>
	<script src="<?php echo base_url("/assets/js/jquery-ui.js"); ?>"></script>
  	<script src="<?php echo base_url("/assets/js/jquery.maskedinput.js"); ?>"></script>		
<script>
	jQuery(function($){
   	$("#cpf").mask("999.999.999-99");
   	$("#telefone").mask("(99) 99999999?9");
});
</script>

</head>
<body background="<?php echo base_url("/assets/images/bg2.png"); ?>">
				
					<?php $this->load->view($conteudo); ?>
		
			<?php include('footer.php'); ?>
			
		
</body>
</html>