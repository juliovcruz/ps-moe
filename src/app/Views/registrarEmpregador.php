<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

<?php if (isset($validation)): ?>
    <div class="card-panel red lighten-2" id="erro" style="">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

    <div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Registro feito com sucesso!</div>

    <div class="card-panel red lighten-2" id="erro" style="display:none;"></div>

    <div class="row" style="padding-right: 200px;">
        <form action="/Empregador/register" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
            <div class="row">
                <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Empregador</h3>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email"
                           value="<?= set_value('email') ?>">
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
                    <input placeholder="Insira novamente sua senha" id="confirmacaoSenha" type="password"
                           class="validate" name="confirmacaoSenha" value="">
                    <label for="confirmacaoSenha">Confirmação Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o nome do responsável" id="nomeDoResponsavel" type="text" class="validate" name="nomeDoResponsavel"
                           value="<?= set_value('nomeDoResponsavel') ?>">
                    <label for="nomeDoResponsavel">Nome do Responsável</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o nome da empresa" id="nomeDaEmpresa" type="text" class="validate" name="nomeDaEmpresa"
                           value="<?= set_value('nomeDaEmpresa') ?>">
                    <label for="nomeDaEmpresa">Nome da Empresa</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="descricao" class="materialize-textarea" name="descricao" value="<?= set_value('descricao') ?>"></textarea>
                    <label for="descricao" type="text" class="validate">Descrição</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="produtos" class="materialize-textarea" name="produtos" value="<?= set_value('produtos') ?>">></textarea>
                    <label for="produtos" type="text" class="validate">Produtos</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 push-m7">
                    <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Criar</button>
                    <input type="hidden" name="action" value="cadastrarEmpregador"/>
                </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>