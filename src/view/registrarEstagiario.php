<?php 
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form action="" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Estagiário</h3>
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
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu nome" id="nome" type="text" class="validate">
                <label for="nome">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira seu curso" id="curso" type="text" class="validate">
                <label for="curso">Curso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu ano de ingresso" id="anoDeIngresso" type="text" class="validate">
                <label for="anoDeIngresso">Ano de ingresso</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
            <textarea id="minicurriculo" class="materialize-textarea"></textarea>
          <label for="minicurriculo" type="text" class="validate">Minicurrículo</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
                <a href="" class="btn">Registro</a>
            </div>
        </div>
    </form>
</div>

<?php 
include_once 'footer.php';
?>