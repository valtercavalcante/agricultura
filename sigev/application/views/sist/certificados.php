<html>
<head>
<title>Certificado Participantes</title>
<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>

<style>
#imagem {
height: 18.8cm;
margin-left: 1cm;
}

#barcode{
	 margin-top: 350px; margin-left: 80px; position: absolute;
}
#textofrente {
	position: absolute;
	width: 20cm;;
	margin-top: -400px;
	margin-left: 3.5cm;
	text-align:justify;
	float: left;
	font-size: 20;
	font-style:normal;
	font-family:Times;
}
#textoverso{
	position: absolute;
	width: 8cm;;
	margin-top: -580px;
	margin-left: 15.5cm;
	text-align:center;
	float: left;
	font-size: 10;
	font-style:normal;
	font-family:Times;
}

</style>

</head>

<body>
			<?php echo $certificado; ?>
			<!--
			 <div style="float: left; margin: 0 0 25 9">
				<div id="barcode"><?php echo geraCodigoBarra(60051095378);  ?></div>
				<img id="imagem" src="<?php echo base_url()?>/assets/images/cracha_participante.jpg"/>			
				<div id="texto">Valter Antonio de Lima Cavalcante</div>
			</div>
			-->
</body>
</html>