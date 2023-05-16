<?php

include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
require_once "marca.class.php";

$acao = "";
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET': $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
    case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
}

if ($acao == 'salvar'){
    if ($_POST['codigo'] == 0)
        salvar();
    else
        editar();
}elseif ($acao == 'excluir'){
    excluir($_GET['codigo']);
}

function salvar(){
    $pdo = Conexao::getInstance();
    $marca = buildMarca();
    $stmt = $pdo->prepare('INSERT INTO marca (descricao) VALUES(:descricao)');
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $descricao = $marca->getDescricao();
    $stmt->execute();
    header("location:index.php");
}

function excluir($codigo){
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('DELETE FROM marca WHERE codigo = :codigo');
    $stmt->bindParam('codigo', $codigo, PDO::PARAM_INT);
    $stmt->execute();
    header("location:index.php");
}

function editar(){
    $pdo = Conexao::getInstance();
    $marca = buildMarca();
    $stmt = $pdo->prepare('UPDATE marca SET descricao = :descricao WHERE codigo = :codigo');
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $descricao = $marca->getDescricao();
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $codigo = $marca->getCodigo();
    $stmt->execute();
    header("location:index.php");
}

function buscar($codigo){
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('SELECT * FROM marca WHERE codigo = :codigo');
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $consulta = $stmt->execute();
    $marca = new Marca(0,"");
    foreach ($stmt->fetchAll() as $linha) 
        $marca = new Marca($linha['codigo'],$linha['descricao']);
    return $marca;
}

function buildMarca(){
    $marca = new Marca($_POST['codigo'],$_POST['descricao']);
    return $marca;
}

?>