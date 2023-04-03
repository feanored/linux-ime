<?php
session_start();

function getPost($id){
	if(isset($_POST[$id]) && $_POST[$id] != "")
		return $_POST[$id];
	elseif(isset($_GET[$id]) && $_GET[$id] != "")
		return $_GET[$id];
	return "";
}

function getSession($id){
	return isset($_SESSION[$id]) ? $_SESSION[$id] : "";
}

function setSession($id, $value){
	$_SESSION[$id] = $value;
}

function resetCsv($file){
    $criou = !is_file($file.".csv");
    $csv_out = fopen($file.".csv", "w");
    if($criou) //UTF-8
        fwrite($csv_out, pack("CCC", 0xef, 0xbb, 0xbf));
    fwrite($csv_out, "");
    fclose($csv_out);
}

function saveCsv($file, $saida){
	$criou = !is_file($file.".csv");
	// abrindo arquivo para escrita adicional
	$csv_out = fopen($file.".csv", "a");
	if($criou) //UTF-8
		fwrite($csv_out, pack("CCC", 0xef, 0xbb, 0xbf));
	fwrite($csv_out, $saida);
	fclose($csv_out);
}

function getCsv($file){
	$csv_in = fopen($file.".csv", "r");
	$dados = array();
	while(($linha = fgetcsv($csv_in, 0, ";")) !== false){
		$dados[] = $linha;
	}
	return $dados;
}

function getCsvLine($file, $lin){
	$csv_in = fopen($file.".csv", "r");
	while(($linha = fgetcsv($csv_in, 0, ";")) !== false){
		if($linha[0] == $lin)
			return true;
	}
	return false;
}

?>