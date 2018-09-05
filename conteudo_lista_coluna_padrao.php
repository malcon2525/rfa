    <!--========================================================
                              HEADER
    =========================================================-->
    <header class="page-header">
        <!-- RD Navbar -->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar" data-rd-navbar-lg="rd-navbar-static">
                <div class="rd-navbar-inner">
                    <!-- RD Navbar Panel -->
                    <div class="rd-navbar-panel">

                        <!-- RD Navbar Brand -->
                        <div class="rd-navbar-brand">
                            <a href="<?=BASE?>">
                                <div class="brand-name primary-color">
                                  <img src="<?=BASE?>/images/logo.png" alt="">

                                </div>
                            </a>
                        </div>
                        <!-- END RD Navbar Brand -->
                    </div>
                    <!-- END RD Navbar Panel -->

                     <div class="rd-navbar-nav-wrap">

                            <? include "menu_topo_pg_principal.php"?>

                            <!-- RD Navbar Toggle -->
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
                            <!-- END RD Navbar Toggle -->
                        </div>

                </div>
            </nav>
        </div>
        <!-- END RD Navbar -->
    </header>

<!--========================================================
                              CONTENT
    =========================================================-->
    <main class="page-content">
        <!-- Privacy Policy -->
        <section class="well well-md">
            <div class="container">
               
      <?
        $sql = "SELECT * FROM menu WHERE uri = '$urlNavegacao[1]'";
        $st = mysql_query($sql) or die ("erro filho");
        $menu = mysql_fetch_assoc($st);
        $nomeMenu=$menu['titulo'];
        $menuID=$menu['id'];
        $uriMenu=$menu['uri'];			
		
      ?>               
               <ul class="caminho_pao">
                 <li><a href="<?=BASE?>">Home</a></li>
                 <li><a href="<?=BASE?>/<?=$urlNavegacao[0]?>/<?=$uriMenu?>"><?=$nomeMenu?></a></li>
               </ul>
               
               
              
<?
//paginacao
$pg = ( empty($urlNavegacao[2]) ? '1' : $urlNavegacao[2]);
$maximo = 30;
$inicio = ($pg * $maximo) - $maximo;
?>


			<div class="row flow-offset-3">
				
            <?
              $a=1;
              $destaquePPDB = read('conteudo', "WHERE menu_id = $menuID AND situacao = 'on' ORDER BY data DESC LIMIT $inicio,$maximo ");
              if ($destaquePPDB) {
                foreach ($destaquePPDB as $destaquePP) {
                  $uriConteudo = $destaquePP['uri'];
				  $foto_reduzida = $destaquePP['foto_reduzida'];
				  $titulo = $destaquePP['titulo'];
				  $data = $destaquePP['data'];
				  
				  $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
				  $diasemana_numero = date('w', strtotime($data));
				  
				  $mes = array('','Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
				  $mes_numero = date('m', strtotime($data))*1;
				  //echo "mes:$mes_numero";
				  
				  $dia = date('d', strtotime($data));
				  $ano = date('Y', strtotime($data));
				  
                  echo "
          
					<div class=\"col-sm-4\">
						<article class=\"news-post\">
							<a href=\"".BASE."/ct/$uriMenu/$uriConteudo\">
                            <img width=\"370\" height=\"264\" src=\"".BASE."/user_files/foto_reduzida\_$foto_reduzida\" alt=\"\">
							</a>
                            <h4><a href=\"".BASE."/ct/$uriMenu/$uriConteudo\">$titulo</a></h4>
                            <time datetime=\"$data\">$diasemana[$diasemana_numero], $dia de $mes[$mes_numero], $ano</time>
                            <a href=\"".BASE."/ct/$uriMenu/$uriConteudo\" class=\"link\">Saiba mais...</a>
                        </article>
					</div>	
					
					
                  ";
                  $a++;
                }
              }
            ?>
				
			</div>				
               
		<?
          //paginacao

            //$sqlFiltro = ( !empty($filtro) ? "AND titulo like '%$filtro%'" : '');
            $sqlFiltro = "";
            $sqlTotal = "SELECT * FROM conteudo  WHERE menu_id=$menuID AND situacao = 'on' $sqlFiltro ";
            $qrTotal    = mysql_query($sqlTotal);
            $numTotal   = mysql_num_rows($qrTotal);
            $totalPagina= ceil($numTotal/$maximo);
        ?>               

               
                              
        <nav>
          <ul class="pagina_lista_conteudo">
            <!-- <li class="page-item disabled">
              <a class="page-link" href="#" >Primeiro</a>
            </li> -->
            <? for ($i=1; $i<=$totalPagina; $i++) {
                $linkp=BASE."/$urlNavegacao[0]/$urlNavegacao[1]/$i";
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
        </section>
        <!-- END Privacy Policy -->
        <div class="divider"></div>
    </main>
