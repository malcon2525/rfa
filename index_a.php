<?
ob_start(); session_start();
require('lib/dbaSis.php');
require('lib/getSis.php');
require('lib/setSis.php');
require('lib/outSis.php');
?>
<!DOCTYPE html>
 <html lang="pt-br" class="wide smoothscroll wow-animation">
  <head>
 
         
      <!-- 
      <meta name="viewport"content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
       -->
       
      <!-- Stylesheets -->
        <link rel="icon" href="<?=BASE?>/images/logo.ico" type="image/x-icon">
        <link href='//fonts.googleapis.com/css?family=Playfair+Display:400,700%7COpen+Sans:400,400italic%7CMontserrat' rel="stylesheet"/>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style1.css">
        
        <!--[if lt IE 10]>
          <script src="js/html5shiv.min.js"></script>
        <![endif]-->


<?
$urlNavegacao = getHome();
//mostraMatriz($urlNavegacao);
?> 

<?
	 //mostraVar('dld', count($urlNavegacao));
    if ($urlNavegacao[0] == 'ct' || $urlNavegacao[0] == 'pd') {
         //   www.dominio.com.ber/ct/nome_menu/uri_conteudo
				$conteudoDB = read('conteudo', "WHERE uri = '$urlNavegacao[2]'");
				if ($conteudoDB) {
					foreach ($conteudoDB as $conteudoH) {
						$site_name = SITENAME;
						$title = $conteudoH['title']." | ".SITENAME;
						$description = $conteudoH['description'];
						$url_site = BASE."/$urlNavegacao[0]/$urlNavegacao[1]/$urlNavegacao[2]";
					}
				}
    }elseif ($urlNavegacao[0] == 'ml' || $urlNavegacao[0] == 'mc') {
        $conteudoDB = read('menu', "WHERE uri = '$urlNavegacao[1]'");
        if ($conteudoDB) {
          foreach ($conteudoDB as $conteudoH) {
            $site_name = SITENAME;
            $title = $conteudoH['title']." | ".SITENAME;
            $description = $conteudoH['description'];
            $url_site = BASE."/$urlNavegacao[0]/$urlNavegacao[1]";
          }
        }
      
    }else if ($urlNavegacao[0] == 'faca-parte-do-time') {
    	$site_name = SITENAME;
			$title = "Cadastro de Revendedoras | ".SITENAME;
			$description = "Faça seu cadastro.";
			$url_site = BASE."/$urlNavegacao[0]";

    }else {
      $site_name    = SITENAME;
      $title        = SITETITLE; 
      $description  = SITEDESC;
      $url_site     = BASE;
    }

  ?>      
      <meta charset="utf-8">
      <title><?=$title?></title>   
      <meta name="description" content="<?=$description?>">

      <meta property="og:site_name" content="<?=$site_name?>">
      <meta property="og:title" content="<?=$title?>">
      <meta property="og:description" content="<?=$description?>">

      <meta property="og:locale" content="pt_BR">
      <meta property="og:image" content="<?=BASE?>/images/logo.png">
      <meta property="og:url" content="<?=$url_site?>">
      <meta property="og:type" content="website">
      
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta name="googlebot" content="noodp">
      <meta name="robots" content="index, follow">
      <link rel="shortcut icon" href="favicon.ico">


      <link rel="stylesheet" href="<?=BASE?>/css/bootstrap.css">

      <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
      <script src="<?=BASE?>/js/jquery.js"></script>
      <script src="<?=BASE?>/js/popper.min.js"></script>
      <script src="<?=BASE?>/js/bootstrap.js"></script>
      
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Italianno" rel="stylesheet">
      
      <link rel="stylesheet" href="<?=BASE?>/css/style.css">
      <link rel="stylesheet" href="<?=BASE?>/css/hover.css">

  
      <link rel="stylesheet" href="<?=BASE?>/css/responsiveslides.css"> 
      <script src="<?=BASE?>/js/responsiveslides.min.js"></script>
  
  </head>
  
  <body>

   
   
    

<?
	 //mostraVar('urlNavegacao', $urlNavegacao[0]);
	 //mostraMatriz($urlNavegacao);


switch ($urlNavegacao[0]) {
  case 'index':
    require('home.php');
    break;
  case 'ml':
    require('conteudo_lista_linha.php');
    break;
  
  case 'mc':
    require('conteudo_lista_coluna.php');
    break;

  case 'lc':
    require('conteudo_lista_coluna_lancamento.php');
    break;
  
  case 'ct':
    require('conteudo_detalhe.php');
    break;
  case 'pd':
    require('conteudo_produto_detalhe.php');
    break;


  case 'galeria':
    require('galeria.php');
    break;
  case 'foto-galeria':
    require('galeria-foto.php');
    break;
  case 'video-galeria':
    require('galeria-video.php');
    break;
  case 'faca-parte-do-time':
    require('cadastro-revendedora.php');
    break;

  default:
    require('home.php');
		break;

}


?>


   
   
<script src="js/core.min.js"></script>
<!-- Additional Functionality Scripts -->
<script src="js/script.js"></script>
    
  </body>
</html>