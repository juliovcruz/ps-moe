<?php 
include_once 'header.php';
?>

<div class="row" style="padding-right: 200px;">
    <form action="../controller/empregador.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;" id="empregadorForm">
        <div class="row">
            <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Empregador</h3>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira sua senha" id="senha" type="text" class="validate" name="senha">>
                <label for="senha">Senha</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o nome do responsável" id="nomeDoResponsavel" type="text" class="validate" name="nomeDoResponsavel">>
                <label for="nomeDoResponsavel">Nome do Responsável</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira o nome da empresa" id="nomeDaEmpresa" type="text" class="validate" name="nomeDaEmpresa">>
                <label for="nomeDaEmpresa">Nome da Empresa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira a descrição" id="descricao" type="text" class="validate" name="descricao">>
                <label for="descricao">Descricao</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 push-m3">
                <input placeholder="Insira os produtos da empresa" id="produtos" type="text" class="validate" name="produtos">>
                <label for="produtos">Produtos</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 push-m7">
            <button type="submit" class="btn" name="btnRegistro">Criar</button>
                <input type="hidden" name="action" value="cadastrarEmpregador"/>
            </div>
        </div>
    </form>
</div>

<?php 
include_once 'footer.php';
?>