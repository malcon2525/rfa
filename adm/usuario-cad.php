 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$nome 		= (isset($_POST['nome']) 		? $_POST['nome']  		: '');
$id			= (isset($_POST['id']) 			? $_POST['id']  		: '');
$enviar		= (isset($_POST['enviar'])		? $_POST['enviar']		: '');
$senha		= (isset($_POST['senha'])		? md5($_POST['senha'])	: '');
$email		= (isset($_POST['email'])		? $_POST['email']		: '');
$situacao	= (isset($_POST['situacao'])	? $_POST['situacao']	: '');






// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('usuario', "WHERE id=$alterar");
	if ($read){
	  foreach($read as $upDB){
	  	$nome 		= $upDB['nome'];
	  	$senha 		= $upDB['senha'];
	  	$email 		= $upDB['email'];
	  	$situacao 	= $upDB['situacao'];
	  }
	}
}



// EFETUA O CADASTRO OU A ALTERAÇÃO
// se tiver descrição e não tiver id -> grava
// se tiver descrição e id -> altera
// * perceba que o cadastro só acontece com o POST da nome e id e enviar
if (!empty($nome) && !empty($enviar)) {

	if (empty($id)) { // CADASTRO
		$datas = array(
	  		"nome" 		=> "$nome",
	  		"senha" 	=> "$senha",
	  		"email" 	=> "$email",
	  		"situacao" 	=> "$situacao"
		);
		$gravarBD = create ('usuario', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
			"nome" 		=> "$nome",
			"senha" 	=> "$senha",
			"email"		=> "$email",
			"situacao"	=> "$situacao"
		);
		$gravarBD = update('usuario', $up, "id=$id");
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
			

        <form action="index.php?pag=usuario-cad" method="post">
        	
			<div class="form-row">
			    <div class="form-group col-md-10">
			      <label for="nome">Nome </label>
     	          <input class="form-control" type="text" maxlength="25" name="nome" id="nome" value="<?=$nome?>" required="">
			    </div>
			    <div class="form-group col-md-1">
			      <? $checked = ($situacao=="on"  ? 'checked' : '' )  ?>
			      <label for="situacao">Situação </label>
			      <input class="form-control" type="checkbox" maxlength="25" name="situacao" id="situacao" <?=$checked?> data-toggle="toggle" data-on="Ativado"  data-off="Desativado" data-onstyle="success" data-offstyle="danger"  >
			    </div>
			</div>

			<div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="email">E-mail </label>
     	          <input class="form-control" type="email"  name="email" id="email" value="<?=$email?>" required="">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="senha">Senha</label>
     	          <input class="form-control" type="password"  name="senha" id="senha" value="<?=$senha?>" required="">
			    </div>
			</div>



	        	<input type="hidden" name="id" value="<?=$alterar?>">
	        

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=usuario-lista'">Voltar</button>
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
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=usuario-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=usuario-cad'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  
