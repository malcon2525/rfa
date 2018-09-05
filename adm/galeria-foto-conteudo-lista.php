<?
require('../lib/dbaSis.php');
require('../lib/getSis.php');
require('../lib/setSis.php');
require('../lib/outSis.php')
?>

<?
$conteudo_id								= (isset($_GET['conteudo_id']) 							? $_GET['conteudo_id']  							: '');
$excluir										= (isset($_GET['excluir']) 									? $_GET['excluir']  									: '');
$foto_id										= (isset($_GET['foto_id']) 									? $_GET['foto_id']  									: '');

?>

<?
//*****EXCLUIR FOTO DO CONTEUDO

if (!empty($foto_id)) {
	$nome_foto = getCampo("galeria_foto_conteudo", "$foto_id", "foto");
  if ($nome_foto != "") {
    if (file_exists("../user_files/foto_conteudo/_$nome_foto")){
       unlink("../user_files/foto_conteudo/_$nome_foto");
    }
  }
  delete('galeria_foto_conteudo', "id=$foto_id");
}


?>

  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap-toggle.min.css">


<div class="card-group mt-2 ml-2">
									<? 
									$nome_foto_listaDB = read("galeria_foto_conteudo", "WHERE conteudo_id =$conteudo_id");
									?>

											<?
									if (!empty($nome_foto_listaDB)) {
											foreach ($nome_foto_listaDB as $nome_foto_lista) {
												$foto_id = $nome_foto_lista['id'];
												$link_excluir_foto = BASE."/adm/galeria-foto-conteudo-lista.php?excluir=sim&foto_id=$foto_id&conteudo_id=$conteudo_id";
											?>
												<div class="card mb-3 col-3 card-border-adm-fconteudo">
												  
												  <img style="max-height: 100px; max-width: 145px;" class="card-img-top galeria-img-fconteudo" src="../user_files/foto_conteudo/_<?=$nome_foto_lista['foto']?>" alt="Card image cap">
												  <div class="card-body d-flex justify-content-center flex-end">
												    <a href="<?=$link_excluir_foto?>" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Editar Conteúdo">Excluir </a>
												  </div>
												</div>
											<?
											}
										}
											?>
				</div>