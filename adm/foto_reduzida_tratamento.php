<?

				// pegando as dimensoes da imagem original
				$imagem_temp_or = "../user_files/foto_reduzida/$nome_foto";
				$img_or = getimagesize($imagem_temp_or);
	
				if(!empty($img_or)) {
				$img_width_or = trim($img_or[0]);
				$img_height_or = trim($img_or[1]);
				} 
				//echo 'Width: '.$img_width_or.'<br>';
				//echo 'Heigth: '.$img_height_or.'<br>';
	
	
				include 'classes/wideimage/WideImage.php';
	
				
				// trabalhando a imagem do slider 
				$nome_foto_novo = "_".$nome_foto;
				
				$largura_foto_que_eu_quero = 250;
				$algura_foto_que_eu_quero = 188;
	
			if ( ($img_width_or / $img_height_or) > 1 ) { // forma de paisagem
				//echo "paisagem <br>";
				$proporcao = $img_height_or / $img_width_or;
				//echo "$proporcao<br>";
				if ($proporcao < 0.75) { // tem que ajustar a altura para se adequar na proporção
					
					$h_quero = $img_width_or * 0.75;
					$h_dif   = ($h_quero - $img_height_or)/0.75;
					$w_nova  = $img_width_or - $h_dif;
					
					//echo "w=$img_width_or <br>";
					//echo "h_dif=$h_dif <br>";
					//echo "w=$w_nova <br>";
					
					WideImage::load('../user_files/foto_reduzida/'.$nome_foto)->crop('center', 'center', $w_nova, $img_height_or)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile('../user_files/foto_reduzida/'.$nome_foto_novo, 85);
					unlink("../user_files/foto_reduzida/$nome_foto");

				} else { // não precisa ajustar altura é só cortar

					$h_quero = $img_width_or * 0.75;
					WideImage::load('../user_files/foto_reduzida/'.$nome_foto)->crop('center', 'center', $img_width_or, $h_quero)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile('../user_files/foto_reduzida/'.$nome_foto_novo, 85);
					unlink("../user_files/foto_reduzida/$nome_foto");
				}
				
				
			} else { // retrato
				
				//echo "retrato<br>";	
				
				$h_quero = $img_width_or * 0.75;
					
				WideImage::load('../user_files/foto_reduzida/'.$nome_foto)->crop('center', 'center', $img_width_or, $h_quero)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile('../user_files/foto_reduzida/'.$nome_foto_novo, 85);
					unlink("../user_files/foto_reduzida/$nome_foto");
				
			}
			  

?>