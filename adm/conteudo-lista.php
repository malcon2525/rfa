 <!--  Gerenciamento de menu -->
 <? require_once('../lib/validaSessaoAdm.php');?>
 
 <? 
$codac = (isset($_GET['codac'])			? $_GET['codac']					: ''); 
?>
 
 <p class="nome-recurso">gerenciamento de conteúdo</p>
 <p class="nome-acao">Gerenciamento de Menus</p>
 
  
<?
$excluir   = (isset($_GET['excluir'])     ? $_GET['excluir']    : '');
$menu_id   = (isset($_GET['menu_id'])     ? $_GET['menu_id']    : '');

$filtro = ( isset($_POST['filtro']) ? $_POST['filtro'] : '') ; 

if (!empty($excluir)) {
  // apagando as fotos do conteúdo
  $fotoConteudoDBEX = read('galeria_foto_conteudo', "WHERE conteudo_id = $excluir");
  if ($fotoConteudoDBEX) {
    foreach ($fotoConteudoDBEX as $fotoConteudoEX) {
      $nomeFotoEX = $fotoConteudoEX['foto'];
       unlink("../user_files/foto_conteudo/_$nomeFotoEX");
    }
  }
  delete("galeria_foto_conteudo", "conteudo_id=$excluir");

  // fim apagar fotos do conteúdo



  $nome_foto = getCampo("conteudo", "$excluir", "foto_reduzida");
  if ($nome_foto != "") {
    if (file_exists("../user_files/foto_reduzida/_$nome_foto")){
       unlink("../user_files/foto_reduzida/_$nome_foto");
    }
  }
  delete('conteudo', "id=$excluir");
}

?>


<?
//paginacao
$pg = ( empty($_GET['pg']) ? '1' : $_GET['pg']);
$maximo = 30;
$inicio = ($pg * $maximo) - $maximo;
?>



<div id="accordion" role="tablist" >
 




  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="heading<?=$a?>One">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapse<?=$a?>One" aria-expanded="true" aria-controls="collapse<?=$a?>One"></a>
          Lista de conteúdos do menu:  <span class="conteudo-tit-cad"> 
            <? echo getCampo("menu", "$menu_id", "titulo");  ?> </span>
      </h5>
    </div>

    <div id="collapse<?=$a?>One" class="collapse show" role="tabpanel" aria-labelledby="heading<?=$a?>One" data-parent="#accordion">
     
      <!-- CONTEÚDO DO CARD -->
      <div class="card-body">
        



        <div class="row"> 
          <div class="col-md-6">
            <a href="index.php?pag=conteudo-cad&menu_id=<?=$menu_id?>&codac=<?=$codac?>" class="btn btn-primary">Inserir Conteúdo</a><br><br>
          </div>
          <div class="col-md-6">
            <?
              $menu_id = ( isset($_GET['menu_id']) ? $_GET['menu_id'] : '');
            ?>
            <form action="index.php?pag=conteudo-lista&menu_id=<?=$menu_id?>" method="post" id="frmFiltrar" name="frmFiltrar">  
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
           <th>Titulo</th>
           <th>situação</th>

           <th colspan="2"></th>
         </tr>



            <?

              
              $sqlFiltro = ( !empty($filtro) ? "AND titulo like '%$filtro%'" : '');

              $conteudoDB = read('conteudo', "WHERE menu_id = $menu_id  $sqlFiltro LIMIT $inicio,$maximo");
              if ($conteudoDB) {
                foreach ($conteudoDB as $conteudo) {
                  $linkEditar = "index.php?pag=conteudo-cad&alterar=$conteudo[id]&menu_id=$conteudo[menu_id]&codac=$codac";
                  $linkExcluir = "index.php?pag=conteudo-lista&excluir=$conteudo[id]&menu_id=$conteudo[menu_id]";
            ?>
         <tr>
           <td class="lista_padrao" width="100%" ><a href="<?=$linkEditar?>" ><?=$conteudo['titulo']?></a></td>
           <td> 

              <?
                if ($conteudo['situacao'] == "on") {
                  echo "<a href=\"$linkEditar\" class=\"btn btn-success\"> On</a>";
                } else {
                  echo "<a href=\"$linkEditar\" class=\"btn btn-light\"> Off</a>";
                }

              ?>
           </td>
           <td><a href="<?=$linkEditar?>" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Editar Conteúdo"><img src="images/editar_menu.png"></a></td>
           <td><a href="<?=$linkExcluir?>" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Excluir Conteúdo"><img src="images/excluir_menu.png"></a></td>
         </tr>

        






           <? // fim rotina listagem menu principal 
                }
              }
            ?> 

        </table>



        <?
          //paginacao

            $sqlFiltro = ( !empty($filtro) ? "AND titulo like '%$filtro%'" : '');
            $sqlTotal = "SELECT * FROM conteudo  WHERE menu_id=$menu_id $sqlFiltro ";
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
                $linkp="index.php?pag=conteudo-lista&menu_id=$menu_id&pg=$i";
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
