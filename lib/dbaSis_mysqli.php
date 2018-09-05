<?php
	require('iniSis.php');

	//$conn = mysql_connect(HOST, USER, PASS) or die ('Erro ao conectar: '.mysql_error());

	$conn = mysqli_connect(HOST, USER, PASS, DBSA);


	//$dbsa = mysql_select_db(DBSA) or die ('Erro ao selecionar banco: '.mysql_error());

mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET character_set_connection=utf8');
mysqli_query($conn, 'SET character_set_client=utf8');
mysqli_query($conn, 'SET character_set_results=utf8');

mysqli_set_charset($conn, "utf8");
	
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

	$conn = mysqli_connect(HOST, USER, PASS, DBSA);
	$resultado = false;	
	$qrRead = "SELECT * FROM {$tabela} {$cond}";
	//echo $qrRead;

	$stRead = mysqli_query($conn, $qrRead) or die ('Erro ao ler em '.$tabela.' '.mysql_error().'<br>'.$qrRead);

	

	//armazena o nome das colunas da tabela na variável $colunas
	$colunas = array();
	$selectColunas = mysqli_query(
	    $conn,
	    "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DBSA."' AND TABLE_NAME = '".$tabela."';"
	); 
	while($coluna = mysqli_fetch_assoc($selectColunas)){
	    array_push($colunas, $coluna['COLUMN_NAME']) ;
	}
	//mostraMatriz($colunas);
	$cField = count ($colunas); // número de colunas
  //mostraVar($cField);


	// $cField = mysql_num_fields($stRead); // conta num de campos da tab.
	// for($y = 0; $y < $cField; $y++){
	// 	$names[$y] = mysql_field_name($stRead,$y);
	// }

	for($x = 0; $res = mysqli_fetch_assoc($stRead); $x++){ //varre linhas
		for($i = 0; $i < $cField; $i++){ // varre colunas
			$resultado[$x][$colunas[$i]] = $res[$colunas[$i]];
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