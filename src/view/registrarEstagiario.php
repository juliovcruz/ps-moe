<?php 
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form action="../controller/estagiario.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Estagiário</h3>
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
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu nome" id="nome" type="text" class="validate" name="nome">
                <label for="nome">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira seu curso" id="curso" type="text" class="validate" name="curso">
                <label for="curso">Curso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu ano de ingresso" id="anoDeIngresso" type="text" class="validate"
                    name="anoDeIngresso">
                <label for="anoDeIngresso">Ano de ingresso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <textarea id="minicurriculo" class="materialize-textarea" name="minicurriculo"></textarea>
                <label for="minicurriculo" type="text" class="validate">Minicurrículo</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
                <button type="submit" class="btn" name="btnRegistro">Criar</button>
                <input type="hidden" name="action" value="cadastrarEstagiario"/>
            </div>
        </div>
    </form>
</div>

<?php 
include_once 'footer.php';
?>