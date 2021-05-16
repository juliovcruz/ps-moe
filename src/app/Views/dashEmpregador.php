<!DOCTYPE html>
<html>
<?php
    if(!session()->get('empregador')) return redirect()->to('Login');

$empregador = session()->get('empregador');
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
            <li><a href='/empregador/dash'><i class='material-icons'>home</i></a></li>
            <li><a href='/vaga/register'><i class='material-icons'>library_add</i></a></li>
            <li><a href='/vaga/vagasEmpregador?id=<?php echo $empregador->id ?>'><i class='material-icons'>library_books</i></a></li>
            <li><a href='/empregador/editar'><i class='material-icons'>person</i></a></li>
            <li><a href='/login/logout'><i class='material-icons'>exit_to_app</i></a></li>
        </ul>
    </div>
</nav>

    <div class="row">
        <h1 class="light col s6 push-m3"> Olá <?php echo $empregador->nomeDoResponsavel ?>! Bem vindo à tela de vagas </h1>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>