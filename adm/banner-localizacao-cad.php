 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$descricao 	= (isset($_POST['descricao']) 	? $_POST['descricao']  	: '');
$altura 		= (isset($_POST['altura']) 			? $_POST['altura']  		: '');
$largura 		= (isset($_POST['largura']) 		? $_POST['largura']  		: '');
$id					= (isset($_POST['id']) 					? $_POST['id']  				: '');
$enviar			= (isset($_POST['enviar'])			? $_POST['enviar']			: '');




// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('banner_localizacao', "WHERE id=$alterar");
	if ($read){
	  foreach($read as $upDB){
	  	$descricao 	= $upDB['descricao'];
	  	$altura 		= $upDB['altura'];
	  	$largura 		= $upDB['largura'];
	  }
	}
}



// EFETUA O CADASTRO OU A ALTERAÇÃO
// se tiver descrição e não tiver id -> grava
// se tiver descrição e id -> altera
// * perceba que o cadastro só acontece com o POST da descricao e id e enviar
if (!empty($descricao) && !empty($enviar)) {

	if (empty($id)) { // CADASTRO
		$datas = array(
	  		"descricao" => "$descricao",
	  		"altura" 		=> "$altura",
	  		"largura" 	=> "$largura"
		);
		$gravarBD = create ('banner_localizacao', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
	  		"descricao" => "$descricao",
	  		"altura" 		=> "$altura",
	  		"largura" 	=> "$largura"
		);
		$gravarBD = update('banner_localizacao', $up, "id=$id");
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
			

        <form action="index.php?pag=banner-localizacao-cad" method="post">
        	<div class="form-row">
	        	<div class="form-group col-md-12">
		        	<label for="descricao">Descrição </label>
		        	
		        	<input class="form-control" type="text" name="descricao" id="descricao" value="<?=$descricao?>" required="">

		        	<input type="hidden" name="id" value="<?=$alterar?>">
		        </div>
	        </div>

	        <div class="form-row">
	        	<div class="form-group col-md-6">
	        		<label for="altura">Largura </label>
		        	<input class="form-control" type="text" name="largura" id="largura" value="<?=$largura?>" required="">
	        	</div>

	        	<div class="form-group col-md-6">
	        		<label for="altura">Altura </label>
		        	<input class="form-control" type="text" name="altura" id="altura" value="<?=$altura?>" required="">
	        	</div>
	        </div>



        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=banner-localizacao-lista'">Voltar</button>
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
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=banner-localizacao-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=banner-localizacao-cad'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  
