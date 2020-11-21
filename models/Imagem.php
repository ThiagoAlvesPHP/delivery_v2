<?php
class Imagem extends model{
	public function jpeg($x, $y, $caminho, $arquivo){
		$largura = $x;
		$altura = $y;

		list($larguraOri, $alturaOri) = getimagesize($_FILES['imagem']['tmp_name']);
		$ratio = $larguraOri / $alturaOri;
		
		if ($largura / $altura > $ratio) {
			$largura = $altura * $ratio;
		} else {
			$altura = $largura / $ratio;
		}	

		$imagem_final = imagecreatetruecolor($largura, $altura);
		$imagem_original = imagecreatefromjpeg($_FILES['imagem']['tmp_name']);
		imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOri, $alturaOri);

		imagejpeg($imagem_final, $caminho.$arquivo, 100);
	}

	public function png($x, $y, $caminho, $arquivo){
		$largura = $x;
		$altura = $y;

		//CAPTURANDO LARGURA E ALTURA ORIGINAL DA IMAGEM
		list($larguraOri, $alturaOri) = getimagesize($_FILES['imagem']['tmp_name']);
		$ratio = $larguraOri / $alturaOri;
		
		if ($largura / $altura > $ratio) {
			$largura = $altura * $ratio;
		} else {
			$altura = $largura / $ratio;
		}	

		//CRIAR IMAGEM COM ALTURA E ALTURA
		$imagem_final = imagecreatetruecolor($largura, $altura);
		$imagem_original = imagecreatefrompng($_FILES['imagem']['tmp_name']);

		//deixando imagem transparente
		imagealphablending($imagem_final, false);
		imagesavealpha($imagem_final,true);
		$transparent = imagecolorallocatealpha($imagem_final, 255, 255, 255, 127);
		imagefilledrectangle($imagem_final, 0, 0, $altura, $altura, $transparent);

		imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOri, $alturaOri);

		imagepng($imagem_final, $caminho.$arquivo, 9, true);
	}

}