<!-- The Main Wrapper -->
<div class="page text-center">

    <!--For older internet explorer-->
    <div class="old-ie"
         style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <!--END block for older internet explorer-->

    <!--========================================================
                              HEADER
    =========================================================-->
    <header class="page-header">
          <!-- RD Navbar -->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-custom" data-rd-navbar-lg="rd-navbar-static">
                    <div class="rd-navbar-inner">
                        <!-- RD Navbar Panel -->
                        <div class="rd-navbar-panel">

                            <!-- RD Navbar Brand -->
                            <div class="rd-navbar-brand">
                                <a href="<?=BASE?>">
                                    <div class="brand-name primary-color">
                                       <img src="images/logo.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <!-- END RD Navbar Brand -->
                        </div>
                        <!-- END RD Navbar Panel -->

                        <div class="rd-navbar-nav-wrap">
                        
        <div class="container relative">
            <? include "menu_topo_pg_principal.php"?>
        </div>

                            <!-- RD Navbar Toggle -->
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
                            <!-- END RD Navbar Toggle -->
                        </div>

                    </div>
                </nav>
            </div>
            <!-- END RD Navbar -->
       
        <!-- Swiper -->
        
<?
$ConteudoTopoBD = read('conteudo', 'WHERE conteudo_localizacao_id=2 ORDER BY id LIMIT 1');
$tituloCD = $ConteudoTopoBD['0']['chamada'];
$uriCD = $ConteudoTopoBD['0']['uri'];


//mostraMatriz($ConteudoTopoBD);
?>        
        
        <div class="swiper-container swiper-slider"  data-height="440px" data-loop="true">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-slide-title="" data-slide-bg="images/banner_pp_01.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container" data-caption-animate="fadeIn">
                            <div class="row">
                                <div class="col-md-6 col-md-preffix-3 col-lg-4 col-lg-preffix-2 text-center text-lg-right">
                                    <h1 class="text-bold text-uppercase foreground-text relative">
                                    <?=$tituloCD?></h1>
                                    <a href="<?=BASE?>/ct/conteudos-pp/<?=$uriCD?>" class="btn btn-md btn-default">Saiba Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="swiper-slide" data-slide-title="Slogan 2" data-slide-bg="images/page-1_img03.jpg">
                    <div class="swiper-slide-caption ">
                        <div class="container" data-caption-animate="fadeIn">
                            <div class="row">
                                <div class="col-md-6 col-md-preffix-3 col-lg-4 col-lg-preffix-2 text-center text-lg-right">
                                    <h1 class="text-bold text-uppercase foreground-text relative">Intensive  Healing  Pedicure </h1>
                                    <a href="#" class="btn btn-md btn-default">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-title="Slogan 3" data-slide-bg="images/page-1_img02.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container" data-caption-animate="fadeIn">
                            <div class="row">
                                <div class="col-md-6 col-md-preffix-3 col-lg-5 col-lg-preffix-1 text-center text-lg-right">
                                    <h1 class="text-bold text-uppercase foreground-text relative">Spa  Manicure </h1>
                                    <a href="#" class="btn btn-md btn-default">Read more</a>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- Slider Navigation -->
            
            <div class="swiper-navigation-wrapper">
                <div class="swiper-button swiper-button-prev">
                    <span class="swiper-button__arrow"></span>

                    <div class="preview">
                        <div class="title"></div>
                    </div>
                </div>
                <div class="swiper-button swiper-button-next">
                    <span class="swiper-button__arrow"></span>

                    <div class="preview">
                        <div class="title"></div>
                    </div>
                </div>

            </div>
            
            
            
        </div>
        <!-- END Swiper -->

    </header>
    <!--========================================================
                              CONTENT
    =========================================================-->
    <main class="page-content">
        <!-- YOUR ESCAPE FROM EVERYDAY ROUTINE -->
        <section class="well well-xs well--inset-4">
            <div class="container">
                <div class="row row-md-middle row-md-reverse">
                    <div class="col-md-5  col-md-preffix-1 text-md-left">
