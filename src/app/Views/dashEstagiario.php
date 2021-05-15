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

    <form action="logout.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h1 class="light col s6 push-m3"> Olá! Bem vindo à tela de vagas </h1>
        </div>

        <div>
            <table class="striped">
                <thead>
                <tr>
                    <th>Nome da empresa</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
            <?php
            if(isset($empregadores)) {
                foreach ($empregadores[0] as $empregador) {
echo "<tr>
<th>$empregador->email</th>
<th>$empregador->nomeDaEmpresa</th>
<th><button class='btn'><i class='material-icons'>add_alert</i></button></th>
</tr>";
                }
            }
            ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col s6 push-m3">
                <button type="submit" class='btn'>Logout</button>
            </div>
            <div class="row col s12 push-m3">
                <a href="editarEstagiario.php" class="">Editar Cadastro</a>
            </div>
        </div>
    </body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>