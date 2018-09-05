 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id								= (isset($_POST['id']) 							? $_POST['id']  							: '');
$titulo						= (isset($_POST['titulo']) 					? $_POST['titulo']  					: '');
$video						= (isset($_POST['video']) 					? $_POST['video']  						: '');
$galeria_id				= (isset($_POST['galeria_id'])			? $_POST['galeria_id']				: 
										(isset($_GET['galeria_id']) ? $_GET['galeria_id']  : '')
);

$enviar						= (isset($_POST['enviar'])					? $_POST['enviar']						: '');

$nome_galeria = getCampo('galeria', $galeria_id, 'titulo' );

?>


<?


if (!empty($titulo) && !empty($enviar)) {

	//echo  substr($video, 0, 17)."<br>";

	if (substr($video, 0, 17) != "https://youtu.be/") {
			$msg_erro= "formato inicial de vídeo incorreto";
			echo $msg_erro."<br>";
	} elseif (strlen(substr($video, 17)) != 11)  {
		$msg_erro= "formato final de vídeo incorreto";		
		//echo "tamanho=".strlen(substr($video, 17));
		//echo "<br>video = ".substr($video, 17)."<br>";
		echo $msg_erro."<br>";
	} else {
				$video = substr($video, 17);
			}

	if (empty($id) && empty($msg_erro)) { // CADASTRO
		$datas = array(
	  		"titulo" 								=> "$titulo",
	  		"galeria_id" 						=> "$galeria_id",
	  		"video"									=> "$video"
		);
		$gravarBD = create ('galeria_video', $datas);
	}
}
?>


<?
//excluir
$excluir								= (isset($_GET['excluir']) 							? $_GET['excluir']  							: '');

if (!empty($excluir)) {
	$video_excluir = getCampo('galeria_video', $excluir, 'titulo');
	echo $video_excluir." foi excluída<br>";
	delete('galeria_video', "id=$excluir");
}
?>


<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Inserindo vídeo na galeria: <span> <?=$nome_galeria ?> </span>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		
			

        <form action="index.php?pag=galeria-video-cad" method="post"  enctype="multipart/form-data">

			    <input type="hidden" name="galeria_id" galeria_id="galeria_id" value="<?=$galeria_id?>">

        	
					<div class="form-group col-md-6">
						<label for="titulo"> Título</label>
						<input class="form-control" type="text" id="titulo" name="titulo" required >
					</div>

					<div class="form-group col-md-6">
						<label for="video">Link YouTube</label>
						<input class="form-control" type="text" id="video" name="video"  required >
					</div>


        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=galeria-v-lista&tipo=video'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		Gravar Vídeo
	        	</button>
		    	</div> 
        </form>

	

				<!-- lista de videos -->
				<div class="card-group mt-5 ">

					

				<? 
				$nome_video_listaDB = read('galeria_video', "WHERE galeria_id = $galeria_id ");
				?>

						<?
				if (!empty($nome_video_listaDB)) {
						foreach ($nome_video_listaDB as $nome_video_lista) {
							$link_excluir_video = "index.php?pag=galeria-video-cad&galeria_id=$nome_video_lista[galeria_id]&excluir=$nome_video_lista[id]"
						?>
							<div class="card mb-3 col-3 card-border-adm">
							  <div style="background-image:url(http://i.ytimg.com/vi/<?=$nome_video_lista['video']?>/mqdefault.jpg); height: 180px">
							  </div>
							  <div class="d-flex justify-content-center">	
												<?=$nome_video_lista['titulo']?>
							  </div>
							  <div class="card-body d-flex justify-content-center flex-end">
							    <a href="<?=$link_excluir_video?>" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Editar Conteúdo">Excluir </a>
							  </div>
							</div>
						<?
						}
					}
						?>

				</div>



        




        
      </div>
    </div>
  </div>
  
 
</div>  
