 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id											= (isset($_POST['id']) 							? $_POST['id']  					: '');
$titulo									= (isset($_POST['titulo']) 					? $_POST['titulo'] 				: '');
$situacao								= (isset($_POST['situacao'])				? $_POST['situacao']			: '');
$ordem									= (isset($_POST['ordem'])						? $_POST['ordem']					: '');
$precedencia						= (isset($_POST['precedencia'])			? $_POST['precedencia']		: '');
$uri 										= (isset($_POST['uri'])							? $_POST['uri']						: '');
$description						= (isset($_POST['description'])			? $_POST['description']		: '');

$conteudo								= (isset($_POST['conteudo'])				? $_POST['conteudo']			: '');

$menu_tipo_id = getTipoMenuFoto();
$menu_localizacao_id		= 1; // localização da galeria de fotos e videos sempre será 1


$enviar									= (isset($_POST['enviar'])					? $_POST['enviar']				: '');







// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('menu', "WHERE id=$alterar");
	//mostraMatriz($read);
	if ($read){
	  foreach($read as $upDB){
	  	$titulo 	= $upDB['titulo'];
	  	$situacao 	= $upDB['situacao'];
	  	$ordem 		= $upDB['ordem'];
	  	$precedencia= $upDB['precedencia'];
	  	$uri 		= $upDB['uri'];
	  	$description= $upDB['description'];
	  	$conteudo	= $upDB['conteudo'];	  	
	  	$menu_tipo_id			= $upDB['menu_tipo_id'];
	  	$menu_localizacao_id	= $upDB['menu_localizacao_id'];

	  }
	}
}



// EFETUA O CADASTRO OU A ALTERAÇÃO
// se tiver descrição e não tiver id -> grava
// se tiver descrição e id -> altera
// * perceba que o cadastro só acontece com o POST da titulo e id e enviar

if (!empty($titulo) && !empty($enviar)) {

	if (empty($id)) { // CADASTRO
		$datas = array(
	  		"titulo" 								=> "$titulo",
	  		"situacao"							=> "$situacao",
	  		"ordem" 								=> "$ordem",
	  		"precedencia" 					=> "$precedencia",
	  		"uri" 									=> "$uri",
	  		"description"						=> "$description",
	  		"conteudo"							=> "$conteudo",
	  		"menu_tipo_id"					=> "$menu_tipo_id",
	  		"menu_localizacao_id"		=> "$menu_localizacao_id"
		);
		$gravarBD = create ('menu', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
			"titulo" 						=> "$titulo",
			"situacao" 					=> "$situacao",
			"ordem" 						=> "$ordem",
			"precedencia"				=> "$precedencia",
			"uri"								=> "$uri",
			"description"				=> "$description",
			"conteudo"					=> "$conteudo",
			"menu_tipo_id"			=> "$menu_tipo_id"
			// o campo menu_localizacao_id  não é permitido a alteração
		);
		$gravarBD = update('menu', $up, "id=$id");
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

        <form action="index.php?pag=menu-galeria-foto-cad" method="post">
        	<input type="hidden" name="id" value="<?=$alterar?>">
        	
        	<div class="form-row">
			    <div class="form-group col-md-6">
			    	<label for="precedencia">Categoria Pai</label>
			    	<select class="form-control" id="precedencia" name="precedencia">
			    		<option value="0">Nenhum</option>
						<?

							$seTiverNaAlteracao = ( $alterar ? "AND id<>$alterar" : '');
							$menuPaiBD = read('menu',"WHERE precedencia = 0 AND menu_tipo_id=$menu_tipo_id AND menu_localizacao_id=$menu_localizacao_id $seTiverNaAlteracao ");
							if ($menuPaiBD) {
								foreach ($menuPaiBD as $menuPai) {
						?>
<? $selected = ( $menuPai['id'] == $precedencia ? 'selected' : '' )?>
					  <option value="<?=$menuPai['id']?>" <?=$selected?>><?=$menuPai['titulo']?></option>
						<?
								}
							}
						?>
					
					</select>

					<input type="hidden" name="menu_localizacao_id" value="<?=$menu_localizacao_id?>">
			    </div>
			</div>
			<div class="form-row">
			    <div class="form-group col-md-8">
			      <label for="titulo">titulo 	</sup></label>
     	          <input class="form-control" type="text" maxlength="255" name="titulo" id="titulo" value="<?=$titulo?>" required="">
			    </div>
			    <div class="form-group col-md-2">
			      <label for="ordem">Ordem <sup>(*)0 a 100	</sup> </label>
     	          <input class="form-control" type="ordem"  name="ordem" id="ordem" value="<?=$ordem?>" required="" pattern="[0-9]{1,3}" maxlength="3" >
			    </div>
			    <div class="form-group col-md-1">
			      <? $checked = ($situacao=="on"  ? 'checked' : '' )  ?>
			      <label for="situacao">Situação </label>
			      <input class="form-control" type="checkbox" maxlength="25" name="situacao" id="situacao" <?=$checked?> data-toggle="toggle" data-on="Ativado"  data-off="Desativado" data-onstyle="success" data-offstyle="danger"  >
			    </div>
			</div>

			<div class="form-row">
			    
			 
			    <!-- TIPO DO MENU SERÁ SEMPRE GALERIA DE FOTO -->
			     <?
							$sql = "SELECT id FROM menu_tipo WHERE descricao like '%FOTO%'";
              $exec = mysql_query($sql);
              $menu_tipo_id = mysql_fetch_assoc($exec);
			     ?>
			    <div class="form-group col-md-4">
			    	<input type="hidden" id="menu_tipo_id" value="$menu_tipo_id">
			    	
			    </div>
			</div>

		    




	        	
	        

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=menu-galeria-foto-lista'">Voltar</button>
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
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-galeria-foto-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-galeria-foto-cad&menu_localizacao_id=<?=$menu_localizacao_id?>'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  

