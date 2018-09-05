 <!--  Gerenciamento de menu -->
 <? require_once('../lib/validaSessaoAdm.php');?>


 <p class="nome-recurso"><?=$recurso?></p>
 <p class="nome-acao"><?=$acao?></p>
 
  


<div id="accordion" role="tablist" >
 




  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="heading<?=$a?>One">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapse<?=$a?>One" aria-expanded="true" aria-controls="collapse<?=$a?>One">
          </a>
      </h5>
    </div>

    <div id="collapse<?=$a?>One" class="collapse show" role="tabpanel" aria-labelledby="heading<?=$a?>One" data-parent="#accordion">
     
      <!-- CONTEÚDO DO CARD -->
      <div class="card-body">
        


  

        
        


        <table class="table table-sm table-hover">
         <tr>
           <th>Área do Banner</th>

           <th colspan="2"></th>
         </tr>

            <?
              $bannerDB = read('banner_localizacao');
              if ($bannerDB) {
                foreach ($bannerDB as $banner) {

                  $linkBannerCad = "index.php?pag=banner-cad&largura=$banner[largura]&altura=$banner[altura]&banner_localizacao_id=$banner[id]";

                  $result = mysql_query("SELECT * FROM banner WHERE banner_localizacao_id = $banner[id]");
                  $numBanner= mysql_num_rows($result);

            ?>
         <tr>
           <td width="100%" ><a href="<?=$linkBannerCad?>" class="btn btn-light d-flex justify-content-start"><?=$banner['descricao']?>........ <i>(<?=$banner['largura']?>x<?=$banner['altura']?>) pixels</i></a></td>

           <td><a href="<?=$linkBannerCad?>" class="btn btn-dark " data-toggle="tooltip" data-placement="top" title="Inserir Banner"><img src="images/inserir_foto.png">  <span class="badge badge-light"><?=$numBanner?></span></a></td>
         </tr>

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
