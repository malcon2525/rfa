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
        <section class="well well-md bg-contrast-darkest">
            <div class="container">
               
             
               <ul class="caminho_pao">
                 <li><a href="<?=BASE?>">Home</a></li>
                 <li><a href="<?=BASE?>/blog">BLOG</a></li>
               </ul>
               
               
            <h2 class="text-uppercase">Últimas Postagens</h2>  

			<div class="row flow-offset-3">
			
			
				
            <?
              $a=1;

			  $sql = "
				SELECT 
					conteudo.titulo as ct_titulo,
					conteudo.data as ct_data,
					conteudo.foto_reduzida as ct_foto_reduzida,
					conteudo.uri as ct_uri,
					menu.uri as mnu_uri
						
					FROM conteudo 				
					LEFT JOIN menu ON conteudo.menu_id = menu.id
					
					WHERE conteudo.situacao = 'on' AND menu.menu_localizacao_id = '4'
					
					ORDER BY data DESC LIMIT 6
			  ";
			  
				$consulta = "SELECT * FROM conteudo";
				$result = mysql_query($sql);
		  
				while($row = mysql_fetch_array($result)){

					$uriMenu = $row['mnu_uri'];
					$uriConteudo = $row['ct_uri'];
					
					$foto_reduzida = $row['ct_foto_reduzida'];
					$titulo = $row['ct_titulo'];
					$data = $row['ct_data'];
					
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
								<a href=\"".BASE."/blt/$uriMenu/$uriConteudo\">
								<img width=\"370\" height=\"264\" src=\"".BASE."/user_files/foto_reduzida\_$foto_reduzida\" alt=\"\">
								</a>
								<h4><a href=\"".BASE."/blt/$uriMenu/$uriConteudo\">$titulo</a></h4>
								<time datetime=\"$data\">$diasemana[$diasemana_numero], $dia de $mes[$mes_numero], $ano</time>
								<a href=\"".BASE."/blt/$uriMenu/$uriConteudo\" class=\"link\">Saiba mais...</a>
							</article>
						</div>	
						
						
					";
          
		  
		  		}

            ?>
				
			</div>				
               
		            
		<!-- news archives -->
        <section class="well well-sm">
            <div class="container">
                <h2 class="text-uppercase">Categorias</h2>
                <div class="row text-left offset-5">
					<div class="blog_cat_pp row">

<?
              $a=1;
              $catetoriaBlogBD = read('menu', "WHERE menu_localizacao_id = '4' AND situacao = 'on' ORDER BY ordem ");
              if ($catetoriaBlogBD) {
                foreach ($catetoriaBlogBD as $catetoriaBlog) {
					
                  $titulo_categoria = $catetoriaBlog['titulo'];
                  $uri_categoria = $catetoriaBlog['uri'];
				  
                  echo "
					
					<a href=\"".BASE."/bll/$uri_categoria\" class=\"col-sm-4\">$titulo_categoria</a>
					
                  ";
                  $a++;
                }
              }
            ?>
					
					</div>
				</div>
                
            </div>
        </section>
        <!-- END Privacy Policy -->
        <div class="divider"></div>
    </main>
