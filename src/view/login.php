<?php 
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form class="col s12 m6 push-m4" style="margin-top: 200px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Login</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu email" id="email" type="text" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira sua senha" id="senha" type="text" class="validate">
                <label for="senha">Senha</label>
            </div>
        </div>
        <div class="row">
            <div class="row col s12 m12 push-m7">
                <a href="" class="btn">Login</a>
            </div>
            <div class="row col s12 push-m3">
                <a href="registrarEstagiario.php" class="">Registrar Estagiário</a>
                <span class=""> | </span>
                <a href="registrarEmpregador.php" class="">Registrar Empregador</a>
            </div>
        </div>
    </form>
</div>

<?php 
include_once 'footer.php';
?>