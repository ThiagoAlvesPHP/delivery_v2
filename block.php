<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Bloqueio</title>
	<style type="text/css">
		.block{
			width: 80%;
			margin: auto;
			text-align: center;
			color: #fff;
		}
	</style>
</head>
<body bgcolor="black">
	<div class="block">
		<h1>Bloqueio Realizado</h1>
		<h3>Favor entrar em contato com a administração</h3>
	</div>
</body>
</html>
<?php
	$html = ob_get_contents();
	ob_end_clean();
	if (!empty($_GET['block'])) {
		
		//bloquear
		if ($_GET['block'] == 'block') {
			//abro o arquivo index.php
			$index = fopen('index.php', 'w');
			//reescrevo no arquivo index
			fwrite($index, $html);
			//encerro a aplicação
			fclose($index);
		}
		//liberar
		if ($_GET['block'] == 'libery') {
			//leio o arquivo index.php
			$file = file_get_contents('index_backup.php');
			//abro o arquivo index_backup.php
			$backup = fopen('index.php', 'w');
			//escrevo as informações do arquivo index.php em index_backup.php
			fwrite($backup, $file);
			//encerro a aplicação
			fclose($backup);
		}
	}