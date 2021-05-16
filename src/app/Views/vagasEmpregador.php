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

<?php
if($estagiario) echo "<nav>
    <div class='nav-wrapper grey darken-3'>
        <a href='#!' class='brand-logo center'>MOE</a>
        <ul class='right hide-on-med-and-down'>
            <li><a href='/estagiario/dash'><i class='material-icons'>home</i></a></li>
            <li><a href='/estagiario/editar'><i class='material-icons'>person</i></a></li>
            <li><a href='/login/logout'><i class='material-icons'>exit_to_app</i></a></li>
        </ul>
    </div>
</nav>";
else if($empregador) echo "<nav>
    <div class='nav-wrapper grey darken-3'>
        <a href='#!' class='brand-logo center'>MOE</a>
        <ul class='right hide-on-med-and-down'>
            <li><a href='/empregador/dash'><i class='material-icons'>home</i></a></li>
            <li><a href='/vaga/register'><i class='material-icons'>library_add</i></a></li>
            <li><a href='/vaga/vagasEmpregador?id=$empregador->id'><i class='material-icons'>library_books</i></a></li>
            <li><a href='/empregador/editar'><i class='material-icons'>person</i></a></li>
            <li><a href='/login/logout'><i class='material-icons'>exit_to_app</i></a></li>
        </ul>
    </div>
</nav>";
?>

    <div class="row">
        <h2 class="light col s6 push-m3"> Olá  <?php echo $empregador->nomeDoResponsavel ?>! Bem vindo à tela de vagas </h2>
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
if ($empregadorAdmin) echo "<th><a href='/vaga/editar?id=$vaga->id' class='icon-block'><i class='material-icons'>create</i></a></th>";

echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>