<?
$conteudoTopoD1 = read('conteudo', 'WHERE conteudo_localizacao_id=4 ORDER BY id LIMIT 1');
$tituloD1 = $conteudoTopoD1['0']['titulo'];
$chamadaD1 = $conteudoTopoD1['0']['chamada'];
$uriD1 = $conteudoTopoD1['0']['uri'];
$fotoD1 = $conteudoTopoD1['0']['foto_reduzida'];


//mostraMatriz($conteudoTopoD1);
?>
                        <h2><?=$tituloD1?></h2>

                        <p><?=$chamadaD1?></p>
                        <a href="<?=BASE?>/ct/conteudos-pp/<?=$uriD1?>" class="btn btn-md btn-default">Saiba mais</a>
                    </div>
                    <div class="col-md-5 col-md-preffix-1">
                        <div class="decorative-wrap-2 preffix-2 content-md-shift-up">
                            <div class="decorative-border"></div>
                            <div class="decorative-background"></div>
                            <div class="image-wrap"><img width="459" height="651" src="<?=BASE?>/user_files/foto_reduzida/_<?=$fotoD1?>" alt=""></div>
                        </div>
                    </div>
                </div>
<?
$conteudoRM = read('conteudo', 'WHERE conteudo_localizacao_id=6 ORDER BY id LIMIT 1');
$tituloRM = $conteudoRM['0']['titulo'];
$conteudo = $conteudoRM['0']['conteudo'];
$fotoRM = $conteudoRM['0']['foto_reduzida'];


//mostraMatriz($conteudoRM);
?>
                <div class="row row-md-middle">
                    <div class="col-md-5 col-md-preffix-1 col-lg-4 text-md-right">
                        <h2 class="text-uppercase"><?=$tituloRM?></h2>

                        <p><?=$conteudo?></p>

                        <div class="discount text-primary"></div>
                        <a href="<?=BASE?>/mc/revendora-do-mes" class="btn btn-md btn-default">Veja a lista completa</a>
                    </div>
                    <div class="col-md-5 col-md-preffix-1">
                        <div class="decorative-wrap-1 preffix-1">
                            <div class="decorative-border"></div>
                            <div class="image-wrap"><img width="414" height="405" src="<?=BASE?>/user_files/foto_reduzida/_<?=$fotoRM?>" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END YOUR ESCAPE FROM EVERYDAY ROUTINE-->
        
        <section>
          
            <!-- Swiper -->
            <div class="swiper-container swiper-slider">
                <div class="swiper-wrapper">

<?
 $bannerBD = read('banner', 'WHERE banner_localizacao_id=1 ORDER BY id');
 //mostraMatriz($depoimentoBD);
 if ($bannerBD) {
    $a=0;
    foreach ($bannerBD as $banner) {
    $a++;  

  if($a>0) {
    
    //mostraMatriz($banner);
?>

                    <div class="swiper-slide">
                        <div class="swiper-slide-caption">
                            <img src="<?=BASE?>/user_files/banner/_<?=$banner['foto']?>" width="100%" alt="">
                        </div>
                    </div>
<? } } } ?>
                    
                </div>

                <!-- Swiper Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Swiper Navigation -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>



          
        </section>

        <!-- Spa Manicure  -->
        <section class="well well-xs well--inset-5">
            <div class="container">
                <div class="row row-md-middle row-md-reverse">
                    <div class="col-md-4 text-md-left">
<?
$conteudoTopoD2 = read('conteudo', 'WHERE conteudo_localizacao_id=5 ORDER BY id LIMIT 1');
$tituloD2 = $conteudoTopoD2['0']['titulo'];
$chamadaD2 = $conteudoTopoD2['0']['chamada'];
$uriD2 = $conteudoTopoD2['0']['uri'];
$fotoD2 = $conteudoTopoD2['0']['foto_reduzida'];


