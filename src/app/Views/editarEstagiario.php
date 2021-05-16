<!DOCTYPE html>
<html>

<?php
if(!session()->get('estagiario')) return redirect()->to('Login');

$estagiario = session()->get('estagiario');
?>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

<nav>
    <div class='nav-wrapper grey darken-3'>
        <a href='#!' class='brand-logo center'>MOE</a>
        <ul class='right hide-on-med-and-down'>
            <li><a href='/estagiario/dash'><i class='material-icons'>home</i></a></li>
            <li><a href='/estagiario/editar'><i class='material-icons'>person</i></a></li>
            <li><a href='/login/logout'><i class='material-icons'>exit_to_app</i></a></li>
        </ul>
    </div>
</nav>

    <?php if (isset($validation)): ?>
    <div class="card-panel red lighten-2" id="erro" style="">
        <?= $validation->listErrors() ?>
    </div>
    <?php endif; ?>

    <?php if (session()->get('erro')): ?>
    <div class="card-panel red lighten-2" id="erro">
        <?= session()->get('erro') ?>
    </div>
    <?php endif; ?>

    <div class="card-panel teal lighten-2 white-text" id="sucesso" style="display:none;">Alteração realizada com sucesso!
    </div>

    <div class="row" style="padding-right: 200px;">
        <form action="/Estagiario/editar" method="post" class="col s12 m6 push-m4" style="margin-top: 50px;">
            <div class="row">
                <h3 class="light col s6 push-m3" style="margin-bottom: 50px">Alterar Cadastro</h3>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu email" id="email" type="text" class="validate" name="email"
                        value="<?php echo $estagiario->email ?>">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira sua nova senha" id="senha" type="password" class="validate" name="senha"
                        value="">
                    <label for="senha">Nova Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira novamente sua nova senha" id="confirmacaoSenha" type="password"
                        class="validate" name="confirmacaoSenha" value="">
                    <label for="confirmacaoSenha">Confirmação da Nova Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu nome" id="nome" type="text" class="validate" name="nome"
                           value="<?php echo $estagiario->nome ?>">
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira o seu ano de ingresso" id="anoDeIngresso" type="text" class="validate"
                        name="anoDeIngresso" value="<?php echo $estagiario->anoDeIngresso ?>">
                    <label for="anoDeIngresso">Ano de ingresso</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <textarea id="minicurriculo" class="materialize-textarea" name="minicurriculo"
                              value="<?php echo $estagiario->miniCurriculo ?>"><?php echo $estagiario->miniCurriculo ?></textarea>
                    <label for="minicurriculo" type="text" class="validate">Minicurrículo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 push-m3">
                    <input placeholder="Insira sua senha atual" id="senhaAntiga" type="password" class="validate" name="senhaAntiga"
                           value="">
                    <label for="senhaAntiga">Senha Atual</label>
                </div>
            </div>
            <div class="row">
                <select class="input-field col s6 push-m3 browser-default"  id="curso" type="text" class="validate" name="curso">
                    <option value="<?php echo $estagiario->curso ?>">Escolha seu curso</option>
                    <option value="Engenharia de Computacao">Engenharia de Computação</option>
                    <option value="Engenharia de Software">Engenharia de Software</option>
                    <option value="Ciencias da Computacao>Ciências da Computação</option>
                    <option value="Sistemas de Informacao">Sistemas de Informação</option>
                    <option value="Inteligencia Artificial">Inteligência Artificial</option>
                </select>
            </div>
            <div class="row">
                <div class="col s12 m6 push-m7">
                    <button type="submit" class="btn" id="btnRegistro" name="btnRegistro">EDITAR</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>