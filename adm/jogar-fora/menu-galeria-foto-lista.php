 <!--  Gerenciamento de menu -->
 <? require_once('../lib/validaSessaoAdm.php');?>
<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<?
$excluir   = (isset($_GET['excluir'])     ? $_GET['excluir']    : '');

if (!empty($excluir)) {
  delete('menu', "id=$excluir");
}

?>

<div id="accordion" role="tablist" >
 
<?
// tanto a galeria de fotos quanto a de videos sempre estarão na localizao 1
// na prática isso anula o efeito de localização para as galerias de video e imagem.;
 $localizacaoMenu = 1;
?>



  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="heading<?=$a?>One">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapse<?=$a?>One" aria-expanded="true" aria-controls="collapse<?=$a?>One">
          <!-- ttiulo -->
      </h5>
    </div>

    <div id="collapse<?=$a?>One" class="collapse show" role="tabpanel" aria-labelledby="heading<?=$a?>One" data-parent="#accordion">
     
      <!-- CONTEÚDO DO CARD -->
      <div class="card-body">
        
        <a href="index.php?pag=menu-galeria-foto-cad&menu_localizacao_id=<?=$localizacaoMenu?>" class="btn btn-primary">Inserir Categoria</a><br><br>
        
        <table class="table table-sm table-hover">
         <tr>
           <th>Nome do categoria</th>
           <th>ordem</th>
           <th>situação</th>

           <th colspan="2"></th>
           <th colspan="2"></th>
         </tr>



            <?
              // pega o id do tipo de menu que seja galeria de foto
             $menu_tipo_id = getTipoMenuFoto();


              $menuBD = read('menu', "WHERE menu_localizacao_id = $localizacaoMenu  AND precedencia = 0 AND menu_tipo_id=$menu_tipo_id ORDER BY ordem");
              if ($menuBD) {
                foreach ($menuBD as $menu) {

                  $linkEditar = "index.php?pag=menu-galeria-foto-cad&alterar=$menu[id]&menu_localizacao_id=$menu[menu_localizacao_id]";

                  $result = mysql_query("SELECT * FROM galeria_foto WHERE galeria_menu_id = $menu[id]");
                  $numFoto= mysql_num_rows($result);

                  $result = mysql_query("SELECT * FROM menu WHERE precedencia = $menu[id]");
                  $temFilho = mysql_num_rows($result); 


                  if ($numFoto>0 || $temFilho>0) {
                      $linkExcluir = "#";
                      $corExcluirMenu = 'btn-light';
                      $msgExcluirMenu = 'Não é possível excluir essa categoria';
                    } else {
                      $linkExcluir = "index.php?pag=menu-lista&excluir=$menu[id]";
                      $corExcluirMenu = 'btn-danger';
                      $msgExcluirMenu = 'Excluir Categoria';

                    }  
                  
                  $linkFotoCad = "index.php?pag=galeria-foto-cad&menu_id=$menu[id]";


                  

            ?>
         <tr>
           <td width="100%" ><a href="<?=$linkEditar?>" class="btn btn-light d-flex justify-content-start"><?=$menu['titulo']?></a></td>
           <td ><a href="<?=$linkEditar?>" class="btn btn-light"><?=sprintf("%03d", $menu['ordem']) ?></a></td>
           <td> 

              <?
                if ($menu['situacao'] == "on") {
                  echo "<a href=\"$linkEditar\" class=\"btn btn-success\"> On</a>";
                } else {
                  echo "<a href=\"linkEditar\" class=\"btn btn-light\"> Off</a>";
                }

              ?>
           </td>
           <td><a href="<?=$linkEditar?>" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Editar Categoria"><img src="images/editar_menu.png"></a></td>

           <td><a href="<?=$linkExcluir?>" class="btn <?=$corExcluirMenu?> " data-toggle="tooltip" data-placement="top" title="<?=$msgExcluirMenu?>"><img src="images/excluir_menu.png"></a></td>

           <td><a href="<?=$linkFotoCad?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Inserir Galeria de Fotos"><img src="images/inserir_foto.png">  <span class="badge badge-light"><?=$numFoto?></span></a></td>

          
         </tr>

        <!-- SUBMENU -->



            <?
              $menuBD = read('menu', "WHERE menu_localizacao_id = $localizacaoMenu AND precedencia = $menu[id] ORDER BY ordem");
              if ($menuBD) {
                foreach ($menuBD as $menu) {
                  $linkEditar = "index.php?pag=menu-cad&alterar=$menu[id]&menu_localizacao_id=$menu[menu_localizacao_id]";
                  $linkConteudoCad = "index.php?pag=conteudo-cad&menu_id=$menu[id]";
                  $linkConteudoLista = "index.php?pag=conteudo-lista&menu_id=$menu[id]";

                  $resultS = mysql_query("SELECT * FROM conteudo WHERE menu_id = $menu[id]");
                  $numConteudoS = mysql_num_rows($resultS);

                  if ($numConteudoS>0) {
                      $linkExcluir = "#";
                      $corExcluirMenu = 'btn-light';
                      $msgExcluirMenu = 'Não é possível excluir esse menu';
                    } else {
                      $linkExcluir = "index.php?pag=menu-lista&excluir=$menu[id]";
                      $corExcluirMenu = 'btn-danger';
                      $msgExcluirMenu = 'Excluir Menu';

                    }  

                  
            ?>
         <tr>

           <td width="100%" ><a href="<?=$linkEditar?>" class="btn btn-light d-flex justify-content-start ml-3"><img src="images/seta.png"><?=$menu['titulo']?></a></td>

           <td ><a href="<?=$linkEditar?>" class="btn btn-light"><?=sprintf("%03d", $menu['ordem']) ?></a></td>
           <td> 
              <?
                if ($menu['situacao'] == "on") {
                  echo "<a href=\"$linkEditar\" class=\"btn btn-success\"> On</a>";
                } else {
                  echo "<a href=\"$linkEditar\" class=\"btn btn-light\"> Off</a>";
                }

              ?>
           </td>
           <td><a href="<?=$linkEditar?>" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Editar Menu"><img src="images/editar_menu.png"></a></td>

           <td><a href="<?=$linkExcluir?>" class="btn <?=$corExcluirMenu?> " data-toggle="tooltip" data-placement="top" title="<?=$msgExcluirMenu?>"><img src="images/excluir_menu.png"></a></td>

           <td><a href="<?=$linkConteudoCad?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Inserir Conteúdo"><img src="images/inserir_conteudo.png"></a></td>

           <td><a href="<?=$linkConteudoLista?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Listar Conteúdo"><img src="images/listar_conteudo.png"> <span class="badge badge-light"><?=$numConteudoS?></span> </a></td>
         </tr>

           <? // fim rotina listagem sub menu 
                }
              }
            ?> 



















           <? // fim rotina listagem menu principal 
                }
              }
            ?> 

        </table>
      </div>
      <!-- FIM CONTEÚDO DO CARD -->

    </div>
  </div>






  



</div>  
