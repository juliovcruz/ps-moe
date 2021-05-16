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

    <?php if (session()->get('erroEmail')): ?>
    <div class="card-panel red lighten-2" id="erro">
        <?= session()->get('erroEmail') ?>
    </div>
    <?php endif; ?>

    <div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Registro feito com sucesso!
    </div>

    <div class="row" style="padding-right: 200px;">
        <form action="/Estagiario/registrar" method="post" class="col s12 m6 push-m4" style="margin-top: 50px;">
            <div class="row">
                <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Registrar Estagiário</h3>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email" data-length="50"
                        value="<?= set_value('email') ?>">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira sua senha" id="senha" type="password" class="validate" name="senha"
                        value="">
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
                    <input placeholder="Insira o seu nome" id="nome" type="text" class="validate" name="nome" data-length="50"
                        value="<?= set_value('nome') ?>">
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu ano de ingresso" id="anoDeIngresso" type="text" class="validate" data-length="4"
                        name="anoDeIngresso" value="<?= set_value('anoDeIngresso') ?>">
                    <label for="anoDeIngresso">Ano de ingresso</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="minicurriculo" class="materialize-textarea" name="minicurriculo" data-length="250"
                        value="<?= set_value('minicurriculo') ?>"></textarea>
                    <label for="minicurriculo" type="text" class="validate">Minicurrículo</label>
                </div>
            </div>
            <div class="row">
                <select class="input-field col s6 push-m3 browser-default"  id="curso" type="text" class="validate" name="curso">
                    <option value="">Escolha seu curso</option>
                    <option value="Engenharia de Computacao">Engenharia de Computação</option>
                    <option value="Engenharia de Software">Engenharia de Software</option>
                    <option value="Ciencias da Computacao">Ciências da Computação</option>
                    <option value="Sistemas de Informacao">Sistemas de Informação</option>
                    <option value="Inteligencia Artificial">Inteligência Artificial</option>
                </select>
            </div>
            <div class="row">
                <div class="col s6 push-m5">
                    <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">Criar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>