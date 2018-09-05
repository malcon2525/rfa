 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id								= (isset($_POST['id']) 							? $_POST['id']  							: '');
$enviar						= (isset($_POST['enviar'])					? $_POST['enviar']						: '');

$banner_localizacao_id	= (isset($_POST['banner_localizacao_id']) ? $_POST['banner_localizacao_id']  	: 
	( isset($_GET['banner_localizacao_id']) ? $_GET['banner_localizacao_id'] : '')
	);


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

	$dirDestino = '../user_files/banner/';
	if ($numFile > 0) {
		for($i=0; $i<$numFile; $i++) {

			$nome_foto 	= $_FILES['foto']['name'][$i];
			$formato 		= $_FILES['foto']['type'][$i];
			$tamanho 		= $_FILES['foto']['size'][$i];
			$tmp_name 	= $_FILES['foto']['tmp_name'][$i];

			$nome_foto = corrigeNomeFoto($nome_foto);
			//mostraVar('nome foto', $nome_foto);

			$fotoValida = validaFoto($formato, $tamanho);
			//mostraVar('fotoValida', $fotoValida);

			if ($fotoValida =="ok") {
				move_uploaded_file($tmp_name, "$dirDestino/".$nome_foto);

				
				include_once 'classes/wideimage/WideImage.php';
				$nome_foto_novo = "_".$nome_foto;
				$largura_foto_que_eu_quero = getCampo('banner_localizacao' , $banner_localizacao_id, 'largura');
				$altura_foto_que_eu_quero = getCampo('banner_localizacao' , $banner_localizacao_id, 'altura');
				WideImage::load($dirDestino.$nome_foto)->resize($largura_foto_que_eu_quero, $altura_foto_que_eu_quero,'fill')->saveToFile($dirDestino.$nome_foto_novo, 90);
				unlink("$dirDestino$nome_foto");



				$usuario_id = $_SESSION['secao_usuario']['id'];
				$datas = array(
				  "titulo"						 		=> "",
				  "foto" 									=> $nome_foto,
				  "usuario_id" 						=> $usuario_id,
				  "banner_localizacao_id" => $banner_localizacao_id,

				);
				create ('banner', $datas);

			}



		}
	}


	//mostraMatriz($files);

}

?>


<?
//excluir
$excluir								= (isset($_GET['excluir']) 							? $_GET['excluir']  							: '');

if (!empty($excluir)) {
	$foto_excluir = getCampo('banner', $excluir, 'foto');
	unlink("../user_files/banner/_$foto_excluir");
	delete('banner', "id = $excluir");
	echo $foto_excluir." foi excluída<br>";

	delete('banner', "id=$excluir");
}
?>


<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        	<?
        		$nome_area = getCampo('banner_localizacao', $banner_localizacao_id , 'descricao');
        	?>
          Inserindo banner : <span> <?=$nome_area ?> </span>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		
			

        <form action="index.php?pag=banner-cad" method="post"  enctype="multipart/form-data">

			    <input type="hidden" name="banner_localizacao_id" galeria_id="banner_localizacao_id" value="<?=$banner_localizacao_id?>">

        	
					<div class="form-group col-md-12">
						<label for="foto"></label>
						<input class="form-control-file" type="file" id="foto" name="foto[]" class="file_upload" value="oi" multiple>
						
					</div>

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=banner-lista&tipo=foto'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		Gravar Fotos
	        	</button>
		    	</div> 
        </form>

	

				<!-- lista de imagens -->
				<div class="card-group mt-5 ">

					

				<? 
				$nome_foto_listaDB = read('banner', "WHERE banner_localizacao_id = $banner_localizacao_id ");
				?>

						<?
				if (!empty($nome_foto_listaDB)) {
						foreach ($nome_foto_listaDB as $nome_foto_lista) {
							$link_excluir_foto = "index.php?pag=banner-cad&banner_localizacao_id=$nome_foto_lista[banner_localizacao_id]&excluir=$nome_foto_lista[id]"
						?>
							<div class="card mb-3 col-3 card-border-adm">
							  <img class="card-img-top galeria-img" src="../user_files/banner/_<?=$nome_foto_lista['foto']?>" alt="Card image cap">
							  <div class="card-body d-flex justify-content-center flex-end">
							    <a href="<?=$link_excluir_foto?>" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Excluir Banner">Excluir </a>

									<button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#bannerEditar" onmouseover="setBannerIDforModal('<?=$nome_foto_lista['id']?>','<?=$nome_foto_lista['uri']?>')">Editar</button>

									<script type="text/javascript">
										function setBannerIDforModal(valor, uri) {
										    document.getElementById("bannerID").value = valor;
										    document.getElementById("uri").value = uri;
										}
									</script>

							  </div>
							</div>
						<?
						}
					}
						?>

				</div>



        </form>




        
      </div>
    </div>
  </div>
  
 
</div>  





<!-- Modal -->

<?
$editar						= (isset($_POST['editar'])					? $_POST['editar']						: '');
$uri							= (isset($_POST['uri'])							? $_POST['uri']								: '');
$bannerID					= (isset($_POST['bannerID'])				? $_POST['bannerID']					: '');

// mostraVar('editar_banner', $editar_banner);
// mostraVar('uri', $uri);

if ($editar) {
	$up = array(
			"uri" 					=> "$uri"
		);
		$gravarBD = update('banner', $up, "id=$bannerID");
}


?>

<div class="modal fade" id="bannerEditar" tabindex="-1" role="dialog" aria-labelledby="bannerEditarTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edição do banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?pag=banner-cad" method="post">

			    <input type="hidden" name="banner_localizacao_id" galeria_id="banner_localizacao_id" value="<?=$banner_localizacao_id?>">
			    <!-- <input type="hidden" name="altura" galeria_id="altura" value="<?=$altura?>">
			    <input type="hidden" name="largura" galeria_id="largura" value="<?=$largura?>"> -->
     				<input type="hidden" name="bannerID" id="bannerID" class="form-control">


        	
					<div class="form-group col-md-12">
						<label for="uri">URI </label>
     				<input type="text" name="uri" id="uri" class="form-control" value="<?=$uri?>">
					</div>

        	<div class="d-flex justify-content-end " >
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	        	<button type="submit" name="editar" value="editar" class="btn btn-primary ml-2">
	        		Gravar URI
	        	</button>
		    	</div> 
        </form>
      </div>
      
    </div>
  </div>
</div>

<script type="javascript">
	$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>












