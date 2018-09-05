<?php 
ob_start(); 
session_start();
require('../lib/validaSessaoAdm.php');
require('../lib/dbaSis.php');
require('../lib/getSis.php');
require('../lib/setSis.php');
require('../lib/outSis.php');
?>

<?
$id_usuario = $_SESSION['id_usuario'];
//echo "usuario = $id_usuario ";

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Manager On Click &reg;</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  
  <meta name="title" content="Painel Adm - Manager OnClick" />
  <meta name="description" content="Àrea restrita" />
  <meta name="robots" content="NOINDEX,NOFOLLOW" />
  
  <link rel="shortcut icon" href="favicon.ico">
  
  <link rel="stylesheet" href="../css_matrix/bootstrap.css">
  <link rel="stylesheet" href="../css_matrix/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="../js_matrix/jquery.js"></script>
  <script src="../js_matrix/popper.min.js"></script>
  <script src="../js_matrix/bootstrap.js"></script>
  <script src="../js_matrix/bootstrap-toggle.min.js"></script>
  <!-- DOCUMENTACAO TOGGLE -->
  <!-- http://www.bootstraptoggle.com -->
  
  
  <script src="ckeditor/ckeditor.js"></script>
  
</head>


<body>
  

<div class="container tudo">
 <div class="row">
  <div class="col-3 col-esquerda">
    <ul class="menu-adm-esquerdo">
      <li class="mnu-manager"><span>Manager</span> OnClick</li>
      <li class="mnu-logo"><img src="images/logo.png" alt=""></li>

      <li class="mnu-titulo">Conteúdo</li>
      <li class="mnu-item"><a href="index.php?pag=menu-lista">Gerenciar Blog</a></li>
      <li class="mnu-item"><a href="index.php?pag=conteudo-cad&alterar=111&menu_id=20&codac=2">Gerenciar Destaque Topo</a></li>
      <li class="mnu-item"><a href="index.php?pag=conteudo-cad&alterar=108&menu_id=20&codac=4">Gerenciar Destaque 1</a></li>
      <li class="mnu-item"><a href="index.php?pag=conteudo-cad&alterar=113&menu_id=20&codac=6">Texto P. Principal - Rev. do mês</a></li>
      <li class="mnu-item"><a href="index.php?pag=conteudo-lista&menu_id=21&codac=7">Cadastrar Revend. do Mês.</a></li>
      
      <li class="mnu-item"><a href="index.php?pag=conteudo-cad&alterar=110&menu_id=20&codac=5">Gerenciar Destaque 2</a></li>
      
      <li class="mnu-item"><a href="index.php?pag=conteudo-lista&menu_id=22&codac=8">Depoimentos</a></li>
      <li class="mnu-item"><a href="index.php?pag=banner-lista">Banner</a></li>
      
      
      
      
      
   <!--    <li class="mnu-item"><a href="index.php?pag=galeria-lista&tipo=foto">Galeria de Fotos</a></li>
      <li class="mnu-item"><a href="index.php?pag=galeria-v-lista&tipo=video">Galeria de Vídeos</a></li>
      
      <li class="mnu-item"><a href="index.php?pag=frase-lista">Frases</a></li>
      <li class="mnu-item"><a href="#">Estatísticas</a></li> -->

      <li class="mnu-titulo">SETUP</li>
      <li class="mnu-item"><a href="index.php?pag=usuario-lista">Usuários</a></li>
      <li class="mnu-item"><a href="index.php?pag=menu-tipo-lista">Tipos de Menu</a></li>
      <li class="mnu-item"><a href="index.php?pag=menu-localizacao-lista">Localização de Menu</a></li>
      <li class="mnu-item"><a href="index.php?pag=banner-localizacao-lista">Localização de Banner</a></li> 
      <li class="mnu-item"><a href="index.php?pag=conteudo-localizacao-lista">Localização de Conteúdo</a></li> 

    </ul>
  </div>

  <div class="col-9 col-direita pb-5">



    <!-- menu topo adm -->
    <div> 
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a class="nav-link" href="#">Página Inicial <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?logout=true">Sair</a>
            </li>


          </ul>

        </div>
      </nav>
     </div>  


    <!-- conteudo da area adm -->

    <?php require ('verificador.php');?>



  </div> <!-- fim do div do menu da coluna direita -->  
   
 </div>
  
