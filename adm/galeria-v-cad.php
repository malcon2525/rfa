 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id											= (isset($_POST['id']) 								? $_POST['id']  						: '');

$titulo									= (isset($_POST['titulo']) 						? $_POST['titulo'] 					: ''); 
$title									= (isset($_POST['title']) 						? $_POST['title'] 					: ''); 
$uri										= (isset($_POST['uri']) 							? $_POST['uri'] 						: ''); 
$description						= (isset($_POST['description']) 			? $_POST['description'] 		: ''); 
$usuario_id							= (isset($_POST['usuario_id'])				? $_POST['usuario_id']			: '');

$enviar									= (isset($_POST['enviar'])						? $_POST['enviar']					: '');

$tipo										= (isset($_POST['tipo']) 							? $_POST['tipo'] 						: 
													(isset($_GET['tipo'])  							? $_GET['tipo']  						: '')

); 



// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('galeria', "WHERE id=$alterar");
	if ($read){
	  foreach($read as $upDB){
	  	$titulo 			= $upDB['titulo'];
	  	$uri 					= $upDB['uri'];
	  	$title 				= $upDB['title'];
	  	$description	= $upDB['description'];
	  	$usuario_id	 	= $upDB['usuario_id'];
	  }
	}
}



// EFETUA O CADASTRO OU A ALTERAÇÃO
// se tiver titulo e não tiver id -> grava
// se tiver titulo e id -> altera
// * perceba que o cadastro só acontece com o POST da titulo e id e enviar
if (!empty($titulo) && !empty($enviar)) {

	
	$usuario_id = $_SESSION['secao_usuario']['id'];

	if (empty($id)) { // CADASTRO
		$datas = array(
	  		"titulo" 				=> "$titulo",
	  		"uri" 					=> "$uri",
	  		"title" 				=> "$title",
	  		"description" 	=> "$description",
	  		"tipo" 					=> "$tipo",
	  		"usuario_id" 		=> "$usuario_id"
		);
		$gravarBD = create ('galeria', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
			"titulo" 					=> "$titulo",
			"uri" 						=> "$uri",
			"title" 					=> "$title",
			"description" 		=> "$description",
			"tipo" 						=> "$tipo",
			"usuario_id" 			=> "$usuario_id"
		);
		$gravarBD = update('galeria', $up, "id=$id");
	}
}




?>

<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		<?php
		
		if (empty($gravarBD)){ 
		
		?>
			

        <form action="index.php?pag=galeria-v-cad" method="post">
        	
        	<div class="form-row">
	        	<div class="form-group col-md-12">
		        	<label for="titulo">Título </label>
		        	
		        	<input class="form-control" onkeyup="generateURL()" type="text"  name="titulo" id="titulo" value="<?=$titulo?>" required="" >

		        	<input type="hidden" name="id" value="<?=$alterar?>">
		        	<input type="hidden" name="tipo" value="<?=$tipo?>">
		        </div>
	      	</div>

					<div class="grupo-campo p-3">
						
						<div class="form-group col-md-12">
							<label for="title">	SEO - Title:&nbsp; </label> <span id="faltat" class="caracteres-restantes"> 60&nbsp;</span>  <span class="caracteres-restantes">caracteres restantes</span> 
					    <div class="input-group">
					      <input onkeyup="validaCampo('title', 'faltat', 60)" type="text" name="title" id="title" class="form-control" maxlength="60" value="<?=$title?>">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary" type="button" id="gerar_titulo" data-placement="left"  data-toggle="tooltip" title="Pega os 60 primeiros caracteres do titulo.">Gerar</button>
					      </span>
					    </div>
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




        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=galeria-v-lista'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		<?
	        		$tituloBotao = (empty($alterar) ? 'Gravar' : 'Alterar');
	        		echo $tituloBotao;
	        		?>
	        	</button>
		    </div> 

        </form>

		<?php } else {?>

	 	<p class="alert alert-success p-3">REGISTRO GRAVADO COM SUCESSO.</p>
	 	<div class="d-flex justify-content-end">
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=galeria-v-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=galeria-v-cad&tipo=video'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  
