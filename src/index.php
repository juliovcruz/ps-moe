<?php 
include_once 'view/header.php';
?>

<?php
include_once './controller/utils.php';
include_once './controller/empregador.php';
include_once './models/empregador.php';
include_once './controller/estagiario.php';
include_once './models/estagiario.php';

//$empregador = new Empregador("id2", "julio@empregador.com", "senhaa", "nomeDoResponsavel", "nomeDaEmpresa", "descricao", "produtos", "usuarioID");

//cadastrarEmpregador($empregador);

$estagiario = New Estagiario("id1","julio@estagiario.com", "senhaa", "nomeDaPessoa", "Curso", 2019, "miniCUrriculo", "usuarioID");

cadastrarEstagiario($estagiario);

//getAllVagas($conn, 0, 100);

?>

<?php 
include_once 'view/footer.php';
?>