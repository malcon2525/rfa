<?

				// pegando as dimensoes da imagem original
				$imagem_temp_or = "../user_files/galeria/$nome_foto";
				$img_or = getimagesize($imagem_temp_or);
	
				if(!empty($img_or)) {
				$img_width_or = trim($img_or[0]);
				$img_height_or = trim($img_or[1]);
				} 
				//echo 'Width: '.$img_width_or.'<br>';
				//echo 'Heigth: '.$img_height_or.'<br>';
	
	
				include_once 'classes/wideimage/WideImage.php';
	
				
				// trabalhando a imagem do slider 
				$nome_foto_novo = "_".$nome_foto;
				
				$largura_foto_que_eu_quero = 250;
				$altura_foto_que_eu_quero = 188;

			if ( ($img_width_or / $img_height_or) > 1 ) { // paisagem
				$largura_maxima = 900;
				if ($img_width_or > $largura_maxima) {
						$largura_foto_que_eu_quero = $largura_maxima;
						$altura_foto_que_eu_quero = $img_height_or - (($img_width_or - $largura_foto_que_eu_quero) / ($img_width_or / $img_height_or));
				} else {
					$largura_foto_que_eu_quero = $img_width_or;
					$altura_foto_que_eu_quero = $img_height_or;
				}

				///mostraVar('largura_foto_que_eu_quero',$largura_foto_que_eu_quero);
				///mostraVar('altura_foto_que_eu_quero', $altura_foto_que_eu_quero);
		
				WideImage::load('../user_files/galeria/'.$nome_foto)->resize($largura_foto_que_eu_quero, $altura_foto_que_eu_quero)->saveToFile('../user_files/galeria/'.$nome_foto_novo, 85);
							unlink("../user_files/galeria/$nome_foto");

			} else { // retrato


				$altura_maxima = 600;
				if ($img_height_or > $altura_maxima) {
						$altura_foto_que_eu_quero = $altura_maxima;
						$largura_foto_que_eu_quero = $img_width_or - (($img_height_or - $altura_foto_que_eu_quero) / ($img_height_or / $img_width_or));
				} else {
					$largura_foto_que_eu_quero = $img_width_or;
					$altura_foto_que_eu_quero = $img_height_or;
				}

				//mostraVar('largura_foto_que_eu_quero',$largura_foto_que_eu_quero);
				//mostraVar('altura_foto_que_eu_quero', $altura_foto_que_eu_quero);
		
				WideImage::load('../user_files/galeria/'.$nome_foto)->resize($largura_foto_que_eu_quero, $altura_foto_que_eu_quero)->saveToFile('../user_files/galeria/'.$nome_foto_novo, 85);
							unlink("../user_files/galeria/$nome_foto");


			}

			  

?>