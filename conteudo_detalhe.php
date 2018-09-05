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

<?
				$sql = "SELECT * FROM conteudo WHERE uri = '$urlNavegacao[2]'";
				$st = mysql_query($sql) or die ("erro filho");
				$conteudo = mysql_fetch_assoc($st);
				$conteudoTitulo=$conteudo['titulo'];
				$conteudoConteudo=$conteudo['conteudo'];
				$chamada=$conteudo['chamada'];
				$arquivo=$conteudo['codigo_produto'];
				$data = $conteudo['data'];
				  
				$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
				$diasemana_numero = date('w', strtotime($data));
				  
				$mes = array('','Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
				$mes_numero = date('m', strtotime($data))*1;
				  //echo "mes:$mes_numero";
				  
				$dia = date('d', strtotime($data));
				$ano = date('Y', strtotime($data));

?>  
       
<?
if ($arquivo != "") {
  include "$arquivo";
} else {
?>                     
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
		$tipoMenu = array('','ml','mc');
		$menuTipoID=$menu['menu_tipo_id'];		
		
      ?>               
               <ul class="caminho_pao">
                 <li><a href="<?=BASE?>">Home</a></li>
                 <li><a href="<?=BASE?>/<?=$tipoMenu[$menuTipoID]?>/<?=$uriMenu?>"><?=$nomeMenu?></a></li>
               </ul>
              <div class="ct_container">
                <div class="ct_titulo">
                  <h2 class="text-uppercase"><?=$conteudoTitulo?></h2>
                  <div class="divider"></div>
        <!--							
                    <span class="ct_data"><?=$diasemana[$diasemana_numero]?>, <?=$dia?> de <?=$mes[$mes_numero]?>, <?=$ano?></span>
                  <div class="divider"></div>
        -->
                </div>
                <div class="ct_conteudo">

                    <? echo "$conteudoConteudo";?>  

                </div>
              </div>
            </div>
        </section>
        <!-- END Privacy Policy -->
        <div class="divider"></div>
</main>
<? } ?>