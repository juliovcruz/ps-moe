<?php 
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Empregador</h3>
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
                <input placeholder="Insira o nome do respnsavel" id="nomeDoResponsavel" type="text" class="validate">
                <label for="nomeDoResponsavel">Nome do Responsável</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o nome da empresa" id="nomeDaEmpresa" type="text" class="validate">
                <label for="nomeDaEmpresa">Nome da Empresa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
            <textarea id="descricao" class="materialize-textarea"></textarea>
          <label for="descricao" type="text" class="validate">Descrição</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
            <textarea id="produtos" class="materialize-textarea"></textarea>
          <label for="produtos" type="text" class="validate">Produtos</label>
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