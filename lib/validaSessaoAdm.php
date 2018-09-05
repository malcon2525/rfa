<?

$logout     = isset($_GET['logout'])   ? $_GET['logout']    : '';

if($logout == "true" || (!isset($_SESSION['secao_usuario'] ))) {
	session_destroy();
	header("Location: login.php");
}



?>