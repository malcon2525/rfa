<?

				// pegando as dimensoes da imagem original
				$imagem_temp_or = "$dirDestino/$nome_foto";
				$img_or = getimagesize($imagem_temp_or);
	
				if(!empty($img_or)) {
				$img_width_or = trim($img_or[0]);
				$img_height_or = trim($img_or[1]);
				} 
				//echo 'Width: '.$img_width_or.'<br>';
				//echo 'Heigth: '.$img_height_or.'<br>';
	
	
				include 'classes/wideimage/WideImage.php';
	

				$nome_foto_novo = "_".$nome_foto;
				
				$largura_final = $largura_final;
				$altura_final = $altura_final;
				


					$proporcao_original = $img_height_or / $img_width_or;
					$proporcao_final = $altura_final / $largura_final;


					// passo 1 - redimensionar de forma proporcional a imagem
					$variacao_largura = $img_width_or - $largura_final;
					$varicao_altura =  $variacao_largura*$proporcao_original;

					$nova_largura = $img_width_or - $variacao_largura;
					$nova_altura = $img_height_or - $varicao_altura;

					$diferenca_proporcao = $proporcao_final - $proporcao_original + 1;

					$correcao_altura = $altura_final - $nova_altura;
					$nova_altura = $nova_altura + $correcao_altura;
					$nova_largura = $nova_largura + $correcao_altura * $diferenca_proporcao;

					//mostraVar($nova_largura);
					//mostraVar($nova_altura);

					//com o novo tamanho já calculado agora é só redimensionar e depois cortar para o tamanho defitivo.

					WideImage::load($dirDestino."/".$nome_foto)->resize($nova_largura, $nova_altura,'fill')->crop('center', 'center', $largura_final, $altura_final)->saveToFile($dirDestino."/".$nome_foto_novo, 100);
					unlink("$dirDestino/$nome_foto");









			// if ( ($img_width_or / $img_height_or) > 1 ) { // forma de paisagem
			// 	//echo "paisagem <br>";
			// 	$proporcao = $img_height_or / $img_width_or;
			// 	//echo "$proporcao<br>";
			// 	if ($proporcao < 0.75) { // tem que ajustar a altura para se adequar na proporção
					
			// 		$h_quero = $img_width_or * 0.75;
			// 		$h_dif   = ($h_quero - $img_height_or)/0.75;
			// 		$w_nova  = $img_width_or - $h_dif;
					
			// 		//echo "w=$img_width_or <br>";
			// 		//echo "h_dif=$h_dif <br>";
			// 		//echo "w=$w_nova <br>";
					
			// 		WideImage::load($dirDestino."/".$nome_foto)->crop('center', 'center', $w_nova, $img_height_or)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile($dirDestino."/".$nome_foto_novo, 100);
			// 		unlink("$dirDestino/$nome_foto");

			// 	} else { // não precisa ajustar altura é só cortar

			// 		$h_quero = $img_width_or * 0.75;
			// 		WideImage::load($dirDestino."/".$nome_foto)->crop('center', 'center', $img_width_or, $h_quero)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile($dirDestino."/".$nome_foto_novo, 100);
			// 		unlink("$dirDestino/$nome_foto");
			// 	}
				
				
			// } else { // retrato
				
			// 	//echo "retrato<br>";	
				
			// 	$h_quero = $img_width_or * 0.75;
			// 	$h_quero = $img_width_or * 0.75;
					
			// 	WideImage::load($dirDestino."/".$nome_foto)->crop('center', 'center', $img_width_or, $h_quero)->resize($largura_foto_que_eu_quero, $algura_foto_que_eu_quero)->saveToFile($dirDestino."/".$nome_foto_novo, 100);
			// 		unlink("$dirDestino/$nome_foto");
				
			// }
			  

?>