</div>

  


</body>

<script type="text/javascript">


// esse script é usado no cadastro de menu
/*
  $("#esconder").hide();
  $("#menu_tipo_id").on('change', function(){
      var $this = $(this).val();
      if($this != 0) {
          if($this == '7') {
             $("#esconder").show(); 
          }
          else {
             $("#esconder").hide();
          }
      }
});
*/
// fim script


//para permitir que o bootstrap mostre tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// para permitir modal no bootstrap
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})



//para automatizar o preenchimento da chamada
// usado no cadastro de conteúdo
  $("#gerar_chamada").on('click', function(){
    var cont = CKEDITOR.instances['conteudo'].getData();
    //console.log($(cont).text());

    var str = $(cont).text();
    str = str.replace(/(\r\n|\n|\r)/gm," ");
    str = str.replace(/\s{2,}/g, ' ');
    str = str.substring(0,143);
    pos = str.lastIndexOf(" ");
    str = str.substring(0,pos);
    str = str + " [...]"



    $('#chamada').val(str);

});

  //para automatizar o preenchimento SEO - TITULO
// usado no cadastro de conteúdo
  $("#gerar_titulo").on('click', function(){
    var cont = $("#titulo").val();
    //console.log('cont =' + cont);


    var str = cont;
   // console.log('str =' + str);

   if($('#titulo').val().length < 60) {
      str = str.replace(/(\r\n|\n|\r)/gm," ");
      str = str.replace(/\s{2,}/g, ' ');
   } 
   else {
      str = str.replace(/(\r\n|\n|\r)/gm," ");
      str = str.replace(/\s{2,}/g, ' ');
      str = str.substring(0,55);
      pos = str.lastIndexOf(" ");
      str = str.substring(0,pos);
      str = str + " [...]"
   }

    $('#title').val(str);

});





//mostrar caracteres restantes - onkeyup
function validaCampo(campoOrigem, campoSaida, limite){
  var campo = document.getElementById(campoOrigem);
  var txtDigitado = campo.value.toString();
  var tamanhoAtual = txtDigitado.length;
  var tamanhoRestante = limite - tamanhoAtual;
  //console.log(tamanhoRestante);
  document.getElementById(campoSaida).innerHTML = " " + tamanhoRestante;
  return true;
}
    



//gerar url amigável
function generateURL() {

    var urlAmigavel = "";
    var campo = document.getElementById('titulo');
    var str = campo.value;
    urlAmigavel =  removeAccents(str.toLowerCase().replace("- ", "").replace(/\s/g, "-").replace(",", ""));
    urlAmigavel = urlAmigavel.replace(/^\s+|\s+$/g,"");
    //console.log('urlAmigavel =' + urlAmigavel);
    document.getElementById('uri').value = urlAmigavel;

  }
  
   function removeAccents(strAccents) {
    var strAccents = strAccents.split('');
    var strAccentsOut = new Array();
    var strAccentsLen = strAccents.length;
    var accents = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž!.';
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz  ";
    for (var y = 0; y < strAccentsLen; y++) {
      if (accents.indexOf(strAccents[y]) != -1) {
        strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
      } else
        strAccentsOut[y] = strAccents[y];
    }
    strAccentsOut = strAccentsOut.join('');
    return strAccentsOut;
  }


//usado no cadastro de menu
// se tipo de menu = coluna -> habiiltar combo para dizer se menu irá listar por conteudo_localizacao_id


$("#menu_tipo_id").on('change', function(){
    

    var tipoMenu = $("#menu_tipo_id").val();
    //alert(tipoMenu);
    if (tipoMenu == 2) {
      $('#divMenuEspecial').removeClass('frm-nao-aparece');
    }else {
      $('#divMenuEspecial').addClass('frm-nao-aparece');
    }
});



</script>



<?php  ob_end_flush();?>
</html>