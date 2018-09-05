<?php 
ob_start(); 
session_start();
require('../lib/dbaSis.php');
require('../lib/outSis.php');
?>
<!DOCTYPE html>

<html lang="pt">

<head>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="robots" content="NOINDEX,NOFOLLOW" />

  <title>Manager On Click &reg;</title>

  <link rel="stylesheet" href="../css_matrix/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">



  <link rel="shortcut icon" href="favicon.ico">

  <script src="../js_matrix/jquery.js"></script>
  <script src="../js_matrix/popper.min.js"></script>
  <script src="../js_matrix/bootstrap.js"></script>
</head>

<body>
  
<?php 
$us_email     = isset($_POST['us_email'])   ? $_POST['us_email']    : '';
$us_senha     = isset($_POST['us_senha'])   ? $_POST['us_senha']    : '';
$branco       = isset($_POST['branco'])     ? $_POST['branco']      : '';
$valido       = isset($_POST['valido'])		  ? $_POST['valido']      : '';

$remember     = isset($_GET['remember'])     ? $_GET['remember']    : '';

//echo "login=$us_login";
//echo "senha=$us_senha";

?>


<?php 



if (isset($_POST['enviar'])  && $branco == "" && $valido == "ok") {
  
  $f['email']     = mysql_real_escape_string($us_email);
  $f['senha']     = mysql_real_escape_string($us_senha);
  $f['remember']  = mysql_real_escape_string($remember);
  $f['branco']    = mysql_real_escape_string($branco);
  $f['valido']    = mysql_real_escape_string($valido);

  $emailParaConsulta = $f['email'];
  $usuarioBD = read('usuario',"WHERE email = '$emailParaConsulta'");

  if ($usuarioBD) {
    $senhaParaConsulta = md5($f['senha']);
    foreach ($usuarioBD as $usuario) {
      if ($usuario['senha'] == $senhaParaConsulta) {
        
        //EFETUAR O LOGIN
        $_SESSION['secao_usuario'] = $usuario;
        $_SESSION['id_usuario'] = $usuario['id'];
        //echo $_SERVER['PHP_SELF'];
        header("Location: ".BASE.'/adm/');


      } else {
        $erro = "Usuário ou senha incorretos";
      }
    }
  } else {
    $erro = "Usuário ou senha incorretos";
  }


 

  

}
?>

  <div class="card text-center container mt-5" style="width: 20rem;">
    <div class="card-body">
      <div><img src="images/login-cadeado.png" alt=""></div>
      
      <?php 
      if (!$remember) {
      ?>
      
      <h4 class="card-title">Informe seu e-mail e senha</h4>
      
      
      <?php if (isset($erro)): ?>
         <?php echo "<p class=\"alert alert-danger\">$erro</p>";?>
      <?php endif ?>
      <form action="" method="post" name="logind">
        <div class="form-group text-left">
          <label for="us_email">Email</label>
          <input type="email" class="form-control" id="us_email" name="us_email"aria-describedby="emailHelp" placeholder="Digite seu e-mail">

        </div>
        <div class="form-group text-left">
          <label for="us_senha">Senha</label>
          <input type="password" class="form-control" id="us_senha" name="us_senha" placeholder="Senha">
        </div>
        <button type="submit" id="enviar" name="enviar" class="btn btn-primary">Enviar</button>
        
        <input type="hidden" name="branco" value="">
        <input type="hidden" name="valido" value="ok">

        <small id="emailHelp" class="form-text text-muted"><a href="login.php?remember=true">Esqueci minha senha</a></small>
      </form>

      <?php } else { ?>
      
      <p class=" alert alert-info ">Informe seu e-mail para que possamos enviar seus dados de acesso</p>

      
      <form action="" method="post" name="logind">
        <div class="form-group text-left">
          <label for="us_email">Email</label>
          <input type="email" class="form-control" id="us_email" aria-describedby="emailHelp" placeholder="Digite seu e-mail">

        </div>

        <input type="hidden" name="branco" value="">
        <input type="hidden" name="valido" value="ok">
        <button type="submit" id="enviar" name="enviar" class="btn btn-primary">Enviar</button>
        <small id="emailHelp" class="form-text text-muted"><a href="login.php">Voltar</a></small>
      </form>
      
      <?php } ?>

    </div>
  </div>

</body>
<?php  ob_end_flush();?>
</html>