//mostraMatriz($conteudoTopoD1
?>
                        <h2 class="text-uppercase foreground-text preffix-4 relative"><?=$tituloD2?></h2>

                        <p><?=$chamadaD2?> </p>

                        <div class="discount text-primary"></div>
                        <a href="<?=BASE?>/ct/conteudos-pp/<?=$uriD2?>" class="btn btn-md btn-default">Saiba mais</a>
                    </div>
                    <div class="col-md-8">
                        <div class="decorative-wrap-3 postfix-1 preffix-3">
                            <div class="decorative-border"></div>
                            <div class="decorative-background"></div>
                            <div class="image-wrap"><img width="706" height="407" src="<?=BASE?>/user_files/foto_reduzida/_<?=$fotoD2?>" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END Spa Manicure -->

        <!-- Featured Articles -->
        <section class="well well-xl well--inset-6 bg-contrast-darkest">
            <div class="container">
                <h2 class="text-uppercase">Últimas Postagens</h2>

                <div class="row flow-offset-3">
                   
                   
<?
 $blogBD = read('conteudo', 'WHERE conteudo_localizacao_id=9 ORDER BY id LIMIT 3');
 //mostraMatriz($depoimentoBD);
 if ($blogBD) {
    $a=0;
    foreach ($blogBD as $blog) {
    $a++;  

  if($a>0) {
    
          $data = $blog['data'];
					
					$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
					$diasemana_numero = date('w', strtotime($data));
					  
					$mes = array('','Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
					$mes_numero = date('m', strtotime($data))*1;
					//echo "mes:$mes_numero";
					  
					$dia = date('d', strtotime($data));
					$ano = date('Y', strtotime($data));
  
?>	
                    <div class="col-sm-4">
                        <article class="news-post">
                            <img width="370" height="264" src="<?=BASE?>/user_files/foto_reduzida/_<?=$blog['foto_reduzida']?>" alt="">
                            <h4><a href="blt/alimentacao/<?=$blog['uri']?>"><?=$blog['titulo']?></a></h4>
                            <time ><?=$diasemana[$diasemana_numero]?>, <?=$dia?> de <?=$mes[$mes_numero]?>, <?=$ano?></time>
                            <a href="blt/alimentacao/<?=$blog['uri']?>" class="link">Leia mais</a>
                        </article>
                    </div>
                
<?  
    }
  }
 }
?> 
      
                </div>
            </div>
        </section>
        <!-- END Featured Articles  -->

        <!-- Testimonials -->
        <section class="well well-md">
            <h2 class="text-uppercase">Depoimentos</h2>
            <!-- Owl Carousel -->
                <div class="owl-carousel"
                     data-loop="true"
                     data-md-items="1"
                     data-stage-padding="15"
                     data-sm-stage-padding="50"
                     data-exl-stage-padding="0"
                     data-xxl-stage-padding="640"
                     data-xl-stage-padding="520"
                     data-lg-stage-padding="310"
                     data-nav="true"
                     data-margin="15"
                     data-sm-margin="90"
                     data-md-margin="70"
                    >
                                    
<?
 $depoimentoBD = read('conteudo', 'WHERE conteudo_localizacao_id=8 ORDER BY id LIMIT 5');
 //mostraMatriz($depoimentoBD);
 if ($depoimentoBD) {
    $a=0;
    foreach ($depoimentoBD as $depoimentos) {
    $a++;  

  if($a>0) {
  
?>	                   
                    
                    <div>
                        <!--data-autoplay="true"-->
                        <blockquote class="quote">
                            <div class="image-wrap">
                                <img width="110" height="110" class="round" src="<?=BASE?>/user_files/foto_reduzida/_<?=$depoimentos['foto_reduzida']?>" alt="">
                            </div>
                            <p><q><?=$depoimentos['conteudo']?>  </q></p>

                            <div class="divider"></div>
                            <footer><cite class="heading-4"><?=$depoimentos['titulo']?></cite></footer>
                        </blockquote>
                    </div>
                    

<?  
    }
  }
 }
?> 
                                        
                    
                </div>
            <!-- END Owl Carousel -->
        </section>
        <!-- END Testimonials-->

        <!-- Google Map -->
        <section>
            <!-- RD Google Map -->
            <div class="rd-google-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2547.8174982885785!2d-49.275947293309734!3d-25.43297867834844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcf01c180afecd3ad!2sRalifla!5e0!3m2!1spt-BR!2sbr!4v1529969471841" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- END RD Google Map -->
        </section>
        <!-- END Google Map-->

    </main>
    
    
    
