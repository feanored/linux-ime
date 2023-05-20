<?php
$_sufix = getSession("sufix");
$_title = getSession("title");

$exibir = getSession("exibir_".$_sufix);
$show = getSession("show_".$_sufix);

$dados = array();
if (!$exibir) {
    // recuperando equações salvas no csv
    $dados = getCsv("math/".$_sufix);
} else {
    $info = getSession("texto_".$_sufix);
    $dados[] = array('$$'.$show.'$$', $info);
}

$msg = getSession("msg_".$_sufix);
setSession("msg_".$_sufix, "");

include_once("math/math.head.html");
?>
<body id="body">
    <div id="page">
        <h2><?php echo $_title; ?></h2>
        <div id="saida" class="area_texto" style="grid-template-rows: repeat(<?php echo ceil(count($dados)/4); ?>, auto);">
            <?php
            for($i=0; $i < count($dados); $i++) {
                echo('<div>');
                // texto
                if($dados[$i][1] != "")
                    echo('<center>'.str_replace("#n#", "<br/>", $dados[$i][1])."</center>\n");
                // equacao
                echo('<center>'.str_replace("#n#", "\n", $dados[$i][0]).'</center>');
                // delete
                if(!$exibir) {
                    echo("<center><a href='javascript:void;' data-id='".md5($dados[$i][0]).
                        "' class='del'>[excluir]</a></center>");
                }
                echo("<br /><br />");
                echo('</div>');
            }
            ?>
        </div>
        <form method="POST" id="submit" action="math/math.save.php">
        <div id="formulario">
            <div>
            <label>Equação: </label>
            <textarea id="texto" name="show" class="area_texto" rows="5"><?php echo str_replace("$$#n#$$", "\n", $show) ?></textarea>
            </div>
            <div>
            <label>Texto descritivo opcional: </label>
            <textarea name="texto" class="area_texto" rows="5"><?php echo str_replace("#n#", "\n", getSession("texto_".$_sufix)); ?></textarea>
            </div>
        </div>
        <div class="acoes">
            <div class="acao"><a class="btn" href="#" onclick="converter();">EXIBIR</a></div>
            <div class="acao right"><a class="btn" href="#" onclick="salvar();">SALVAR</a></div>
            <?php if($msg != "") {
                echo("<div class='msg'>$msg</div>");
            } ?>
        </div>
        <input type="hidden" name="math" id="math" />
        <input type="hidden" name="salvar" id="salvar" />
        <input type="hidden" name="file" id="file" value="<?php echo($_sufix); ?>" />
        </form>
    </div>
</body>
