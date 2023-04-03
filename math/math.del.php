<?php
include_once("functions.php");

$file = getPost("file");
$id = getPost("id");

$dados = getCsv($file);

// reseta o csv atual
resetCsv($file);

// salva as outras linhas
for($i=0; $i < count($dados); $i++){
    if(md5($dados[$i][0]) != $id){
        $linha = $dados[$i][0].";".$dados[$i][1]."\n";
        saveCsv($file, $linha);
    }
}

header("Location:../$file.php");
?>
