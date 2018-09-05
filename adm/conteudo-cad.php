 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id												= (isset($_POST['id']) 											? $_POST['id']  										: '');
$titulo										= (isset($_POST['titulo']) 									? $_POST['titulo'] 									: '');
$chamada									= (isset($_POST['chamada'])									? $_POST['chamada']									: '');
$conteudo									= (isset($_POST['conteudo'])								? $_POST['conteudo']								: '');
$data											= (isset($_POST['data'])										? $_POST['data']										: '');
$data 										= date('Y-m-d H:i:s');

$foto_reduzida						= (isset($_POST['foto_reduzida'])						? $_POST['foto_reduzida']						: '');
$alt_foto_reduzida				= (isset($_POST['alt_foto_reduzida'])				? $_POST['alt_foto_reduzida']				: '');


$uri 											= (isset($_POST['uri'])											? $_POST['uri']											: '');
$situacao									= (isset($_POST['situacao'])								? $_POST['situacao']								: '');

$conteudo_localizacao_id	= (isset($_POST['conteudo_localizacao_id'])	? $_POST['conteudo_localizacao_id']	: '');
$description							= (isset($_POST['description'])							? $_POST['description']							: '');

$title										= (isset($_POST['title'])										? $_POST['title']										: '');

$menu_id									= (isset($_POST['menu_id'])									? $_POST['menu_id']									: '');
$menu_id									= (empty($menu_id)													? $_GET['menu_id']									: $menu_id);

$usuario_id								= (isset($_POST['usuario_id'])							? $_POST['usuario_id']							: '');

$enviar										= (isset($_POST['enviar'])									? $_POST['enviar']									: '');


$codigo_produto						= (isset($_POST['codigo_produto'])					? $_POST['codigo_produto']					: '');




$localizacaoConteudo = "";
$codac = (isset($_GET['codac'])			? $_GET['codac']					: '');

//echo "codac = $codac";

if ($codac == '') {
  $codac = (isset($_POST['codac'])	? $_POST['codac']					: '');
} 
$localizacaoConteudo = $codac;

      
      
$msgCadConteudo1 = "";
$msgCadConteudo2 = "";
$tamanhoHFotoReduzida = 370; // tamanho padrao
$tamanhoVFotoReduzida = 264; // tamanho padrao

if ($localizacaoConteudo == 2) { //esta cadastro no destaque topo
  $tamanhoHFotoReduzida = 1920;
  $tamanhoVFotoReduzida = 900;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está alterando o conteúdo:";
  $msgCadConteudo2 = "Destaque Topo";
  
}
if ($localizacaoConteudo == 4) { //esta cadastro no destaque1
  $tamanhoHFotoReduzida = 459;
  $tamanhoVFotoReduzida = 651;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está alterando o conteúdo:";
  $msgCadConteudo2 = "Destaque 1";
  
}

if ($localizacaoConteudo == 5) { //esta cadastro no destaque2
  $tamanhoHFotoReduzida = 706;
  $tamanhoVFotoReduzida = 407;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está alterando o conteúdo:";
  $msgCadConteudo2 = "Destaque 2";
  
}

if ($localizacaoConteudo == 6) { //texto "revendedora do Mês" na PP
  $tamanhoHFotoReduzida = 414;
  $tamanhoVFotoReduzida = 405;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está alterando o conteúdo:";
  $msgCadConteudo2 = "Texto da Página Principal - Revendedora do Mês";
}

if ($localizacaoConteudo == 7) { // cadastro de revendedoras
  $tamanhoHFotoReduzida = 370;
  $tamanhoVFotoReduzida = 264;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está gerenciando";
  $msgCadConteudo2 = "Revendedora do Mês";
}

if ($localizacaoConteudo == 8) { //depoimentos
  $tamanhoHFotoReduzida = 110;
  $tamanhoVFotoReduzida = 100;
  //echo "tamanho foto_reduzida $tamanhoHFotoReduzida X $tamanhoVFotoReduzida";
  $msgCadConteudo1 = "Você está gerenciando";
  $msgCadConteudo2 = "Depoimentos";
}









// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
$id = ( !empty($alterar) ? $alterar : $id);
if (!empty($alterar)) {
	$read = read('conteudo', "WHERE id=$alterar");
	//mostraMatriz($read);
	if ($read){
	  foreach($read as $upDB){
	  	$titulo 	= $upDB['titulo'];
	  	$chamada 	= $upDB['chamada'];
	  	$conteudo	= $upDB['conteudo'];	  	

	  	$data 											= $upDB['data'];
	  	$foto_reduzida 							= $upDB['foto_reduzida'];
	  	$alt_foto_reduzida 					= $upDB['alt_foto_reduzida'];

	  	$uri 												= $upDB['uri'];
	  	$situacao 									= $upDB['situacao'];

	  	$conteudo_localizacao_id	= $upDB['conteudo_localizacao_id'];

	  	$description 								= $upDB['description'];
	  	$title 											= $upDB['title'];
	  	$menu_id 										= $upDB['menu_id'];
	  	$usuario_id									= $upDB['usuario_id'];
	  	$visitas										= $upDB['visitas'];
	  	$codigo_produto							= $upDB['codigo_produto'];



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
	  		"titulo" 						=> "$titulo",
	  		"chamada" 					=> "$chamada",
	  		"conteudo" 					=> "$conteudo",
	  		"data" 							=> "$data",

	  		"foto_reduzida" 		=> "$foto_reduzida",
	  		"alt_foto_reduzida" => "$alt_foto_reduzida",

	  		"uri" 							=> "$uri",
	  		"situacao"					=> "$situacao",

	  		"conteudo_localizacao_id" 	=> "$conteudo_localizacao_id",
	  		
	  		"description" 			=> "$description",
	  		"title"							=> "$title",
	  		"conteudo"					=> "$conteudo",
	  		
	  		"menu_id"						=> "$menu_id",	
	  		"usuario_id"				=> "$usuario_id",
	  		
	  		"codigo_produto"		=> "$codigo_produto"

		);
		$gravarBD = create ('conteudo', $datas);
		
		$id = $gravarBD;


	} else {  //ALTERAÇÃO
		$up = array(
			"titulo" 										=> "$titulo",
			"chamada" 									=> "$chamada",
			"conteudo" 									=> "$conteudo",
			"data" 											=> "$data",
			"alt_foto_reduzida"					=> "$alt_foto_reduzida",
			"uri"												=> "$uri",
			"situacao"									=> "$situacao",
			"conteudo_localizacao_id"		=> "$conteudo_localizacao_id",
			"description"								=> "$description",
			"title"											=> "$title",
			"menu_id"										=> "$menu_id",
			"usuario_id"								=> "$usuario_id",
			"codigo_produto"						=> "$codigo_produto"

		);
		$gravarBD = update('conteudo', $up, "id=$id");
	}

	if ($_FILES['foto_reduzida']['name'] != '') {
		$tabela = 'conteudo';
		$campo = 'foto_reduzida';
		$dirDestino = '../user_files/foto_reduzida';
		$largura_final = $tamanhoHFotoReduzida;
		$altura_final = $tamanhoVFotoReduzida;
		include('image-upload.php');
		include("image-tratamento.php");
	}
}




?>

<?
//***** GRAVANDO AS FOTOS DO CONTEÚDO *****

/*

if (!empty($titulo) && !empty($enviar)) {
	
	$files = $_FILES['foto'];
	$numFile = count(array_filter($files['name']));
	if ($numFile > 0) {

		for($i=0; $i<$numFile; $i++) {

				$tabela = 'galeria_foto_conteudo';
				$campo = 'foto';
				$dirDestino = '../user_files/foto_conteudo';
				$largura_final = 830;
				$altura_final = 540;

				$nome_foto = $_FILES[$campo]['name'][$i];
				$formato = $_FILES[$campo]['type'][$i];
				$tamanho = $_FILES[$campo]['size'][$i];
				$tmp_name = $_FILES[$campo]['tmp_name'][$i];

				$nome_foto = corrigeNomeFoto($nome_foto);
				//mostraVar('nome foto', $nome_foto);

				$fotoValida = validaFoto($formato, $tamanho);
				//mostraVar('fotoValida', $fotoValida);


				if ($fotoValida =="ok") {
					//faz upload
					move_uploaded_file($tmp_name, "$dirDestino/".$nome_foto);

					//tratamento
					$foto_original = $dirDestino.'/'.$nome_foto;
					trataFoto($foto_original, $nome_foto, $largura_final, $altura_final, $dirDestino);


					//grava no banco
					$datas = array(
					  "titulo"						 		=> "",
					  "foto" 									=> $nome_foto, 
					  "conteudo_id"				 		=> "$id",
					  "conteudo_menu_id"	 		=> "$menu_id",
					);
					create ($tabela, $datas);


				}

			}
		}
}	

*/

?>



<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         
         <? 
            if ($localizacaoConteudo == ""){
              $msgCadConteudo1 = "Cadastrando Conteúdo no menu:";
              $msgCadConteudo2 = getCampo("menu", "$menu_id", "titulo");
            }
         ?>
         
         <? echo $msgCadConteudo1?> <span class="conteudo-tit-cad"> 
          	<? echo $msgCadConteudo2?> </span>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		<?php
		
		if (empty($gravarBD)){ 
		
		?>

<?
  if ($localizacaoConteudo == ""){ // exibe formulario padrao
    include "frm_cadastro_padrao.php";
  }
      
  if ($localizacaoConteudo == 2){ // exibe formulario cadastro conteudo: Topo Destaque
    include "frm_cadastro_conteudo_topo_destaque.php";
  }
      
  if ($localizacaoConteudo == 4){ // exibe formulario cadastro conteudo: Destaque1
    include "frm_cadastro_conteudo_destaque1.php";
  }
  if ($localizacaoConteudo == 5){ // exibe formulario cadastro conteudo: Destaque2
    include "frm_cadastro_conteudo_destaque2.php";
  }
  if ($localizacaoConteudo == 6){ // exibe formulario cadastro conteudo: Destaque2
    include "frm_cadastro_conteudo_rev_mes.php";
  }
  if ($localizacaoConteudo == 7){ // exibe formulario cadastro conteudo: Destaque2
    include "frm_cadastro_rev_mes.php";
  }
  if ($localizacaoConteudo == 8){ // exibe formulario cadastro conteudo: Destaque2
    include "frm_cadastro_depoimento.php";
  }
?>
       
        
		<?php } else {?>

	 	<p class="alert alert-success p-3">REGISTRO GRAVADO COM SUCESSO.</p>
	 	
	 	
	 	<? if ($codac == "") {  
      // só mostra essas opções se o usuário estiver cadastrando conteudo que não estão na pp 
    ?>
	 	<div class="d-flex justify-content-end">
       		<button type="button" name="listarC" value="listarC" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=conteudo-lista&menu_id=<?=$menu_id?>'">Listar Conteúdos</button>
	 			
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Listar Menus</button>

	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=conteudo-cad&menu_id=<?=$menu_id?>'">Efetuar Outro Cadastro</button>
		</div>
		<? } ?>
		
		
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  

