<?php

/*****************************
GET HOME
*****************************/

function getHome(){
	$url  = isset($_GET['url'])     ? $_GET['url']    : '';
	$url 	= explode('/', $url);
	//mostraMatriz($url);
	$url[0] = ($url[0] == NULL ? 'index' : $url[0]);
	
	//mostraMatriz($url);

	//mostravar('url', $url[0]);
	
	$permissao = array (
		'index',
		'ml', //lista conteudo em linha
		'mc', //lista conteudo em coluna
		'ct', //conteudo detalhe
		'pd', //produto detalhe
		'lc', //lançamentos
		'blog', //blog - pagina principal do blog
		'blt', //blog - conteúdo detalhe do blog
		'bll', //blog - lista postagens da categoria do blog
		'galeria',
		'foto-galeria',
		'video-galeria',
		'faca-parte-do-time',
    'semijoias'
	);

	// tudo o que estivar cadastrado no menu tb entra na permissao
	$menuBD = read('menu', "WHERE situacao = 'on' AND uri <> '' ");
	if ($menuBD) {
	  foreach ($menuBD as $menu) { 
	  	array_push($permissao, $menu['uri']);
		}
	}

//mostraMatriz($permissao);

	if (!in_array($url[0],$permissao)	) {
				$url[0]='index';
	}
		return $url;

}


/*****************************
GET THUMB
*****************************/

	function getThumb($img, $titulo, $alt, $w, $h, $grupo = NULL, $dir = NULL, $link = NULL){
		$grupo 	= ($grupo != NULL ? "[$grupo]" : "");
		$dir 	= ($dir != NULL ? "$dir" : "midias");
		$verDir = explode('/',$_SERVER['PHP_SELF']);
		$urlDir = (in_array('admin',$verDir) ? '../' : '');
		
		if(file_exists($urlDir.$dir.'/'.$img)){
			if($link == ''){
				echo '
					<a href="'.BASE.'/'.$dir.'/'.$img.'" rel="shadowbox'.$grupo.'" title="'.$titulo.'">
						<img src="'.BASE.'/tim.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=1&q=100" 
						title="'.$titulo.'" alt="'.$alt.'">
					</a>
				';
			}elseif($link == '#'){
				echo '
						<img src="'.BASE.'/tim.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=1&q=100" 
						title="'.$titulo.'" alt="'.$alt.'">
				';
			}else{
				echo '
					<a href="'.$link.'" title="'.$titulo.'">
						<img src="'.BASE.'/tim.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=1&q=100" 
						title="'.$titulo.'" alt="'.$alt.'">
					</a>
				';
			}
		}else{
			echo '
				<img src="'.BASE.'/tim.php?src='.BASE.'/images/default.jpg&w='.$w.'&h='.$h.'&zc=1&q=100" 
				title="'.$titulo.'" alt="'.$alt.'">
				';
		}
	}
	
/*****************************
GET CAT
*****************************/	
	
	function getCampo($tabela, $id, $campo, $debuga = null){
		$id	   = mysql_real_escape_string($id);
		//$readTabela = read("$tabela","WHERE id = '$id'");	

		$sql = "$tabela WHERE id = $id";
		$readTabela = read("$tabela","$sql");
		if ($debuga) {
			echo "<br> sql = $sql <br>";
		}
		if($readTabela){
			if($campo){
				foreach($readTabela as $tab){
					if ($debuga) {
						mostraMatriz($tab);
						echo "resultado => $campo = $tab[$campo]<br>";
					}	
					return $tab[$campo];

				}
			}else{
				return $readTabela;
			}
		}else{
			return 'Erro ao ler tabela ';	
		}
	}
	
/*****************************
GET ID TIPO DE MENU
*****************************/	
	
	function getTipoMenuFoto(){

		// pega o id do tipo de menu que seja galeria de foto
    $sql = "SELECT id FROM menu_tipo WHERE descricao like '%FOTO%'";
    $exec = mysql_query($sql);
    $menu_tipo_id = mysql_fetch_assoc($exec);
    return $menu_tipo_id['id'];
  }


/*****************************
GET AUTOR
*****************************/	

	function getAutor($autorId, $campo = NULL){
		$autorId = mysql_real_escape_string($autorId);
		$readAutor = read('up_users',"WHERE id = '$autorId'");		
		if($readAutor){
			foreach($readAutor as $autor);
			
			if(!$autor['foto']):			
				$gravatar  = 'http://www.gravatar.com/avatar/';
				$gravatar .= md5(strtolower(trim($autor['email'])));
				$gravatar .= '?d=mm&s=180';
				$autor['foto'] = $gravatar;
			endif;

			if(!$campo){
				return $autor;	
			}else{
				return $autor[$campo];
			}
			
		}else{
			echo 'Erro ao ler autor';
		}
	}	
?>