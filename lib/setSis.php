<?php
/*****************************
SETA URL DA HOME
*****************************/

	function setHome(){
		echo BASE;	
	}
	
/*****************************
INCLUE ARQUIVOS
*****************************/

	function setArq($nomeArquivo){
		if(file_exists($nomeArquivo.'.php')){
			include($nomeArquivo.'.php');
		}else{
			echo 'Erro ao incluir <strong>'.$nomeArquivo.'.php</strong>, arquivo ou caminho não conferem!';	
		}
	}

/*****************************
TRANFORMA STRING EM URL
*****************************/

	function setUri($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';	
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		$string = strip_tags(trim($string));
		$string = str_replace(" ","-",$string);
		$string = str_replace(array("-----","----","---","--"),"-",$string);
		return strtolower(utf8_encode($string));
	}
/*****************************
SOMA VISITAS
*****************************/	

	function setViews($topicoId){
		$topicoId = mysql_real_escape_string($topicoId);
		$readArtigo = read('conteudo',"WHERE id = '$topicoId'");
		
		foreach($readArtigo as $artigo);
			$views = $artigo['visitas'];
			$views = $views +1;
			$dataViews = array(
				'visitas' => $views
			);
			update('conteudo',$dataViews,"id = '$topicoId'");
	}




// FUNCONES PARA UPLOAD DE IMAGEM

function corrigeNomeFoto($nome_foto){
	if ($nome_foto != "") {
		$nome_foto = str_replace (" ","_",$nome_foto);
		$nome_foto = str_replace ("á","a",$nome_foto);
		$nome_foto = str_replace ("à","a",$nome_foto);
		$nome_foto = str_replace ("â","a",$nome_foto);
		$nome_foto = str_replace ("ã","a",$nome_foto);
		$nome_foto = str_replace ("Á","a",$nome_foto);
		$nome_foto = str_replace ("À","a",$nome_foto);
		$nome_foto = str_replace ("Â","a",$nome_foto);
		$nome_foto = str_replace ("Ã","a",$nome_foto);
		$nome_foto = str_replace ("é","e",$nome_foto);
		$nome_foto = str_replace ("è","e",$nome_foto);
		$nome_foto = str_replace ("ê","e",$nome_foto);
		$nome_foto = str_replace ("É","e",$nome_foto);
		$nome_foto = str_replace ("È","e",$nome_foto);
		$nome_foto = str_replace ("Ê","e",$nome_foto);
		$nome_foto = str_replace ("í","i",$nome_foto);
		$nome_foto = str_replace ("ì","i",$nome_foto);
		$nome_foto = str_replace ("î","i",$nome_foto);
		$nome_foto = str_replace ("Í","i",$nome_foto);
		$nome_foto = str_replace ("Ì","i",$nome_foto);
		$nome_foto = str_replace ("Î","i",$nome_foto);
		$nome_foto = str_replace ("ó","o",$nome_foto);
		$nome_foto = str_replace ("ò","o",$nome_foto);
		$nome_foto = str_replace ("õ","o",$nome_foto);
		$nome_foto = str_replace ("ô","o",$nome_foto);
		$nome_foto = str_replace ("Ó","o",$nome_foto);
		$nome_foto = str_replace ("Ò","o",$nome_foto);
		$nome_foto = str_replace ("Õ","o",$nome_foto);
		$nome_foto = str_replace ("Ô","o",$nome_foto);
		$nome_foto = str_replace ("ú","o",$nome_foto);
		$nome_foto = str_replace ("ù","o",$nome_foto);
		$nome_foto = str_replace ("û","o",$nome_foto);
		$nome_foto = str_replace ("Ú","o",$nome_foto);
		$nome_foto = str_replace ("Ù","o",$nome_foto);
		$nome_foto = str_replace ("Û","o",$nome_foto);
		$nome_foto = str_replace ("ç","c",$nome_foto);
		$nome_foto = str_replace ("Ç","c",$nome_foto);
		$nome_foto = str_replace ("Ñ","n",$nome_foto);
		$nome_foto = str_replace ("ñ","n",$nome_foto);

		$nome_foto = strtolower($nome_foto);

		$pos      = strripos($nome_foto, '.'); // pega a posição do último ponto
		$nome_arq = substr($nome_foto, 0, $pos);
		$extensao = substr($nome_foto,$pos);


		$num1 = rand(10, 20);
		$num2 = rand(21, 60);
		$num3 = rand(61, 99);
		$aleatorio = $num1.$num2.$num3;

		$nome_foto = $nome_arq.$aleatorio.$extensao;
		return $nome_foto;
	}
}

function validaFoto($formato, $tamanho){
	$formatos = array("image/jpg", "image/jpeg" , "image/pjpeg" ,"image/png" , "image/gif");
	
	$testeType = array_search ($formato, $formatos);
	
	$msg_erro = 'ok';
	if (!$testeType){
		$msg_erro = "Erro ao gravar a imagem: Formato da foto invalido<br>";
	}

	if ($tamanho > 2000000){
		$msg_erro = "Erro ao gravar a imagem: Excedeu o limite de 2 MB<br>";
	}

	return $msg_erro;
}


function trataFoto($fotoOriginal, $nomeFoto, $largura_final, $altura_final, $dirDestino){
				
				$nome_foto = $nomeFoto;
				$imagem_temp_or = $fotoOriginal;
				$img_or = getimagesize($imagem_temp_or);
	
				if(!empty($img_or)) {
						$img_width_or = trim($img_or[0]);
						$img_height_or = trim($img_or[1]);
				} 
				//echo 'Width: '.$img_width_or.'<br>';
				//echo 'Heigth: '.$img_height_or.'<br>';
	
				require_once('classes/wideimage/WideImage.php') ;

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

}


?>