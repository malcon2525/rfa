 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id													= (isset($_POST['id']) 													? $_POST['id']  											: '');
$titulo											= (isset($_POST['titulo']) 											? $_POST['titulo'] 										: '');
$situacao										= (isset($_POST['situacao'])										? $_POST['situacao']									: '');
$ordem											= (isset($_POST['ordem'])												? $_POST['ordem']											: '');
$precedencia								= (isset($_POST['precedencia'])									? $_POST['precedencia']								: '');
$uri 												= (isset($_POST['uri'])													? $_POST['uri']												: '');
$description								= (isset($_POST['description'])									? $_POST['description']								: '');
$title											= (isset($_POST['title'])												? $_POST['title']											: '');

$conteudo										= (isset($_POST['conteudo'])										? $_POST['conteudo']									: '');

$menu_tipo_id								= (isset($_POST['menu_tipo_id'])								? $_POST['menu_tipo_id']							: '');
$conteudo_localizacao_id 		= (isset($_POST['conteudo_localizacao_id'])			? $_POST['conteudo_localizacao_id']	: '');
$menu_localizacao_id		= (isset($_GET['menu_localizacao_id'])	 	? $_GET['menu_localizacao_id']   :
								($_POST['menu_localizacao_id']  ? $_POST['menu_localizacao_id']  		: '')
						   );

$enviar									= (isset($_POST['enviar'])					? $_POST['enviar']				: '');







// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
if (!empty($alterar)) {
	$read = read('menu', "WHERE id=$alterar");
	//mostraMatriz($read);
	if ($read){
	  foreach($read as $upDB){
	  	$titulo 									= $upDB['titulo'];
	  	$situacao 								= $upDB['situacao'];
	  	$ordem 										= $upDB['ordem'];
	  	$precedencia							= $upDB['precedencia'];
	  	$uri 											= $upDB['uri'];
	  	$description							= $upDB['description'];
	  	$title										= $upDB['title'];
	  	$conteudo									= $upDB['conteudo'];	  	
	  	$menu_tipo_id							= $upDB['menu_tipo_id'];
	  	$menu_localizacao_id			= $upDB['menu_localizacao_id'];
	  	$conteudo_localizacao_id	= $upDB['conteudo_localizacao_id'];

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
	  		"titulo" 											=> "$titulo",
	  		"situacao"										=> "$situacao",
	  		"ordem" 											=> "$ordem",
	  		"precedencia" 								=> "$precedencia",
	  		"uri" 												=> "$uri",
	  		"description"									=> "$description",
	  		"title"												=> "$title",
	  		"conteudo"										=> "$conteudo",
	  		"menu_tipo_id"								=> "$menu_tipo_id",
	  		"menu_localizacao_id"					=> "$menu_localizacao_id",
	  		"conteudo_localizacao_id"			=> "$conteudo_localizacao_id"

		);
		$gravarBD = create ('menu', $datas);
	} else {  //ALTERAÇÃO
		$up = array(
			"titulo" 											=> "$titulo",
			"situacao" 										=> "$situacao",
			"ordem" 											=> "$ordem",
			"precedencia"									=> "$precedencia",
			"uri"													=> "$uri",
			"description"									=> "$description",
			"title"												=> "$title",
			"conteudo"										=> "$conteudo",
			"menu_tipo_id"								=> "$menu_tipo_id",
			"conteudo_localizacao_id"			=> "$conteudo_localizacao_id"

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

        <form action="index.php?pag=menu-cad" method="post">
        	<input type="hidden" name="id" value="<?=$alterar?>">
        	
        	<div class="form-row">
			    <div class="form-group col-md-6">
			    	<label for="precedencia">Menu Pai</label>
			    	<select class="form-control" id="precedencia" name="precedencia">
			    		<option value="0">Nenhum</option>
						<?

							$seTiverNaAlteracao = ( $alterar ? "AND id<>$alterar" : '');
							$menuPaiBD = read('menu',"WHERE precedencia = 0 AND menu_localizacao_id=$menu_localizacao_id $seTiverNaAlteracao ");
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
			      <label for="titulo">titulo <sup>(*)max. 20 caracteres	</sup></label>
     	          <input class="form-control" type="text" maxlength="20" name="titulo" id="titulo" value="<?=$titulo?>" required="" onkeyup="generateURL()">
			    </div>
			    <div class="form-group col-md-2">
			      <label for="ordem">Ordem <sup>(*)0 a 999	</sup> </label>
     	          <input class="form-control" type="ordem"  name="ordem" id="ordem" value="<?=$ordem?>" required="" pattern="[0-9]{1,3}" maxlength="3" >
			    </div>
			    <div class="form-group col-md-1">
			      <? $checked = ($situacao=="on"  ? 'checked' : '' )  ?>
			      <label for="situacao">Situação </label>
			      <input class="form-control" type="checkbox" maxlength="25" name="situacao" id="situacao" <?=$checked?> data-toggle="toggle" data-on="Ativado"  data-off="Desativado" data-onstyle="success" data-offstyle="danger"  >
			    </div>
			</div>

			<div class="form-row">
			    
			    <div class="form-group col-md-6">
			      <label for="uri">URI</label>
     	          <input class="form-control" type="text"  name="uri" id="uri" value="<?=$uri?>" required="" >
			    </div>
			    <div class="form-group col-md-3">
			    	<label for="menu_tipo_id">Tipo do Menu</label>
			    	<select class="form-control" id="menu_tipo_id" name="menu_tipo_id">
			    		<? 
			    		$mostraDivMenuEspecial = '';
			    		$menuTipoBD = read('menu_tipo');
			    		if ($menuTipoBD) {
			    			foreach ($menuTipoBD as $menuTipo) {
			    		?>
<?// $selected = ( $menuTipo['id'] == $menu_tipo_id ? 'selected' : '' )?>
									<?
									if ($menuTipo['id'] == $menu_tipo_id) {
										$selected = 'selected';
										if ($menuTipo['id'] == 2) {
											$mostraDivMenuEspecial = 'sim';
										}
									} else {
										$selected = '';
									}
									?>
								  <option value="<?=$menuTipo['id']?>" <?=$selected?>>
								  	      <?=$menuTipo['descricao']?>
								  </option>
					  	<?
			    			}
			    		}
			    		?>
					</select>
			    </div>

			    <?
			    if ($selected) {
			    	# code...
			    }
			    ?>

			    <? 
			    $frm_nao_aparece = "";	
			    if (!empty($alterar) && $mostraDivMenuEspecial=='sim') {
			    	$frm_nao_aparece = "";
			    } else {
			    	$frm_nao_aparece = "frm-nao-aparece";

			    }

			    ?>
			    <div id="divMenuEspecial" class="form-group col-md-3 <?=$frm_nao_aparece?>">
			    	<label for="conteudo_localizacao_id">Especificar menu?:</label>
			    	<select class="form-control" id="conteudo_localizacao_id" name="conteudo_localizacao_id">
			    		<? 
			    		$conteudoLocalizacaoIDBD = read('conteudo_localizacao');
			    		if ($conteudoLocalizacaoIDBD) {
			    			foreach ($conteudoLocalizacaoIDBD as $conteudoLocalizacaoID) {
			    		?>
<? $selected = ( $conteudoLocalizacaoID['id'] == $conteudo_localizacao_id ? 'selected' : '' )?>
					  <option value="<?=$conteudoLocalizacaoID['id']?>" <?=$selected?>>
					  	<?=$conteudoLocalizacaoID['descricao']?>
					  </option>
					  	<?
			    			}
			    		}
			    		?>
					</select>
			    </div>

			</div>
<br><br><br><hr>

			<div class="form-row">

				
				<div class="form-group col-md-12">
					<label for="title">	SEO: Title: </label><span id="faltat" class="caracteres-restantes"> 60</span>  <span class="caracteres-restantes">caracteres restantes</span> 


					    <div class="input-group">
					      <input onkeyup="validaCampo('title', 'faltat', 60)" type="text" name="title" id="title" class="form-control" maxlength="60" value="<?=$title?>">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary" type="button" id="gerar_titulo" data-placement="left"  data-toggle="tooltip" title="Pega os 60 primeiros caracteres do titulo.">Gerar</button>
					      </span>
					    </div>
					
				</div>

								<div class="form-group col-md-12">
					<label for="description">SEO - Descriprion:  </label>
					<span id="falta" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span> 
				    <textarea class="form-control" id="description" rows="3" name="description" maxlength="150"  onkeyup="validaCampo('description', 'falta', 150)" ><?=$description?></textarea>
				    

				</div>
			</div>

		    




	        	
	        

        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Voltar</button>
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
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Listar</button>
	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-cad&menu_localizacao_id=<?=$menu_localizacao_id?>'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  

