 <!--  Gerenciamento de menu -->
 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$tipo       = (isset($_GET['tipo'])        ? $_GET['tipo']    : '');

if ($tipo == "foto") {
  $recurso = "Galeria de Fotos";
  $acao = 'Lista de Galerias de Fotos ';
}

?>

 <p class="nome-recurso"><?=$recurso?></p>
 <p class="nome-acao"><?=$acao?></p>
 
  
<?
$excluir   = (isset($_GET['excluir'])     ? $_GET['excluir']    : '');
$menu_id   = (isset($_GET['menu_id'])     ? $_GET['menu_id']    : '');

$filtro = ( isset($_POST['filtro']) ? $_POST['filtro'] : '') ; 

if (!empty($excluir)) {
  delete('galeria', "id=$excluir");
}

?>


<?
//paginacao
$pg = ( empty($_GET['pg']) ? '1' : $_GET['pg']);
$maximo = 2;
$inicio = ($pg * $maximo) - $maximo;
?>



<div id="accordion" role="tablist" >
 




  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="heading<?=$a?>One">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapse<?=$a?>One" aria-expanded="true" aria-controls="collapse<?=$a?>One">
          Lista de galeria de fotos
      </h5>
    </div>

    <div id="collapse<?=$a?>One" class="collapse show" role="tabpanel" aria-labelledby="heading<?=$a?>One" data-parent="#accordion">
     
      <!-- CONTEÚDO DO CARD -->
      <div class="card-body">
        



        <div class="row"> 
          <div class="col-md-6">
            <a href="index.php?pag=galeria-cad&tipo=foto" class="btn btn-primary">Inserir Galeria de Foto</a><br><br>
          </div>
          <div class="col-md-6">
            <form action="index.php?pag=galeria-lista" method="post" id="frmFiltrar" name="frmFiltrar">  
              <div class="input-group">
                <input type="text" class="form-control" id="filtro" name="filtro" placeholder="Pesquisar por..." aria-label="Pesquisar por...">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button" onclick="javascript: document.frmFiltrar.submit()">Filtrar</button>
                </span>
              </div>
            </form>
          </div>
        </div>
  

        
        


        <table class="table table-sm table-hover">
         <tr>
           <th>Titulo da Galeria</th>

           <th colspan="3"></th>
         </tr>

            <?
              $sqlFiltro = ( !empty($filtro) ? "AND titulo like '%$filtro%'" : '');

              $galeriaDB = read('galeria', "WHERE tipo like 'foto'  $sqlFiltro LIMIT $inicio,$maximo");
              if ($galeriaDB) {
                foreach ($galeriaDB as $galeria) {
                  $linkEditar = "index.php?pag=galeria-cad&alterar=$galeria[id]&tipo=foto";
                  $linkExcluir = "index.php?pag=galeria-lista&excluir=$galeria[id]";
                  $linkFotoCad = "index.php?pag=galeria-foto-cad&galeria_id=$galeria[id]";

                  $result = mysql_query("SELECT * FROM galeria_foto WHERE galeria_id = $galeria[id]");
                  $numFoto= mysql_num_rows($result);

                  if ($numFoto>0 ) {
                      $linkExcluir = "#";
                      $corExcluirCategoria = 'btn-light';
                      $msgExcluirCategoria = 'Não é possível excluir essa categoria';
                    } else {
                      $linkExcluir = "index.php?pag=galeria-lista&excluir=$galeria[id]";
                      $corExcluirCategoria = 'btn-danger';
                      $msgExcluirCategoria = 'Excluir Categoria';

                    }  

            ?>
         <tr>
           <td width="100%" ><a href="<?=$linkEditar?>" class="btn btn-light d-flex justify-content-start"><?=$galeria['titulo']?></a></td>
           <td><a href="<?=$linkEditar?>" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Editar Conteúdo"><img src="images/editar_menu.png"></a></td>
           <td><a href="<?=$linkExcluir?>" class="btn <?=$corExcluirCategoria?> " data-toggle="tooltip" data-placement="top" title="<?=$msgExcluirCategoria?>"><img src="images/excluir_menu.png"></a></td>

           <td><a href="<?=$linkFotoCad?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Inserir  Fotos"><img src="images/inserir_foto.png">  <span class="badge badge-light"><?=$numFoto?></span></a></td>
         </tr>

        






           <? // fim rotina listagem menu principal 
                }
              }
            ?> 

        </table>



        <?
          //paginacao

            $sqlFiltro = ( !empty($filtro) ? "AND titulo like '%$filtro%'" : '');
            $sqlTotal = "SELECT * FROM galeria  WHERE tipo like 'foto' $sqlFiltro ";
            $qrTotal    = mysql_query($sqlTotal);
            $numTotal   = mysql_num_rows($qrTotal);
            $totalPagina= ceil($numTotal/$maximo);


            
        ?>
        <? //https://pt.stackoverflow.com/questions/26303/como-fazer-pagina%C3%A7%C3%A3o-php-e-mysql ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <!-- <li class="page-item disabled">
              <a class="page-link" href="#" >Primeiro</a>
            </li> -->
            <? for ($i=1; $i<=$totalPagina; $i++) {
                $linkp="index.php?pag=galeria-lista&pg=$i";
                $pgSel = ( $pg == $i ? "pgSel": "" );
            ?>
                <li class="page-item <?=$pgSel?>"><a class="page-link" href="<?=$linkp?>"><?=$i?></a></li>
            <? } ?>
             <!-- <li class="page-item">
              <a class="page-link" href="#">Último</a>
            </li>  -->
          </ul>
        </nav>

      </div>
      <!-- FIM CONTEÚDO DO CARD -->

    </div>
  </div>







  



</div>  
