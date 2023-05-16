<!DOCTYPE html>
<html lang="pt-BR">
<?php
    include_once "acaoMarca.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $marca = new Marca(0,"");
    if ($acao == "editar"){
        $marca = buscar($_GET['codigo']);
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marca</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <form action="acaoMarca.php" method="post">
        <fieldset>
            <legend>Cadastro de Marca</legend>
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" 
            value="<?php if ($acao == "editar") 
                            echo $marca->getCodigo(); 
                         else 
                            echo 0;?>" readonly><br>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" required 
            value="<?php if ($acao == "editar") 
                            echo $marca->getDescricao(); 
                         else 
                            echo "";?>"><br>
            <button type="submit" name="acao" value="salvar">Salvar</button>
        </fieldset>
    </form>
</body>
</html>