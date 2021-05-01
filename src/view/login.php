<?php 
session_start();
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form action="../controller/usuario.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Login</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira sua senha" id="senha" type="password" class="validate" name="senha">
                <label for="senha">Senha</label>
            </div>
        </div>
        <div class="row">
            <div class="row col s12 m12 push-m7">
                <button type="submit" class="btn" name="btnLogin">Login</button>
                <input type="hidden" name="action" value="logarUsuario"/>
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