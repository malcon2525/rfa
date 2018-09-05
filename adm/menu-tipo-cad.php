 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$descricao 	= (isset($_POST['descricao']) 	? $_POST['descricao']  	: '');
$id			= (isset($_POST['id']) 			? $_POST['id']  		: '');
$enviar		= (isset($_POST['enviar'])		? $_POST['enviar']		: '');




// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('menu_tipo', "WHERE id=$alterar");
	if ($read){
	  foreach($read as $upDB){
	  	$descricao = $upDB['descricao'];
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
	  		"descricao" => "$descricao"
		);
		$gravarBD = create ('menu_tipo', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
			"descricao" => "$descricao"
		);
		$gravarBD = update('menu_tipo', $up, "id=$id");
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
			

        <form action="index.php?pag=menu-tipo-cad" method="post">
        	<div class="form-group">
	        	<label for="descricao">Descrição <sup>(*)Máx. 25 caracteres</sup></label>
	        	
	        	<input class="form-control" type="text" maxlength="25" name="descricao" id="descricao" value="<?=$descricao?>" required="">

	        	<input type="hidden" name="id" value="<?=$alterar?>">
	        </div>

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=menu-tipo-lista'">Voltar</button>
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
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-tipo-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-tipo-cad'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  
