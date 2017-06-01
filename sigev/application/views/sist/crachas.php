<html>
<head>
<title>Crachás Participantes</title>
<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url("/assets/js/jquery-1.10.2.js"); ?>"></script>

<style>
#imagem {
width: 350px;
height 227px;
}

#barcode{
	 margin-top: 350px; margin-left: 80px; position: absolute;
}
#textonome {
	position: absolute;
	width: 350px;
	margin-top: -280px;
	text-align:center;
	float: left;
	font-size: 24;
}
#textocidade{
	position: absolute;
	width: 350px;
	margin-top: -245px;
	text-align:center;
	float: left;
	font-size: 18;
}
#textoprofissao{
	position: absolute;
	width: 350px;
	margin-top: -220px;
	text-align:center;
	float: left;
	font-size: 18;
}
#texto {
	position: absolute;
	width: 350px;
	margin-top: -280px;
	text-align:center;
	float: left;
	font-size: 24;
}

#cpf {
	background-color: #ffffff;
	position: absolute;
	margin-top: -22px;
	margin-left: 130px;
	font-size: 14;
}
</style>

</head>

<body>
			<?php echo $inscricoes; ?>
			<!--
			 <div style="float: left; margin: 0 0 25 9">
				<div id="barcode"><?php echo geraCodigoBarra(60051095378);  ?></div>
				<img id="imagem" src="<?php echo base_url()?>/assets/images/cracha_participante.jpg"/>			
				<div id="texto">Valter Antonio de Lima Cavalcante</div>
			</div>
			-->
</body>
</html>