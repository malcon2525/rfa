  <? require_once('../lib/validaSessaoAdm.php');?>

<?
$excluir   = (isset($_GET['excluir'])     ? $_GET['excluir']    : '');
$id        = (isset($_GET['id'])          ? $_GET['id']         : '');

if (!empty($excluir)) {
  delete('menu_tipo', "id=$id");
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
        
        <a href="index.php?pag=menu-tipo-cad" class="btn btn-primary">Inserir Tipo de Menu</a><br><br>
        
        <table class="table table-sm table-hover">
         <tr>
           <th>Nome do tipo do menu</th>
           <th colspan="2"></th>
         </tr>

<?
$listaBD = read ('menu_tipo');
if($listaBD) {
  foreach ($listaBD as $lista) {
?>

         <tr>
           <td width="100%" ><a href="index.php?pag=menu-tipo-cad&alterar=<?=$lista['id']?>" class="btn btn-light d-block text-left"><?=$lista['descricao']?></a></td>
           <td><a href="index.php?pag=menu-tipo-cad&alterar=<?=$lista['id']?>" class="btn btn-info">Editar</a></td>
           <td><a href="index.php?pag=menu-tipo-lista&excluir=true&id=<?=$lista['id']?>" class="btn btn-danger">Excluir</a></td>
         </tr>

<?
  }
}
?>

         
          
        </table>
        
        
      </div>
    </div>
  </div>
  
 
</div>  