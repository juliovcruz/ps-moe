<!DOCTYPE html>
<html>
<?php
if(!session()->get('empregador') && !session()->get('estagiario')) return redirect()->to('Login');

$empregador = session()->get('empregador');
$vagas = session()->get('vagas');
$estagiario = session()->get('estagiario');

if (isset($_GET['id'])) {
    if($_GET['id'] == $empregador->id) {
        $empregadorAdmin = true;
    }
}

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

<form action="/login/logout" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
    <div class="row">
        <h1 class="light col s6 push-m3"> Olá  <?php echo $empregador->nomeDoResponsavel ?>! Bem vindo à tela de vagas </h1>
    </div>

    <div class="container">
        <table class="striped">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Remuneração</th>
            </tr>
            </thead>
            <tbody>

            <?php
                foreach ($vagas as $vaga) {
echo "<tr>
<th>$vaga->titulo</th>
<th>$vaga->descricao</th>
<th>$vaga->remuneracao</th>";

if ($estagiario) echo "<th><button class='btn'><i class='material-icons'>add_alert</i></button></th>";
if ($empregadorAdmin) echo "<th><a href='/vaga/editar?id=$vaga->id' class='icon-block'><i class='material-icons'>create</i></a></th>";

echo "</tr>";
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
            <a href="editar" class="">Editar Cadastro</a>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>