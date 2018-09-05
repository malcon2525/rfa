 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id								= (isset($_POST['id']) 							? $_POST['id']  							: '');
$galeria_id				= (isset($_POST['galeria_id'])			? $_POST['galeria_id']				: 
										(isset($_GET['galeria_id']) ? $_GET['galeria_id']  : '')
);

$enviar						= (isset($_POST['enviar'])					? $_POST['enviar']						: '');

$nome_galeria = getCampo('galeria', $galeria_id, 'titulo' );

?>


<?
// FAZENDO O UPLOAD
//$foto								= (isset($_POST['foto']) 							? $_POST['foto']  							: '');

//$foto = $_POST['foto'];


if (!empty($enviar)) {

	// INFO IMAGEM	
	$files = $_FILES['foto'];
	$numFile = count(array_filter($files['name']));

	//mostraVar('Número de fotos para upload: ', $numFile);

	if ($numFile > 0) {
		for($i=0; $i<$numFile; $i++) {
			$tabela = 'galeria_foto';
			$campo = 'foto';
			$dirDestino = '../user_files/galeria/';

			$nome_foto = $_FILES[$campo]['name'][$i];
			$formato = $_FILES[$campo]['type'][$i];
			$tamanho = $_FILES[$campo]['size'][$i];
			$tmp_name = $_FILES[$campo]['tmp_name'][$i];

			$nome_foto = corrigeNomeFoto($nome_foto);
			//mostraVar('nome foto', $nome_foto);

			$fotoValida = validaFoto($formato, $tamanho);
			//mostraVar('fotoValida', $fotoValida);

			if ($fotoValida =="ok") {
				move_uploaded_file($tmp_name, "$dirDestino/".$nome_foto);

				include_once 'classes/wideimage/WideImage.php';
				$nome_foto_novo = "_".$nome_foto;


				// pegando as dimensoes da imagem original
				$imagem_temp_or = "../user_files/galeria/$nome_foto";
				$img_or = getimagesize($imagem_temp_or);
	
				if(!empty($img_or)) {
				$img_width_or = trim($img_or[0]);
				$img_height_or = trim($img_or[1]);
				} 

				if ( ($img_width_or / $img_height_or) > 1 ) { // paisagem
					$largura_maxima = 900;
					if ($img_width_or > $largura_maxima) {
							$largura_foto_que_eu_quero = $largura_maxima;
							$altura_foto_que_eu_quero = $img_height_or - (($img_width_or - $largura_foto_que_eu_quero) / ($img_width_or / $img_height_or));
					} else {
						$largura_foto_que_eu_quero = $img_width_or;
						$altura_foto_que_eu_quero = $img_height_or;
					}
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



				$usuario_id = $_SESSION['secao_usuario']['id'];
				$datas = array(
				  "titulo"						 		=> "",
				  "foto" 									=> $nome_foto,
				  "usuario_id" 						=> $usuario_id,
				  "galeria_id" 						=> $galeria_id,

				);
				create ('galeria_foto', $datas);
			}
		}
	}


	//mostraMatriz($files);

} // end if

?>


<?
//excluir
$excluir								= (isset($_GET['excluir']) 							? $_GET['excluir']  							: '');

if (!empty($excluir)) {
	$foto_excluir = getCampo('galeria_foto', $excluir, 'foto');
	unlink("../user_files/galeria/_$foto_excluir");
	delete('galeria_foto', "id = $excluir");
	echo $foto_excluir." foi excluída<br>";
}
?>


<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Inserindo foto na galeria: <span> <?=$nome_galeria ?> </span>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		
			

        <form action="index.php?pag=galeria-foto-cad" method="post"  enctype="multipart/form-data">

			    <input type="hidden" name="galeria_id" galeria_id="galeria_id" value="<?=$galeria_id?>">

        	
					<div class="form-group col-md-12">
						<label for="foto"></label>
						<input class="form-control-file" type="file" id="foto" name="foto[]" class="file_upload" value="oi" multiple>
						
					</div>

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=galeria-lista&tipo=foto'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		Gravar Fotos
	        	</button>
		    	</div> 
        </form>

	

				



        </form>




        
      </div>
    </div>
  </div>
  
 
</div>  
