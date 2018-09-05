<?php 

$pag		= isset($_GET['pag'])		? $_GET['pag']			: '';

switch ($pag) {
	case 'menu-lista':
		$recurso = "Gerenciamento de Conteúdo";
		$acao = 'Lista de Menus do Site';
		require('menu-lista.php');
		break;
	case 'menu-tipo-lista':
		$recurso = "Setup";
		$acao = 'Lista de Tipos de Menus';
		require('menu-tipo-lista.php');
		break;
	case 'menu-tipo-cad':
		$recurso = "Setup";
		$acao = 'Cadastro de Tipos de Menus';
		require('menu-tipo-cad.php');
		break;
	case 'menu-localizacao-lista':
		$recurso = "Setup";
		$acao = 'Lista de Localizações de Menu';
		require('menu-localizacao-lista.php');
		break;
	case 'menu-localizacao-cad':
		$recurso = "Setup";
		$acao = 'Cadastro de Localizações de Menu';
		require('menu-localizacao-cad.php');
		break;

	case 'usuario-lista':
		$recurso = "Setup";
		$acao = 'Lista de Usuários';
		require('usuario-lista.php');
		break;
	case 'usuario-cad':
		$recurso = "Setup";
		$acao = 'Cadastro de Usuários';
		require('usuario-cad.php');
		break;

	case 'conteudo-localizacao-lista':
		$recurso = "Setup";
		$acao = 'Lista de Localizações de Conteúdo';
		require('conteudo-localizacao-lista.php');
		break;
	case 'conteudo-localizacao-cad':
		$recurso = "Setup";
		$acao = 'Cadastro de Localização de Conteúdo';
		require('conteudo-localizacao-cad.php');
		break;


	case 'menu-lista':
		$recurso = "Gerenciamento de Menu";
		$acao = 'Lista de Menu';
		require('menu-lista.php');
		break;
	case 'menu-cad':
		$recurso = "Gerenciamento de Menu";
		$acao = 'Cadastro de Menu';
		require('menu-cad.php');
		break;


	case 'conteudo-lista':
		$recurso = "Gerenciamento de Conteúdo";
		$acao = 'Lista de Conteúdo';
		require('conteudo-lista.php');
		break;
	case 'conteudo-cad':
		$recurso = "Gerenciamento de Conteúdo";
		$acao = 'Cadastro de Conteúdo';
		require('conteudo-cad.php');
		break;


	case 'galeria-lista':
		$recurso = "Galeria de Fotos";
		$acao = 'Lista de Galerias de Fotos ';
		require('galeria-f-lista.php');
		break;
	case 'galeria-cad':
		$recurso = "Galeria de Fotos";
		$acao = 'Cadastro de Galerias de Fotos ';
		require('galeria-f-cad.php');
		break;
	case 'galeria-foto-cad':
		$recurso = "Galeria de Fotos";
		$acao = 'Cadastro de Fotos ';
		require('galeria-foto-cad.php');
		break;	



	case 'galeria-v-lista':
		$recurso = "Galeria de Vídeos";
		$acao = 'Lista de Galerias de Vídeos ';
		require('galeria-v-lista.php');
		break;
	case 'galeria-v-cad':
		$recurso = "Galeria de Vídeos";
		$acao = 'Cadastro de Galerias de Vídeos ';
		require('galeria-v-cad.php');
		break;
	case 'galeria-video-cad':
		$recurso = "Galeria de Vídeos";
		$acao = 'Cadastro de Vídeos ';
		require('galeria-video-cad.php');
		break;	


case 'banner-localizacao-lista':
		$recurso = "Localização de Banner";
		$acao = 'Lista de Localizações de Banner ';
		require('banner-localizacao-lista.php');
		break;
case 'banner-localizacao-cad':
		$recurso = "Localização de Banner";
		$acao = 'Cadastro de Localizações de Banner ';
		require('banner-localizacao-cad.php');
		break;

case 'banner-lista':
		$recurso = "Gerenciamento de Banner";
		$acao = 'Lista de Áreas Disponíveis para Banner ';
		require('banner-lista.php');
		break;
case 'banner-cad':
		$recurso = "Gerenciamento de Banner";
		$acao = 'Cadastro de Banner ';
		require('banner-cad.php');
		break;

case 'frase-lista':
		$recurso = "Gerenciamento de Frases";
		$acao = 'Lista de Frases ';
		require('frase-lista.php');
		break;
case 'frase-cad':
		$recurso = "Gerenciamento de Frase";
		$acao = 'Cadastro de Frases ';
		require('frase-cad.php');
		break;


	default:
		
		break;
}

?>