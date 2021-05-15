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

    <?php if (session()->get('success')): ?>
    <div class="card-panel teal lighten-2 white-text" id="sucesso">
        <?= session()->get('success') ?>
    </div>
    <?php endif; ?>

    <div class="row" style="padding-right: 200px;">
        <form action="/Login/logar" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
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
                    <input type="hidden" name="action" value="logar"/>
                </div>
                <div class="row col s12 push-m3">
                    <a href="registrarEstagiario.php" class="">Registrar Estagiário</a>
                    <span class=""> | </span>
                    <a href="registrarEmpregador.php" class="">Registrar Empregador</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>