<?php
session_start();

if( !isset($_SESSION['logado']) ){
    header('Location: login.php');
}

include_once 'header.php';
require_once ('../models/empregador.php');
$empregador = unserialize($_SESSION['empregador']);

?>

    <html>

    <body>
    <form action="logout.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h1 class="light col s6 push-m3"> Olá, <?php echo $empregador->nomeDoResponsavel ?> ! Bem vindo à tela de vagas </h1>
        </div>
        <div class="row">
            <div class="col s6 push-m3">
                <button type="submit" class='btn'>Logout</button>
            </div>
            <div class="row col s12 push-m3">
                <a href="editarEmpregador.php" class="">Editar Cadastro</a>
            </div>
        </div>
    </body>

    </html>

<?php
include_once 'footer.php';
?>