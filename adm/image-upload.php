<!--

<p class="frm_msg" align="center"> Ação = <?=$acao?> </p>
-->

<?
//echo "<pre>";
//var_dump($_FILES['foto_reduzida']);
//echo "</pre>";




$nome_foto = $_FILES[$campo]['name'];
$formato = $_FILES[$campo]['type'];
$tamanho = $_FILES[$campo]['size'];

$moveu = "nao";
$msg_erro="";

if ($nome_foto != "") {

	$nome_foto = str_replace (" ","_",$nome_foto);

	$nome_foto = str_replace ("á","a",$nome_foto);
	$nome_foto = str_replace ("à","a",$nome_foto);
	$nome_foto = str_replace ("â","a",$nome_foto);
	$nome_foto = str_replace ("ã","a",$nome_foto);
	$nome_foto = str_replace ("Á","a",$nome_foto);
	$nome_foto = str_replace ("À","a",$nome_foto);
	$nome_foto = str_replace ("Â","a",$nome_foto);
	$nome_foto = str_replace ("Ã","a",$nome_foto);
	
	$nome_foto = str_replace ("é","e",$nome_foto);
	$nome_foto = str_replace ("è","e",$nome_foto);
	$nome_foto = str_replace ("ê","e",$nome_foto);
	$nome_foto = str_replace ("É","e",$nome_foto);
	$nome_foto = str_replace ("È","e",$nome_foto);
	$nome_foto = str_replace ("Ê","e",$nome_foto);

	$nome_foto = str_replace ("í","i",$nome_foto);
	$nome_foto = str_replace ("ì","i",$nome_foto);
	$nome_foto = str_replace ("î","i",$nome_foto);
	$nome_foto = str_replace ("Í","i",$nome_foto);
	$nome_foto = str_replace ("Ì","i",$nome_foto);
	$nome_foto = str_replace ("Î","i",$nome_foto);
		
	$nome_foto = str_replace ("ó","o",$nome_foto);
	$nome_foto = str_replace ("ò","o",$nome_foto);
	$nome_foto = str_replace ("õ","o",$nome_foto);
	$nome_foto = str_replace ("ô","o",$nome_foto);
	$nome_foto = str_replace ("Ó","o",$nome_foto);
	$nome_foto = str_replace ("Ò","o",$nome_foto);
	$nome_foto = str_replace ("Õ","o",$nome_foto);
	$nome_foto = str_replace ("Ô","o",$nome_foto);

	$nome_foto = str_replace ("ú","o",$nome_foto);
	$nome_foto = str_replace ("ù","o",$nome_foto);
	$nome_foto = str_replace ("û","o",$nome_foto);
	$nome_foto = str_replace ("Ú","o",$nome_foto);
	$nome_foto = str_replace ("Ù","o",$nome_foto);
	$nome_foto = str_replace ("Û","o",$nome_foto);

	$nome_foto = str_replace ("ç","c",$nome_foto);
	$nome_foto = str_replace ("Ç","c",$nome_foto);

	$nome_foto = str_replace ("Ñ","n",$nome_foto);
	$nome_foto = str_replace ("ñ","n",$nome_foto);
	
	$nome_foto = strtolower($nome_foto);
	
	$formatos = array("image/jpg", "image/jpeg" , "image/pjpeg" ,"image/png" , "image/gif");
	
	$testeType = array_search ($formato, $formatos);
	
	if (!$testeType){
		$msg_erro = "Erro ao gravar a imagem: $nome_foto <br><br> Formato da foto invalido";
	}

	if ($tamanho > 5000000){
		$msg_erro = "Erro ao gravar a imagem: $nome_foto <br><br> Excedeu o limite de 5 MB";
	}
	
	
	if ($msg_erro == "") {
		
		//se for uma alteração e tiver alterando tb a foto... apaga a foto antiga
		$nome_foto_antiga = getCampo($tabela, $id, $campo);
		if ($nome_foto_antiga != ""){
			unlink("$dirDestino/_$nome_foto_antiga");
		}
		 
		//se existe um arquivo com o mesmo nome que o que está sendo gravado, então, altera nome que está sendo gravado.
		if (file_exists("$dirDestino/_$nome_foto")){
			$a=1;
			while (file_exists("$dirDestino/[$a]$nome_foto")) {
				$a++;
			}
			$nome_foto = "[".$a."]".$nome_foto;
		}
		
		//faz o upload do arquivo o nome corrigido.
		move_uploaded_file($_FILES[$campo]['tmp_name'], "$dirDestino/".$nome_foto);
		$moveu = "sim";	
		
		$sqlalterafoto = "UPDATE $tabela SET $campo='$nome_foto' WHERE id = $id";
	
		//echo ("<br><br>$sqlalterafoto<br><br>");
		$alteraFotoReduzida = mysql_query($sqlalterafoto);
		//echo mysql_error()	;

	} else {
		echo $msg_erro."<br>";
	}
	
	

	

}

?>


