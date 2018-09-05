<?php
/*****************************
GERA RESUMOS
*****************************/

	function lmWord($string, $words = '100'){
		$string 	= strip_tags($string);
		$count		= strlen($string);
		
		if($count <= $words){
			return $string;	
		}else{
			$strpos = strrpos(substr($string,0,$words),' ');
			return substr($string,0,$strpos).'...';
		}
		
	}
	
/*****************************
VALIDA O CPF
*****************************/	

	function valCpf($cpf){
		$cpf = preg_replace('/[^0-9]/','',$cpf);
		$digitoA = 0;
		$digitoB = 0;
		for($i = 0, $x = 10; $i <= 8; $i++, $x--){
			$digitoA += $cpf[$i] * $x;
		}
		for($i = 0, $x = 11; $i <= 9; $i++, $x--){
			if(str_repeat($i, 11) == $cpf){
				return false;
			}
			$digitoB += $cpf[$i] * $x;
		}
		$somaA = (($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
		$somaB = (($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);
		if($somaA != $cpf[9] || $somaB != $cpf[10]){
			return false;	
		}else{
			return true;
		}
	}	

/*****************************
VALIDA O EMAIL
*****************************/	
	
	function valMail($email){
		if(preg_match('/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)){
			return true;
		}else{
			return false;
		}
	}
	
/*****************************
ENVIA O EMAIL
*****************************/	

	function sendMail($assunto,$mensagem,$remetente,$nomeRemetente,$destino,$nomeDestino, $reply = NULL, $replyNome = NULL){
		
		require_once('mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
		
		$mail = new PHPMailer(); //INICIA A CLASSE
		$mail->IsSMTP(); //Habilita envio SMPT
		$mail->SMTPAuth = true; //Ativa email autenticado
		$mail->IsHTML(true);
		
		$mail->Host = MAILHOST; //Servidor de envio
		$mail->Port = MAILPORT; //Porta de envio
		$mail->Username = MAILUSER; //email para smtp autenticado
		$mail->Password = MAILPASS; //seleciona a porta de envio
		
		$mail->From = utf8_decode($remetente); //remtente
		$mail->FromName = utf8_decode($nomeRemetente); //remtetene nome
		
		if($reply != NULL){
			$mail->AddReplyTo(utf8_decode($reply),utf8_decode($replyNome));	
		}
		
		$mail->Subject = utf8_decode($assunto); //assunto
		$mail->Body = utf8_decode($mensagem); //mensagem
		$mail->AddAddress(utf8_decode($destino),utf8_decode($nomeDestino)); //email e nome do destino
		
		if($mail->Send()){
			return true;
		}else{
			return false;
		}
	}	

/*
sendMail('teste de envio', 'Mensagem de teste',MAILUSER, 'Malcon Toledo', 'malcon2525@gmail.com', 'TESTE', 'malcon2525@yahoo.com.br', 'Malcon yahoo');
*/

/*****************************
FORMATA DATA EM TIMESTAMP
*****************************/	

	function formDate($data){
		$timestamp = explode(" ",$data);
		$getData = $timestamp[0];
		$getTime = $timestamp[1];
		
			$setData = explode('/',$getData);
			$dia = $setData[0];
			$mes = $setData[1];
			$ano = $setData[2];
			
		if(!$getTime):
			$getTime = date('H:i:s');
		endif;
			
		$resultado = $ano.'-'.$mes.'-'.$dia.' '.$getTime;
		
		return $resultado;
		
	}
	
/*****************************
MANAGE ESTATÍSCAS
*****************************/

	function viewManager($times = 900){
		$selMes = date('m');
		$selAno = date('Y');
		if(empty($_SESSION['startView']['sessao'])){
			$_SESSION['startView']['sessao'] = session_id();
			$_SESSION['startView']['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['startView']['url'] = $_SERVER['PHP_SELF'];
			$_SESSION['startView']['time_end'] = time() + $times;
			create('views_online',$_SESSION['startView']);
			$readViews = read('views',"WHERE mes = '$selMes' AND ano = '$selAno'");
			
			//echo 'readViews = '.print_r($readViews);

			if(!$readViews){
				$createViews = array('mes' => $selMes, 'ano' => $selAno);	
				create('views',$createViews);
			}else{
				foreach($readViews as $views);
				if(empty($_COOKIE['startView'])){
					$updateViews = array(
						'visitas' => $views['visitas']+1,
						'visitantes' => $views['visitantes']+1
					);
					update('views',$updateViews,"mes = '$selMes' AND ano = '$selAno'");
					setcookie('startView',time(),time()+60*60*24,'/');
				}else{
					$updateVisitas = array('visitas' => $views['visitas']+1);
					update('views',$updateVisitas,"mes = '$selMes' AND ano = '$selAno'");
				}
			}
		}else{
			$readPageViews = read('views',"WHERE mes = '$selMes' AND ano = '$selAno'");
			if($readPageViews){
				foreach($readPageViews as $rpgv);
				$updatePageViews = array('pageviews' => $rpgv['pageviews']+1);
				update('views',$updatePageViews,"mes = '$selMes' AND ano = '$selAno'");
			}
			$id_sessao = $_SESSION['startView']['sessao'];
			if($_SESSION['startView']['time_end'] <= time()){
				delete('views_online',"sessao = '$id_sessao' OR time_end <= time(NOW())");
				unset($_SESSION['startView']);	
			}else{ // atualiza o tempo da sessão
				$_SESSION['startView']['time_end'] = time() + $times;
				$timeEnd = array('time_end' => $_SESSION['startView']['time_end']);	
				update('views_online',$timeEnd,"sessao = '$id_sessao'");
			}	
		}
	}


	function geraEstatisticas($times = 1800){
		$nome_sessao = 'golfinho';
		
		$mesAtual = date('m');
		$anoAtual = date('Y');

		if(empty($_SESSION["$nome_sessao"]['sessao'])){
			criaSessao($nome_sessao, $times);
			gravaVisitanteOnLine($nome_sessao);
			gravaVisita($mesAtual, $anoAtual);
		} else {
			gravaPageView($mesAtual, $anoAtual);

			$tempo_restante = $_SESSION["$nome_sessao"]['time_end'] -time();
			if ($tempo_restante < 0 ) {
				$id_sessao = $_SESSION["$nome_sessao"]['sessao'];
				apagaVisitanteOnLine($id_sessao);
				deletaSessao($nome_sessao);
				criaSessao($nome_sessao, $times);
				gravaVisitanteOnLine($nome_sessao);
				gravaVisita($mesAtual, $anoAtual);
			}
		}
		if(empty($_COOKIE['nome_sessao'])){
			$id_sessao = $_SESSION["$nome_sessao"]['sessao'];
			gravaVisitante($nome_sessao, $id_sessao,$mesAtual, $anoAtual);
		}



	}

	function criaSessao ($nome_sessao, $times) {
			$_SESSION["$nome_sessao"]['sessao'] = session_id();
			$_SESSION["$nome_sessao"]['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION["$nome_sessao"]['url'] = $_SERVER['PHP_SELF'];
			$_SESSION["$nome_sessao"]['time_end'] = time() + $times;
	}
	function deletaSessao($nome_sessao){
		unset($_SESSION["$nome_sessao"]);
	}
	function gravaVisitanteOnLine($nome_sessao) {
		create('views_online',$_SESSION["$nome_sessao"]);
	}
	function apagaVisitanteOnLine($id_sessao) {

		delete('views_online',"sessao = '$id_sessao' OR time_end <= time(NOW())");
	}
	function gravaVisita($mesAtual, $anoAtual){
		//echo "opa filho";
		$readVisitas = read('views',"WHERE mes = $mesAtual AND ano = $anoAtual");

		if(!$readVisitas){
			$createVisitas = array('mes' => $mesAtual, 'ano' => $anoAtual);	
			create('views',$createVisitas);
		} else {
			$read = read('views', "WHERE ano = $anoAtual AND mes = $mesAtual ");
			if ($read){
			  foreach($read as $res){
				   $visitas =  $res['visitas'] +1;
			  }
			}
			//echo 'resultado = '.$visitas;
			$updateViews = array(
						'visitas' => "$visitas"
					);
			update('views',$updateViews,"mes = '$mesAtual' AND ano = '$anoAtual'");
		}
	}
	function gravaPageView($mesAtual, $anoAtual){
		//echo "opa filho";
		$readPageView = read('views',"WHERE mes = $mesAtual AND ano = $anoAtual");

		if(!$readPageView){
			$createVisitas = array('mes' => $mesAtual, 'ano' => $anoAtual);	
			create('views',$createVisitas);
		} else {
			$read = read('views', "WHERE ano = $anoAtual AND mes = $mesAtual ");
			if ($read){
			  foreach($read as $res){
				   $pageviews =  $res['pageviews'] +1;
			  }
			}
			//echo 'resultado = '.$visitas;
			$updateViews = array(
						'pageviews' => "$pageviews"
					);
			update('views',$updateViews,"mes = '$mesAtual' AND ano = '$anoAtual'");
		}
	}

	function gravaVisitante($nome_sessao,$id_sessao,$mesAtual, $anoAtual){

		if(empty($_COOKIE[$nome_sessao])){
			setcookie($nome_sessao,$id_sessao, time()+18000); // 5 horas
			$read = read('views', "WHERE ano = $anoAtual AND mes = $mesAtual ");
			if ($read){
			  foreach($read as $res){
				   $visitantes =  $res['visitantes'] +1;
			  }
			}
			//echo 'resultado = '.$visitas;
			$updateViews = array(
						'visitantes' => "$visitantes"
					);
			update('views',$updateViews,"mes = '$mesAtual' AND ano = '$anoAtual'");

		}



	}






/*****************************
Paginação de resultados
*****************************/

	function readPaginator($tabela, $cond, $maximos, $link, $pag, $width = NULL, $maxlinks = 4){
		$readPaginator = read("$tabela","$cond");
		$total = count($readPaginator);
		if($total > $maximos){
			$paginas = ceil($total/$maximos);
			if($width){
				echo '<div class="paginator" style="width:'.$width.'">';
			}else{
				echo '<div class="paginator">';
			}
			echo '<a href="'.$link.'1">Primeira Página</a>';
			for($i = $pag - $maxlinks; $i <= $pag - 1; $i++){
				if($i >= 1){
					echo '<a href="'.$link.$i.'">'.$i.'</a>&nbsp;&nbsp;&nbsp;';
				}
			}
			echo '<span class="atv">'.$pag.'</span>&nbsp;&nbsp;&nbsp;';
			for($i = $pag + 1; $i <= $pag + $maxlinks; $i++){
				if($i <= $paginas){
					echo '<a href="'.$link.$i.'">'.$i.'</a>&nbsp;&nbsp;&nbsp;';
				}
			}
			echo '<a href="'.$link.$paginas.'">Última Página</a>';
			echo '</div><!-- /paginator -->';
		}
	}

/*****************************
debuga matriz
*****************************/	
	function mostraMatriz($matriz) {
		echo "<pre>";
		print_r($matriz);
		echo "</pre>";
	}

/*****************************
debuga variavel
*****************************/	
	function mostraVar($titulo, $var = null) {
		$var = ( isset($var) ? $var : $titulo);
		echo $titulo.' = '.$var.'<br>';
	}


/*****************************
gera combo HTML
*****************************/	
	/*
	$tabela = nome da tabela
	$campoValue = nome que será dado o <select>
	$campoSaida = campo que será exibido no <option> (na lista)
	$valorCampoGravado = valor que é pego no $_POST (no caso de uma alteração) quer irá selecionar o devido valor no select
	*/
	function combo($tabela, $campoValue, $campoSaida, $valorCampoGravado, $where = null) {

		echo "<select id=\"$campoValue\" name=\"$campoValue\" class=\"form-control\">";
		$conteudoDB = read("$tabela", "$where");
		if ($conteudoDB) {
			foreach ($conteudoDB as $conteudo) {
				if (!empty($valorCampoGravado)){
					if ($conteudo['id'] == $valorCampoGravado ) {
						$selected = "selected";
					} else {
						$selected = "";
					}
				}
				echo "<option $selected value=\"$conteudo[id]\"> $conteudo[$campoSaida] </option>";
			}
		}
		echo "</select>";
	}

?>