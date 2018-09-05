<?php
	require('iniSis.php');

	@$conn = mysql_connect(HOST, USER, PASS) or die ('Erro ao conectar: '.mysql_error());
	@$dbsa = mysql_select_db(DBSA) or die ('Erro ao selecionar banco: '.mysql_error());

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
	
/*****************************
FUNÇÃO DE CADASTRO NO BANCO 
*****************************/

	function create($tabela, array $datas){
		$fields = implode(", ",array_keys($datas));
		$values = "'".implode("', '",array_values($datas))."'";			
		$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
		$stCreate = mysql_query($qrCreate) or die ('Erro ao cadastrar em '.$tabela.' '.mysql_error().'<br>'.$qrCreate);
		
		if($stCreate){
			return mysql_insert_id();
		}
	}

/*
$datas = array(
  "titulo" => "Hoje é dia D",
  "chamada" => "o grande dia chamda",
  "ordem" => 4
);
create ('conteudo', $datas);

*/




	
/*****************************
FUNÇÃO DE LER NO BANCO
*****************************/

function read($tabela, $cond = NULL){	
	$resultado = false;	
	$qrRead = "SELECT * FROM {$tabela} {$cond}";
	//echo $qrRead;

	$stRead = mysql_query($qrRead) or die ('Erro ao ler em '.$tabela.' '.mysql_error().'<br>'.$qrRead);

	$cField = mysql_num_fields($stRead); // conta num de campos da tab.
	for($y = 0; $y < $cField; $y++){
		$names[$y] = mysql_field_name($stRead,$y);
	}

	for($x = 0; $res = mysql_fetch_assoc($stRead); $x++){ //varre linhas
		for($i = 0; $i < $cField; $i++){ // varre colunas
			$resultado[$x][$names[$i]] = $res[$names[$i]];
		}
	}

	/*if (empty($resultado)) {
		for($i = 0; $i < $cField; $i++){ // varre colunas
			$resultado[0][$names[$i]] = 'tabela vazia';
		}
	}
	*/




	return $resultado;
}

/*
$read = read('conteudo');
if ($read){
  foreach($read as $res){
   echo $res['titulo'].'<br>';
  }

}/*









	
/*****************************
FUNÇÃO DE EDIÇÃO NO BANCO
*****************************/	
	
function update($tabela, array $datas, $where){
	foreach($datas as $fields => $values){
		$campos[] = "$fields = '$values'";
	}
	
	$campos = implode(", ",$campos);
	$qrUpdate = "UPDATE {$tabela} SET $campos WHERE {$where}";
	$stUpdate = mysql_query($qrUpdate) or die ('Erro ao atualizar em '.$tabela.' '.mysql_error().'<br>'.$qrUpdate);

	if($stUpdate){
		return true;	
	}
	
}

/*
$up = array(
	"titulo" => "novo titulo do conteudo",
	"ordem" => 3
	);
update('conteudo', $up, "id=3");
*/




	
/*****************************
FUNÇÃO DE DELETAR NO BANCO
*****************************/

function delete($tabela, $where){
	$qrDelete = "DELETE FROM {$tabela} WHERE {$where}";
	$stDelete = mysql_query($qrDelete) or die ('Erro ao deletar em '.$tabela.' '.mysql_error().'<br>'.$qrDelete);
}

?>