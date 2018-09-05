 <!--  Gerenciamento de menu -->
 <? require_once('../lib/validaSessaoAdm.php');?>
 <p class="nome-recurso">gerenciamento de conteúdo</p>
 <p class="nome-acao">Gerenciamento de Menus</p>
 
  
<?
$excluir   = (isset($_GET['excluir'])     ? $_GET['excluir']    : '');

if (!empty($excluir)) {
  delete('menu', "id=$excluir");
}

?>

<div id="accordion" role="tablist" >
 
<?
 $localizacaoMenuBD = read('menu_localizacao');
 if ($localizacaoMenuBD) {
    $a=0;
    foreach ($localizacaoMenuBD as $localizacaoMenu) {
    $a++;  

  if($a>0) {
  
?>
  

  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="heading<?=$a?>One">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapse<?=$a?>One" aria-expanded="true" aria-controls="collapse<?=$a?>One">
          <?=$localizacaoMenu['descricao']?></a>
      </h5>
    </div>

    <div id="collapse<?=$a?>One" class="collapse show" role="tabpanel" aria-labelledby="heading<?=$a?>One" data-parent="#accordion">
     
      <!-- CONTEÚDO DO CARD -->
      <div class="card-body">
        
        <a href="index.php?pag=menu-cad&menu_localizacao_id=<?=$localizacaoMenu['id']?>" class="btn btn-primary">Inserir Menu</a><br><br>
        
        <table class="table table-sm table-hover">
         <tr>
           <th>Nome do menu</th>
           <th>ordem</th>
           <th>situação</th>

           <th colspan="2"></th>
           <th colspan="2"></th>
         </tr>



            <?
              $menuBD = read('menu', "WHERE menu_localizacao_id = $localizacaoMenu[id] AND precedencia = 0 ORDER BY ordem");
              if ($menuBD) {
                foreach ($menuBD as $menu) {

                  $linkEditar = "index.php?pag=menu-cad&alterar=$menu[id]&menu_localizacao_id=$menu[menu_localizacao_id]";

                  $result = mysql_query("SELECT * FROM conteudo WHERE menu_id = $menu[id]");
                  $numConteudo = mysql_num_rows($result);

                  $result = mysql_query("SELECT * FROM menu WHERE precedencia = $menu[id]");
                  $temFilho = mysql_num_rows($result); 


                  if ($numConteudo>0 || $temFilho>0) {
                      $linkExcluir = "#";
                      $corExcluirMenu = 'btn-light';
                      $msgExcluirMenu = 'Não é possível excluir esse menu';
                    } else {
                      $linkExcluir = "index.php?pag=menu-lista&excluir=$menu[id]";
                      $corExcluirMenu = 'btn-danger';
                      $msgExcluirMenu = 'Excluir Menu';

                    }  
                  
                  $linkConteudoCad = "index.php?pag=conteudo-cad&menu_id=$menu[id]";
                  $linkConteudoLista = "index.php?pag=conteudo-lista&menu_id=$menu[id]";


                  

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
           <td><a href="<?=$linkEditar?>" class="btn btn-info " data-toggle="tooltip" data-placement="top" title="Editar Menu"><img src="images/editar_menu.png"></a></td>

           <td><a href="<?=$linkExcluir?>" class="btn <?=$corExcluirMenu?> " data-toggle="tooltip" data-placement="top" title="<?=$msgExcluirMenu?>"><img src="images/excluir_menu.png"></a></td>

           <td><a href="<?=$linkConteudoCad?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Inserir Conteúdo"><img src="images/inserir_conteudo.png"></a></td>

           <td><a href="<?=$linkConteudoLista?>" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Listar Conteúdo"><img src="images/listar_conteudo.png"><span class="badge badge-light"><?=$numConteudo?></span></a></td>
         </tr>

        <!-- SUBMENU -->



            <?
              $menuBD = read('menu', "WHERE menu_localizacao_id = $localizacaoMenu[id] AND precedencia = $menu[id] ORDER BY ordem");
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





<?
  }
    } // end if localizacaoMenu
 } // end foreach localizacaoMenu

?> 

  



</div>  
