<?php
include_once("functions.php");

$file = getPost("file");
$math = str_replace("\n","$$#n#$$",getPost("math"));
$show = str_replace("\n","$$#n#$$",getPost("show"));
$texto = str_replace("\n", "#n#", getPost("texto"));

$exibir = true;
if($math == "")
	$exibir = false;

if(getPost("salvar") == "1" && $show != "") {
	$exibir = false;
	$exists = getCsvLine($file, $math);
	if(!$exists) {
		$linha = $math.";".$texto."\n";
		saveCsv($file, $linha);
	}
	else{
		$_SESSION["msg_".$file] = "Esta equação já está salva!";
	}
}

$_SESSION["exibir_".$file] = $exibir;
$_SESSION["texto_".$file] = $texto;
$_SESSION["show_".$file] = $show;

header("Location:../$file.php");
?>
