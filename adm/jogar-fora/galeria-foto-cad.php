 <? require_once('../lib/validaSessaoAdm.php');?>

<?
// variaveis referente ao cadastro de galeria de fotos
$id											= (isset($_POST['id']) 								? $_POST['id']  						: '');

$menu_id								= (isset($_POST['menu_id']) 					? $_POST['menu_id'] 				: 
													(isset($_GET['menu_id']) ? $_GET['menu_id'] : '')

);

$galeria_id							= (isset($_POST['galeria_id']) 				? $_POST['galeria_id'] 			: ''); 

$titulo									= (isset($_POST['titulo']) 						? $_POST['titulo'] 					: ''); 
$title									= (isset($_POST['title']) 						? $_POST['title'] 					: ''); 
$uri										= (isset($_POST['uri']) 							? $_POST['uri'] 						: ''); 
$description						= (isset($_POST['description']) 			? $_POST['description'] 		: ''); 

$gravar_galeria					= (isset($_POST['gravar_galeria'])		? $_POST['gravar_galeria'] 	: ''); 
$usuario_id							= (isset($_POST['usuario_id'])				? $_POST['usuario_id']			: '');


$enviar									= (isset($_POST['enviar'])						? $_POST['enviar']					: '');



?>

<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>




<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastro_galeria">
  Inserir Galeria de Fotos
</button>


<!-- Modal Cadastro de Galeria-->

<?
if ($gravar_galeria == "sim") { // CADASTRO
	$datas = array(
  		"titulo" 						=> "$titulo",
  		"uri" 							=> "$uri",
  		"title"							=> "$title",
  		"description" 			=> "$description",
  		"menu_id"						=> "$menu_id",	
  		"usuario_id"				=> "$usuario_id"
	);
	$gravarBD = create ('galeria', $datas);
	$id = $gravarBD;
}
?>
<div class="modal fade" id="cadastro_galeria" tabindex="-1" role="dialog" aria-labelledby="cadastro_galeriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadastro_galeriaLabel">Cadastrar Galeria de Fotos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <form action="index.php?pag=galeria-foto-cad&menu_id=15" method="post">

      	<input type="hidden" name="pag" value="galeria-foto-cad">
      	<input type="hidden" name="menu_id" value="<?=$menu_id?>">
      	<input type="hidden" name="galeria_id" value="<?=$galeria_id?>">
      	<? $usuario_id = $_SESSION['secao_usuario']['id']; ?>
	    	<input type="hidden" name="usuario_id" id="usuario_id" value="<?=$usuario_id?>">
	    	<input type="hidden" name="id" id="id" value="<?=$id?>">
      	<input type="hidden" name="gravar_galeria" value="sim">



	      <div class="modal-body">

					<div class="form-row">
						<div class="form-group col-12 ">
							<label for="titulo">Título</label>
							<input class="form-control" type="text" id="titulo" name="titulo" value="<?=$titulo?>" onkeyup="generateURL()">
						</div>
					</div>

					<div class="grupo-campo">
						<div class="form-row p-3">

							<label for="title">	SEO - Title:&nbsp; </label> <span id="faltat" class="caracteres-restantes"> 60&nbsp;</span>  <span class="caracteres-restantes">caracteres restantes</span> 


					    <div class="input-group">
					      <input onkeyup="validaCampo('title', 'faltat', 60)" type="text" name="title" id="title" class="form-control" maxlength="60" value="<?=$title?>">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary" type="button" id="gerar_titulo" data-placement="left"  data-toggle="tooltip" title="Pega os 60 primeiros caracteres do titulo.">Gerar</button>
					      </span>
					    </div>

					    <div class="form-group col-md-12">
								<label for="uri">	SEO - URI: </label>
			     				 <input type="text" name="uri" id="uri" class="form-control" value="<?=$uri?>">
							</div>

							<div class="form-group col-md-12">
								<label for="description">SEO - Descriprion:  </label>
								<span id="falta" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span> 
							    <textarea class="form-control" id="description" rows="3" name="description" maxlength="150"  onkeyup="validaCampo('description', 'falta', 150)" ><?=$description?></textarea>
							    

							</div>
							
						</div>
					</div>
	        

	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	        <button type="submit" class="btn btn-primary">Gravar</button>
	      </div>

      </form>


    </div>
  </div>
</div>
<!-- Fim Modal -->





<hr>	





















