<?php 
include_once 'view/header.php';
?>

<?php
include_once './controller/utils.php';
include_once './controller/empregador.php';
include_once './models/empregador.php';
include_once './controller/estagiario.php';
include_once './models/estagiario.php';

$empregador = new Empregador("em_6090a786c06c7", "atualizado@email.com", "novasenha", "atualizadoResponsavel", "atualizadoDoResponsavel", "atualizadoDescricao", "atualizadoProdutos");
updateOneEmpregador($empregador);
?>



<?php 
include_once 'view/footer.php';
?>